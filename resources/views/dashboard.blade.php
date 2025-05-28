<!DOCTYPE html>
<html lang="sq">

    <head>
        <title>{{ $title ?? config('app.name') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance

    </head>

    <body class="flex flex-col min-h-screen bg-gray-50 text-black font-sans">

        {{-- HEADER --}}
        <header class="flex justify-between items-center px-6 py-4 bg-white border-b border-gray-200">
            <div class="text-xl font-bold text-gray-900">TENTON</div>
            <div class="flex gap-3">
                @auth
                    <a href="{{ route('saved.drugs') }}" class="text-sm text-gray-600 hover:text-gray-800 px-4 py-2">Të
                        Ruajturat</a>
                    {{-- PROFILE DROPDOWN --}}
                    <flux:dropdown position="bottom" align="start">
                        <flux:profile :name="auth() -> user() -> name" :initials="auth() -> user() -> initials()"
                            icon-trailing="chevrons-up-down" />

                        <flux:menu class="w-[220px]">
                            <flux:menu.radio.group>
                                <div class="p-0 text-sm font-normal">
                                    <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                        <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                            <span
                                                class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                                {{ auth()->user()->initials() }}
                                            </span>
                                        </span>

                                        <div class="grid flex-1 text-start text-sm leading-tight">
                                            <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                            <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </flux:menu.radio.group>

                            <flux:menu.separator />

                            <flux:menu.radio.group>
                                <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                                    {{ __('Settings') }}</flux:menu.item>
                            </flux:menu.radio.group>

                            <flux:menu.separator />

                            <form method="POST" action="{{ route('logout') }}" class="w-full ">
                                @csrf
                                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                                    class="w-full hover:cursor-pointer">
                                    {{ __('Log Out') }}
                                </flux:menu.item>
                            </form>
                        </flux:menu>
                    </flux:dropdown>
                @else
                    <a href="{{ route('register') }}"
                        class="text-sm text-gray-600 hover:text-gray-800 px-4 py-2">Register</a>
                    <a href="{{ route('login') }}"
                        class="text-sm bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition-colors">Login</a>
                @endauth
            </div>
        </header>

        {{-- MAIN --}}
        <main class="flex-1 flex flex-col items-center px-4 py-16">
            <div class="w-full max-w-4xl">
                <h1 class="text-4xl md:text-5xl font-bold text-center text-gray-900 mb-16">Aplikacioni për Kërkimin e
                    Ilaçeve</h1>
                <livewire:search-drug />
            </div>
        </main>

        {{-- FOOTER --}}
        <footer
            class="flex flex-col sm:flex-row justify-center items-center gap-8 text-sm text-gray-600 p-6 bg-white border-t border-gray-200">
            <div>www.tenton.co</div>
            <div>hello@tenton.co</div>
        </footer>

        @fluxScripts
    </body>

</html>
