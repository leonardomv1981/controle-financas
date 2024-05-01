<?php

namespace Database\Seeders;

use App\Models\Bancos;
use App\Models\Bandeiras;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BandeirasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bandeiras::create ([
            'nome' => 'Visa',
            'situacao' => 'ativo',
        ]);
    }
}
