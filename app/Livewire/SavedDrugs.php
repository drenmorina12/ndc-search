<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Drug;

class SavedDrugs extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.saved-drugs', [
            'drugs' => Drug::orderByDesc('created_at')->paginate(5),
        ]);
    }
}