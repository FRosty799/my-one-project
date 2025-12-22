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
                                        <th class="px-4 py-3 text-sm font-semibold text-gray-700">{{ __('Start Date') }}</th>
                                        <th class="px-4 py-3 text-sm font-semibold text-gray-700">{{ __('End Date') }}</th>
                                        <th class="px-4 py-3 text-sm font-semibold text-gray-700 text-right">{{ __('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($bookings as $booking)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-4 py-4 text-sm font-medium text-gray-900">
                                                {{ $booking->item->name }}
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-600">
                                                {{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-600">
                                                {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                                            </td>
                                            <td class="px-4 py-4 text-sm text-right">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    {{ __('Confirmed') }}
                                                </span>
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