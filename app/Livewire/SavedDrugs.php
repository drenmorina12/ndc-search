<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Drug;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function export(): StreamedResponse
    {
        $filename = 'saved_drugs_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['NDC Code', 'Brand Name', 'Labeler Name', 'Product Type', 'Saved At']);

            Drug::chunk(100, function ($drugs) use ($file) {
                foreach ($drugs as $drug) {
                    fputcsv($file, [
                        $drug->ndc_code,
                        $drug->brand_name,
                        $drug->labeler_name,
                        $drug->product_type,
                        $drug->created_at->format('d/m/Y H:i'),
                    ]);
                }
            });

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


    public function render()
    {
        return view('livewire.saved-drugs', [
            'drugs' => Drug::orderByDesc('created_at')->paginate(5),
        ]);
    }
}
