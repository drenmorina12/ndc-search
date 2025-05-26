<?php

namespace Database\Seeders;

use App\Models\Ndc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NdcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ndc::factory(10)->create();
    }
}
