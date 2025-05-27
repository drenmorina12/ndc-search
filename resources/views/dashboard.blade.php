<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kërkimi i Ilaçeve</title>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-black font-sans">

    {{-- HEADER --}}
    <header class="flex justify-between items-center px-6 py-4 bg-white border-b border-gray-200">
        <div class="text-xl font-bold text-gray-900">TENTON</div>
        <div class="flex gap-3">
            @auth
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-800 px-4 py-2">Profile</a>
            @else
                <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-gray-800 px-4 py-2">Register</a>
                <a href="{{ route('login') }}" class="text-sm bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition-colors">Login</a>
            @endauth
        </div>
    </header>

    {{-- MAIN --}}
    <main class="flex-1 flex flex-col items-center px-4 py-16">
        <div class="w-full max-w-4xl">
            <h1 class="text-4xl md:text-5xl font-bold text-center text-gray-900 mb-16">Aplikacioni për Kërkimin e Ilaçeve</h1>
            <livewire:search-drug />
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="flex flex-col sm:flex-row justify-center items-center gap-8 text-sm text-gray-600 p-6 bg-white border-t border-gray-200">
        <div>www.tenton.co</div>
        <div>hello@tenton.co</div>
    </footer>

</body>
</html>