<div class="w-full max-w-4xl mx-auto space-y-8">
    <!-- Search Form -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form wire:submit.prevent="search" class="flex flex-col sm:flex-row gap-4">
            <input 
                type="text" 
                wire:model.defer="ndcInput" 
                placeholder="Shkruaj kodet të ndara me presje, 12345-6789, 11111-2222, 99999-0000" 
                class="flex-1 px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm placeholder-gray-500" 
            />
            <button 
                type="submit" 
                class="px-8 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors text-sm font-medium whitespace-nowrap hover:cursor-pointer"
            >
                Kërko
            </button>
        </form>
    </div>

    <!-- Results Table -->
    @if (!empty($results))
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 font-medium text-gray-900">Kodi</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Emri i produktit</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Prodhuesi</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Lloji i produktit</th>
                            <th class="px-6 py-4 font-medium text-gray-900">Burimi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($results as $result)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-900 font-medium">{{ $result['drug']['ndc_code'] ?? $result['ndc_code'] }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $result['drug']['brand_name'] ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $result['drug']['labeler_name'] ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $result['drug']['product_type'] ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $result['source'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if (empty($results) && $ndcInput)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
            <p class="text-gray-500">Nuk u gjetën rezultate për kërkimin tuaj.</p>
        </div>
    @endif
</div>