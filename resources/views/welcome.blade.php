<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'GearRent') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-gray-50">

    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <x-application-logo class="h-8 w-auto fill-current text-indigo-600" />
                    <span class="ml-2 text-xl font-bold text-gray-900">GearRent</span>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <header class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="block">Rent the Best Gear for</span>
                    <span class="block text-indigo-600">Your Next Adventure</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Don't let expensive equipment hold you back. Rent professional-grade hiking, camping, and climbing gear at affordable daily rates.
                </p>
                <div class="mt-10 flex justify-center gap-4">
                    <a href="{{ route('items.index') }}" class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                        Browse Gear
                    </a>
                    <a href="#features" class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg md:px-10">
                        How it Works
                    </a>
                </div>
                @guest
                <span class="text-gray-500">Ready to book?</span>
                    <div class="mt-6 flex justify-center items-center space-x-2 text-sm">
                        <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Log in</a>
                        <span class="text-gray-300">|</span>
                        <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Create Account</a>
                    </div>
                @endguest
            </div>
        </div>
    </header>

    <section id="features" class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">Why Choose Us?</h2>
            <div class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-3">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="text-indigo-600 mb-4 font-bold text-lg">Top Quality</div>
                    <p class="text-gray-600 text-sm">We only stock industry-leading brands maintained to the highest safety standards.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="text-indigo-600 mb-4 font-bold text-lg">Easy Booking</div>
                    <p class="text-gray-600 text-sm">Select your dates, book your gear, and pick it up. Simple and fast.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="text-indigo-600 mb-4 font-bold text-lg">Flexible Returns</div>
                    <p class="text-gray-600 text-sm">Life happens. We offer easy return windows and extended rental options.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto py-8 px-4 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} GearRent. All rights reserved.
        </div>
    </footer>
</body>
</html>