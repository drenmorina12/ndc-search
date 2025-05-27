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

        $input = trim($this->ndcInput);
        if (!$input) {
            return;
        }

        $drug = Drug::where('ndc_code', $input)->first();

        if ($drug) {
            $this->results[] = [
                'source' => 'Local',
                'drug' => $drug
            ];
        } else {
            $this->results[] = [
                'source' => 'Not Found',
                'ndc_code' => $input
            ];
        }
    }


    public function render()
    {
        return view('livewire.search-drug');
    }
}
