<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Drug;

class SavedDrugs extends Component
{
    use WithPagination;

    public function deleteDrug($id)
    {
        $drug = \App\Models\Drug::find($id);

        if ($drug) {
            $drug->delete();
            session()->flash('message', 'Ilaçi u fshi me sukses.');
        }
    }


    public function render()
    {
        return view('livewire.saved-drugs', [
            'drugs' => Drug::orderByDesc('created_at')->paginate(5),
        ]);
    }
}
