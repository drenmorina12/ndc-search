<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ilaçet e Ruajtura</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-black font-sans">

    {{-- HEADER --}}
    <header class="flex justify-between items-center px-6 py-4 bg-white border-b border-gray-200">
        <div class="text-xl font-bold text-gray-900">TENTON</div>
        <div class="flex gap-3">
            <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-800 px-4 py-2">Kthehu</a>
        </div>
    </header>

    {{-- MAIN --}}
    <main class="flex-1 flex flex-col items-center px-4 py-16">
        <div class="w-full max-w-5xl">
            {{-- <h1 class="text-3xl font-semibold text-center text-gray-900 mb-10">Ilaçet e Ruajtura</h1> --}}
            <livewire:saved-drugs />
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="flex flex-col sm:flex-row justify-center items-center gap-8 text-sm text-gray-600 p-6 bg-white border-t border-gray-200">
        <div>www.tenton.co</div>
        <div>hello@tenton.co</div>
    </footer>

    @livewireScripts
</body>
</html>
