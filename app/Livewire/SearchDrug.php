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
        $this->reset('results');

        $ndcCodes = collect(explode(',', $this->ndcInput))
            ->map(fn($code) => trim($code))
            ->filter()
            ->unique()
            ->values();

        if ($ndcCodes->isEmpty()) {
            return;
        }

        // Step 1: Check local DB
        $localDrugs = Drug::whereIn('ndc_code', $ndcCodes)->get();
        $foundLocal = $localDrugs->pluck('ndc_code');

        foreach ($localDrugs as $drug) {
            $this->results[] = [
                'source' => 'Local',
                'drug' => $drug,
            ];
        }

        // Step 2: Mark those not found
        $notFound = $ndcCodes->diff($foundLocal);

        foreach ($notFound as $code) {
            $this->results[] = [
                'source' => 'Not Found',
                'ndc_code' => $code,
            ];
        }
    }


    public function render()
    {
        return view('livewire.search-drug');
    }
}
