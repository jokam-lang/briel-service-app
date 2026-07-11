<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PT Briel Service') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <nav class="bg-blue-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center font-bold text-2xl tracking-wider">
                        BRIEL SERVICE
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="hover:bg-blue-700 px-3 py-2 rounded-md font-medium">Home</a>
                    <a href="{{ route('portfolio.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded-md font-medium">Portofolio</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-blue-900 text-white text-center py-6 mt-12">
        <p>&copy; {{ date('Y') }} PT Briel Service. All rights reserved.</p>
    </footer>
</body>
</html>
