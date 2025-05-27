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
    <header class="flex justify-between items-center p-4 border-b">
        <div class="text-lg font-bold">TENTON</div>
        <div class="flex gap-4">
            @auth
                <a href="{{ route('dashboard') }}" class="text-sm">Profile</a>
            @else
                <a href="{{ route('register') }}" class="text-sm">Register</a>
                <a href="{{ route('login') }}" class="text-sm bg-blue-500 text-white px-4 py-1 rounded">Login</a>
            @endauth
        </div>
    </header>

    {{-- MAIN --}}
    <main class="flex-1 flex flex-col items-center px-4 py-10">
        <h1 class="text-2xl font-bold text-center mb-6">Aplikacioni për Kërkimin e Ilaçeve</h1>

        {{-- SEARCH FORM --}}
        {{-- <form wire:submit.prevent="search" class="flex flex-col sm:flex-row items-center gap-2 w-full max-w-2xl mb-6">
            <input type="text"
                   wire:model="ndcInput"
                   placeholder="Shkruaj kodet të ndara me presje, 12345-6789, 11111-2222, 99999-0000"
                   class="w-full px-4 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300" />
            <button type="submit"
                    class="w-full sm:w-auto px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                Kërko
            </button>
        </form> --}}

        <livewire:search-ndc /> 

        {{-- RESULTS TABLE --}}
        @if (!empty($results))
            <div class="overflow-x-auto w-full max-w-4xl">
                <table class="table-auto w-full border border-gray-200 text-sm text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">Kodi</th>
                            <th class="px-4 py-2 border">Emri i produktit</th>
                            <th class="px-4 py-2 border">Prodhuesi</th>
                            <th class="px-4 py-2 border">Lloji i produktit</th>
                            <th class="px-4 py-2 border">Burimi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                            <tr class="border-t">
                                <td class="px-4 py-2 border">{{ $result['code'] }}</td>
                                <td class="px-4 py-2 border">{{ $result['name'] ?? '-' }}</td>
                                <td class="px-4 py-2 border">{{ $result['manufacturer'] ?? '-' }}</td>
                                <td class="px-4 py-2 border">{{ $result['type'] ?? '-' }}</td>
                                <td class="px-4 py-2 border">{{ $result['source'] ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </main>

    {{-- FOOTER --}}
    <footer class="flex justify-between text-sm text-gray-600 p-4 border-t">
        <div>www.tenton.co</div>
        <div>hello@tenton.co</div>
    </footer>

</body>
</html>
