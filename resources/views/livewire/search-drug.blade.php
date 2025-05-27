<div class="space-y-6 mx-auto" style="width: 900px;">
    <!-- Search Form -->
    <form wire:submit.prevent="search" class="flex flex-row items-center gap-3 mb-6 " style="width: 900px;">
        <input 
            type="text" 
            wire:model.defer="ndcInput" 
            placeholder="Shkruaj kodet të ndara me presje, 12345-6789, 11111-2222, 99999-0000" 
            class="flex-1 px-4 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm" 
        />
        <button 
            type="submit" 
            class="w-auto px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition text-sm font-medium"
        >
            Kërko
        </button>
    </form>

    <!-- Results Table -->
    @if (!empty($results))
        <div class="overflow-x-auto" style="width: 900px;">
            <table class="table-auto border border-gray-200 text-sm text-left w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border font-medium text-gray-700">Kodi</th>
                        <th class="px-4 py-2 border font-medium text-gray-700">Emri i produktit</th>
                        <th class="px-4 py-2 border font-medium text-gray-700">Prodhuesi</th>
                        <th class="px-4 py-2 border font-medium text-gray-700">Lloji i produktit</th>
                        <th class="px-4 py-2 border font-medium text-gray-700">Burimi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr class="border-t">
                            <td class="px-4 py-2 border text-gray-800">{{ $result['drug']['ndc_code'] ?? $result['ndc_code'] }}</td>
                            <td class="px-4 py-2 border text-gray-800">{{ $result['drug']['brand_name'] ?? '-' }}</td>
                            <td class="px-4 py-2 border text-gray-800">{{ $result['drug']['labeler_name'] ?? '-' }}</td>
                            <td class="px-4 py-2 border text-gray-800">{{ $result['drug']['product_type'] ?? '-' }}</td>
                            <td class="px-4 py-2 border text-gray-800">{{ $result['source'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>