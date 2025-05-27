<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $fillable = [
        'ndc_code',
        'brand_name',
        'generic_name',
        'labeler_name',
        'product_type'
    ];
    /** @use HasFactory<\Database\Factories\DrugFactory> */
    use HasFactory;
}
