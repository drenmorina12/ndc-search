<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Drug;
use Illuminate\Support\Facades\Http;

class SearchDrug extends Component
{
    public string $ndcInput = '';
    public array $results = [];

    public function search()
    {
        $ndcCodes = $this->parseNdcInput($this->ndcInput);

        $this->results = [];

        $localResults = $this->searchLocal($ndcCodes);
        $this->results = array_merge($this->results, $localResults);

        $notFoundCodes = $this->findUnmatched($ndcCodes, $localResults);

        if (!empty($notFoundCodes)) {
            $apiResults = $this->searchApi($notFoundCodes);
            $this->results = array_merge($this->results, $apiResults);
        }
    }

    protected function parseNdcInput(string $input): array
    {
        return collect(explode(',', $input))
            ->map(fn($code) => trim($code))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    protected function searchLocal(array $ndcCodes): array
    {
        $drugs = Drug::whereIn('ndc_code', $ndcCodes)->get();

        return $drugs->map(function ($drug) {
            return [
                'source' => 'Local',
                'drug' => $drug,
            ];
        })->all();
    }

    protected function findUnmatched(array $ndcCodes, array $localResults): array
    {
        $found = collect($localResults)->pluck('drug.ndc_code')->all();
        return array_values(array_diff($ndcCodes, $found));
    }

    protected function searchApi(array $ndcCodes): array
    {
        $queryString = collect($ndcCodes)
            ->map(fn($code) => 'product_ndc:"' . $code . '"')
            ->join(' OR ');

        $response = Http::get('https://api.fda.gov/drug/ndc.json', [
            'search' => $queryString,
            'limit' => 100,
        ]);

        $final = [];

        if ($response->successful()) {
            $apiResults = $response->json('results', []);
            $foundFromApi = collect($apiResults)->pluck('product_ndc')->all();

            foreach ($apiResults as $item) {


                $final[] = [
                    'source' => 'OpenFDA',
                    'drug' => [
                        'ndc_code'     => $item['product_ndc'],
                        'brand_name'   => $item['brand_name'] ?? 'Unknown',
                        'generic_name' => $item['generic_name'] ?? 'Unknown',
                        'labeler_name' => $item['labeler_name'] ?? 'Unknown',
                        'product_type' => $item['product_type'] ?? 'Unknown',
                    ],
                ];
            }

            $notFound = array_diff($ndcCodes, $foundFromApi);
        } else {
            $notFound = $ndcCodes; 
        }

        foreach ($notFound as $code) {
            $final[] = [
                'source' => $response->successful() ? 'Not Found' : 'API Error',
                'ndc_code' => $code,
            ];
        }

        return $final;
    }

    public function render()
    {
        return view('livewire.search-drug');
    }
}
