<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Drug;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class SearchDrug extends Component
{
    public string $ndcInput = '';
    public array $results = [];

    public function search()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $ndcCodes = $this->parseNdcInput($this->ndcInput);

        if (empty($ndcCodes)) {
            session()->flash('message', 'Ju lutem shkruani kode NDC të vlefshme (numra dhe vizë).');
            return;
        }

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
        ->filter(fn($code) => preg_match('/^[\d\-]+$/', $code))
        ->unique()
        ->take(10)
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
                $drug = Drug::create([
                    'ndc_code'     => $item['product_ndc'],
                    'brand_name'   => $item['brand_name'] ?? 'Unknown',
                    'generic_name' => $item['generic_name'] ?? 'Unknown',
                    'labeler_name' => $item['labeler_name'] ?? 'Unknown',
                    'product_type' => $item['product_type'] ?? 'Unknown',
                ]);

                $final[] = [
                    'source' => 'OpenFDA',
                    'drug' => $drug,
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

    public function export()
    {
        if (empty($this->results)) {
            return;
        }

        $filename = 'searched_results_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['NDC Code', 'Brand Name', 'Labeler Name', 'Product Type', 'Source']);

            foreach ($this->results as $result) {
                $drug = $result['drug'] ?? null;

                fputcsv($file, [
                    $drug['ndc_code'] ?? $result['ndc_code'],
                    $drug['brand_name'] ?? '-',
                    $drug['labeler_name'] ?? '-',
                    $drug['product_type'] ?? '-',
                    $result['source'] ?? '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function render()
    {
        return view('livewire.search-drug');
    }
}
