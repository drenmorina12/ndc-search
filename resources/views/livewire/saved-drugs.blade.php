<div class="w-full max-w-5xl mx-auto space-y-6">
    <h2 class="text-4xl font-semibold text-center text-gray-900 dark:text-white">Ilaçet e Ruajtura</h2>

    <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 dark:bg-zinc-800 border-b border-gray-200 dark:border-zinc-700">
                    <tr>
                        <th class="px-6 py-4 font-medium text-gray-900 dark:text-white">Kodi</th>
                        <th class="px-6 py-4 font-medium text-gray-900 dark:text-white">Emri</th>
                        <th class="px-6 py-4 font-medium text-gray-900 dark:text-white">Prodhuesi</th>
                        <th class="px-6 py-4 font-medium text-gray-900 dark:text-white">Lloji</th>
                        <th class="px-6 py-4 font-medium text-gray-900 dark:text-white">Ruajtur më</th>
                        <th class="px-6 py-4 font-medium text-gray-900 dark:text-white"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                    @foreach ($drugs as $drug)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors">
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $drug->ndc_code }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $drug->brand_name }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $drug->labeler_name }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $drug->product_type }}</td>
                            <td class="px-6 py-4 text-gray-500 dark:text-gray-400 text-sm">
                                {{ $drug->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="deleteDrug({{ $drug->id }})"
                                    class="text-red-600 dark:text-red-500 hover:text-red-800 dark:hover:text-red-400 hover:cursor-pointer"
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
        <div class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex flex-col items-center gap-22 mt-16">
        {{ $drugs->links() }}
    </div>
</div>