<div class="w-full max-w-4xl mx-auto space-y-6 relative">
    <!-- Search Form -->
    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-700 p-6">
        <form wire:submit.prevent="search" class="flex flex-col sm:flex-row gap-4">
            <input 
                type="text" 
                wire:model.defer="ndcInput" 
                placeholder="Shkruaj kodet të ndara me presje, 12345-6789, 11111-2222, 99999-0000" 
                class="flex-1 px-4 py-3 border border-gray-300 dark:border-zinc-600 rounded-md shadow-sm bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm placeholder-gray-500 dark:placeholder-gray-400" 
            />
            <button 
                type="submit" 
                class="px-8 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors text-sm font-medium whitespace-nowrap"
            >
                Kërko
            </button>
        </form>
    </div>

    <div wire:loading wire:target="search" class="absolute left-1/2 transform -translate-x-1/2 z-20 flex items-center justify-center gap-3 text-gray-900 dark:text-white text-sm font-medium bg-white dark:bg-zinc-800 px-4 py-2 rounded-md shadow-lg border border-blue-200 dark:border-blue-900" style="top: 85px;">
        <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z" />
        </svg>
        Duke kërkuar...
    </div>

    <!-- Results Table -->
    @if (!empty($results))
        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 dark:bg-zinc-800 border-b border-gray-200 dark:border-zinc-700">
                        <tr>
                            <th class="px-6 py-4 font-medium text-gray-900 dark:text-white">Kodi</th>
                            <th class="px-6 py-4 font-medium text-gray-900 dark:text-white">Emri i produktit</th>
                            <th class="px-6 py-4 font-medium text-gray-900 dark:text-white">Prodhuesi</th>
                            <th class="px-6 py-4 font-medium text-gray-900 dark:text-white">Lloji i produktit</th>
                            <th class="px-6 py-4 font-medium text-gray-900 dark:text-white">Burimi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                        @foreach ($results as $result)
                            <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors">
                                <td class="px-6 py-4 text-gray-900 dark:text-white font-medium">{{ $result['drug']['ndc_code'] ?? $result['ndc_code'] }}</td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $result['drug']['brand_name'] ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $result['drug']['labeler_name'] ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $result['drug']['product_type'] ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $result['source'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if (empty($results) && $ndcInput)
        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-700 p-8 text-center">
            <p class="text-gray-500 dark:text-gray-400">Nuk u gjetën rezultate për kërkimin tuaj.</p>
        </div>
    @endif
</div>