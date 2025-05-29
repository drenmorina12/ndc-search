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

    <!-- Results Table with Export Button -->
    @if (!empty($results))
        <div class="space-y-3">
            <!-- Table Header with Export Button -->
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    @if (count($results) == 1)
                    {{ count($results) }} rezultat                        
                    @else
                    {{ count($results) }} rezultate
                    @endif
                </div>
                <button 
                    wire:click="export"     
                    class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-medium rounded-md border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Eksporto CSV
                </button>
            </div>

            <!-- Results Table -->
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
        </div>
    @endif

    @if (empty($results) && $ndcInput)
        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-700 p-8 text-center">
            <p class="text-gray-500 dark:text-gray-400">Nuk u gjetën rezultate për kërkimin tuaj.</p>
        </div>
    @endif
</div>