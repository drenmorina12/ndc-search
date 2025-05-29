<!DOCTYPE html>
<html lang="sq">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ilaçet e Ruajtura</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance
        @livewireStyles
    </head>

    <body class="flex flex-col min-h-screen bg-gray-50 dark:bg-zinc-800 text-black dark:text-white font-sans">

        {{-- HEADER --}}
        <header class="flex justify-between items-center px-6 py-4 bg-white dark:bg-zinc-900 border-b border-gray-200 dark:border-zinc-700">
            <a href="{{ route('home') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <div class="text-xl font-bold text-gray-900 dark:text-white">TENTON</div>
            </a>
            <div class="flex gap-3">
                <a href="{{ route('home') }}" class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white px-4 py-2">Home</a>
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
        <x-footer />

        @livewireScripts
        @fluxScripts

    </body>

</html>