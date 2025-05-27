<div class="space-y-4">
    <form wire:submit.prevent="search" class="flex space-x-2">
        <input type="text" wire:model.defer="ndcInput" placeholder="Enter NDC code"
               class="border p-2 rounded w-full" />
        <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded">Search</button>
    </form>

    @foreach ($results as $result)
        <div class="p-4 border rounded">
            <strong>NDC:</strong> {{ $result['drug']['ndc_code'] ?? $result['ndc_code'] }} <br>
            <strong>Source:</strong> {{ $result['source'] }}

            @isset($result['drug'])
                <div>Brand: {{ $result['drug']['brand_name'] }}</div>
                <div>Generic: {{ $result['drug']['generic_name'] }}</div>
                <div>Labeler: {{ $result['drug']['labeler_name'] }}</div>
            @endisset
        </div>
    @endforeach
</div>
