<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kërkimi i Ilaçeve</title>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen justify-between bg-white text-black font-sans">

    {{-- HEADER --}}
    <header class="flex justify-between items-center p-4 border-b border-gray-200">
        <div class="text-lg font-bold">TENTON</div>
        <div class="flex gap-4">
            @auth
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-800">Profile</a>
            @else
                <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-gray-800">Register</a>
                <a href="{{ route('login') }}" class="text-sm bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 transition">Login</a>
            @endauth
        </div>
    </header>

    {{-- MAIN --}}
    <main class="flex-1 flex flex-col items-center justify-center px-4 py-10">
        <h1 class="text-3xl font-bold text-center mb-6">Aplikacioni për Kërkimin e Ilaçeve</h1>
        <livewire:search-drug />
    </main>

    {{-- FOOTER --}}
    <footer class="flex justify-between text-sm text-gray-600 p-4 border-t border-gray-200">
        <div>www.tenton.co</div>
        <div>hello@tenton.co</div>
    </footer>

</body>
</html>