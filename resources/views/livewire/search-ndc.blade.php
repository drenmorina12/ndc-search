<div class="space-y-4">
    <form wire:submit.prevent="search" class="flex space-x-2">
        <input type="text" wire:model.defer="ndcInput" placeholder="Enter NDC code"
               class="border p-2 rounded w-full" />
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Search</button>
    </form>

    @foreach ($results as $result)
        <div class="p-4 border rounded">
            <strong>NDC:</strong> {{ $result['ndc']['ndc_code'] ?? $result['ndc_code'] }} <br>
            <strong>Source:</strong> {{ $result['source'] }}

            @isset($result['ndc'])
                <div>Brand: {{ $result['ndc']['brand_name'] }}</div>
                <div>Generic: {{ $result['ndc']['generic_name'] }}</div>
                <div>Labeler: {{ $result['ndc']['labeler_name'] }}</div>
            @endisset
        </div>
    @endforeach
</div>
