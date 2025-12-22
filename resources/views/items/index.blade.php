@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6">
    <h1 class="text-2xl font-bold mb-6 mt-4">Available Gear for Rent</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($items as $item)
            <div class="bg-white rounded-lg shadow p-4 border">
                <h2 class="text-xl font-semibold">{{ $item->name }}</h2>
                <p class="mt-2 font-bold text-blue-600">${{ $item->price_per_day }} / day</p>

                @auth
                    <form action="{{ route('rentals.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <div class="flex flex-col gap-2">
                            <input type="date" name="start_date" class="border rounded p-1">
                            <input type="date" name="end_date" class="border rounded p-1">
                        </div>
                        <button type="submit" class="mt-4 w-full bg-green-500 text-white py-2 rounded">
                            Book Now
                        </button>
                    </form>
                @else
                    <div class="mt-4 p-4 bg-gray-10 rounded text-center">
                        <p class="text-sm text-gray-600 mb-2">Want to rent this?</p>
                        <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">
                            Login to Book Gear
                        </a>
                    </div>
                @endauth
            </div>
        @endforeach
    </div>
</div>
@endsection