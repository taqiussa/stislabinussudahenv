<?php

namespace Database\Seeders;

use App\Models\Gunabayar;
use Illuminate\Database\Seeder;

class AdmujianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Gunabayar::create([
            'gunabayar' => 'PAS Gasal',
            'wajibbayar' => 120000,
            'jenisket' => 'Non-SPP',
            'pdf' => '',
            'ket' => 3,
            'urut' => 0,
            'detailket' => '',
            ]);
        Gunabayar::create([
            'gunabayar' => 'PAT Genap',
            'wajibbayar' => 120000,
            'jenisket' => 'Non-SPP',
            'pdf' => '',
            'ket' => 3,
            'urut' => 0,
            'detailket' => '',
            ]);
        
    }
}
