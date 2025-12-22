<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Rental;
use Illuminate\Http\Request;
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
            'user_id' => \Illuminate\Support\Facades\Auth::id(), // This returns the ID of the logged-in user
            'item_id' => $item->id,
            'start_date' => $start,
            'end_date' => $end,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('dashboard')->with('success', 'Gear booked successfully!');
    }
}