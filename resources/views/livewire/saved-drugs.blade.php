<div class="w-full max-w-5xl mx-auto space-y-6">
    <h2 class="text-4xl font-semibold text-center text-gray-900">Ilaçet e Ruajtura</h2>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 font-medium text-gray-900">Kodi</th>
                        <th class="px-6 py-4 font-medium text-gray-900">Emri</th>
                        <th class="px-6 py-4 font-medium text-gray-900">Prodhuesi</th>
                        <th class="px-6 py-4 font-medium text-gray-900">Lloji</th>
                        <th class="px-6 py-4 font-medium text-gray-900">Ruajtur më</th>
                        <th class="px-6 py-4 font-medium text-gray-900"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($drugs as $drug)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">{{ $drug->ndc_code }}</td>
                            <td class="px-6 py-4">{{ $drug->brand_name }}</td>
                            <td class="px-6 py-4">{{ $drug->labeler_name }}</td>
                            <td class="px-6 py-4">{{ $drug->product_type }}</td>
                            <td class="px-6 py-4 text-gray-500 text-sm">
                                {{ $drug->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="deleteDrug({{ $drug->id }})"
                                    class="text-red-600 hover:text-red-800 hover:cursor-pointer"
                                    onclick="return confirm('A je i sigurt që dëshiron të fshish këtë ilaç?')"
                                    title="Fshi">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m5 0H6" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex flex-col items-center gap-22 mt-16">
        {{ $drugs->links() }}
    </div>
</div>
