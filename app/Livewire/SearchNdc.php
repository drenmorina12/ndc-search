<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ndc;

class SearchNdc extends Component
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

        $ndc = Ndc::where('ndc_code', $input)->first();

        if ($ndc) {
            $this->results[] = [
                'source' => 'Local',
                'ndc' => $ndc
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
        return view('livewire.search-ndc');
    }
}
