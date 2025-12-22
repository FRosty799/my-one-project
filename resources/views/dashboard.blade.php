<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">{{ __("Welcome back, ") . Auth::user()->name }}!</h3>
                    <p class="text-sm text-gray-600">Manage your rentals and profile from here.</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 border-b pb-2">{{ __('My Gear Bookings') }}</h3>

                    @if($bookings->isEmpty())
                        <div class="py-4 text-center">
                            <p class="text-gray-500 italic">{{ __('You have no active bookings.') }}</p>
                            <a href="{{ route('items.index') }}" class="mt-3 inline-block text-blue-600 hover:text-blue-800 font-semibold">
                                &rarr; {{ __('Browse Available Gear') }}
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 border-b">
                                        <th class="px-4 py-3 text-sm font-semibold text-gray-700">{{ __('Item') }}</th>
                                        <th class="px-4 py-3 text-sm font-semibold text-gray-700">{{ __('Rental Dates') }}</th>
                                        <th class="px-4 py-3 text-sm font-semibold text-gray-700">{{ __('Total Price') }}</th>
                                        <th class="px-4 py-3 text-sm font-semibold text-gray-700">{{ __('Status') }}</th>
                                        <th class="px-4 py-3 text-sm font-semibold text-gray-700 text-right">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($bookings as $booking)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-4 py-4 text-sm font-medium text-gray-900">
                                                {{ $booking->item->name }}
                                            </td>
                                            
                                            <td class="px-4 py-4 text-sm text-gray-600">
                                                <form action="{{ route('rentals.update', $booking) }}" method="POST" class="flex items-center space-x-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="flex flex-col">
                                                        <label class="text-[10px] uppercase text-gray-400">Start</label>
                                                        <input type="date" name="start_date" value="{{ \Carbon\Carbon::parse($booking->start_date)->format('Y-m-d') }}" class="text-xs border-gray-300 rounded p-1 focus:ring-indigo-500">
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <label class="text-[10px] uppercase text-gray-400">End</label>
                                                        <input type="date" name="end_date" value="{{ \Carbon\Carbon::parse($booking->end_date)->format('Y-m-d') }}" class="text-xs border-gray-300 rounded p-1 focus:ring-indigo-500">
                                                    </div>
                                                    <button type="submit" class="mt-4 text-indigo-600 hover:text-indigo-900 text-xs font-bold px-2 py-1 bg-indigo-50 rounded">
                                                        Update
                                                    </button>
                                                </form>
                                            </td>
                                        
                                            <td class="px-4 py-4 text-sm text-gray-900 font-semibold">
                                                ${{ number_format($booking->total_price, 2) }}
                                            </td>
                                        
                                            <td class="px-4 py-4 text-sm">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    {{ __('Confirmed') }}
                                                </span>
                                            </td>
                                        
                                            <td class="px-4 py-4 text-sm text-right">
                                                <form action="{{ route('rentals.destroy', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>