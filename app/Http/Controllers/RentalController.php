<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $item = Item::findOrFail($request->item_id);
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

        // Check availability
        $exists = Rental::where('item_id', $item->id)
            ->where(function($query) use ($start, $end) {
                $query->whereBetween('start_date', [$start, $end])
                      ->orWhereBetween('end_date', [$start, $end]);
            })->exists();

        if ($exists) {
            return back()->with('error', 'This item is already booked for these dates.');
        }

        $days = $start->diffInDays($end) + 1;
        $totalPrice = $days * $item->price_per_day;

        Rental::create([
            'user_id' => Auth::id(), // This returns the ID of the logged-in user
            'item_id' => $item->id,
            'start_date' => $start,
            'end_date' => $end,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('dashboard')->with('success', 'Gear booked successfully!');
    }

    public function update(Request $request, Rental $rental)
{
    // 1. Security check: Only the owner can update
    if ($rental->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
    ]);

    $start = Carbon::parse($request->start_date);
    $end = Carbon::parse($request->end_date);

    // 2. Check availability (excluding THIS rental record)
    $exists = Rental::where('item_id', $rental->item_id)
        ->where('id', '!=', $rental->id) // Important: Ignore this current booking
        ->where(function($query) use ($start, $end) {
            $query->whereBetween('start_date', [$start, $end])
                  ->orWhereBetween('end_date', [$start, $end]);
        })->exists();

    if ($exists) {
        return back()->with('error', 'New dates conflict with an existing booking.');
    }

    // 3. Recalculate price
    $item = $rental->item;
    $days = $start->diffInDays($end) + 1;
    
    $rental->update([
        'start_date' => $start,
        'end_date' => $end,
        'total_price' => $days * $item->price_per_day,
    ]);

    return redirect()->route('dashboard')->with('success', 'Booking updated successfully!');
}

public function destroy(Rental $rental)
{
    // Security check
    if ($rental->user_id !== Auth::id()) {
        abort(403);
    }

    $rental->delete();

    return redirect()->route('dashboard')->with('success', 'Rental cancelled successfully.');
}
}