<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Drug;

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
            foreach ($notFoundCodes as $code) {
                $this->results[] = [
                    'source' => 'Not Found',
                    'ndc_code' => $code,
                ];
            }
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
        $found = collect($localResults)->pluck('ndc.ndc_code')->all();
        return array_values(array_diff($ndcCodes, $found));
    }

    public function render()
    {
        return view('livewire.search-drug');
    }
}
