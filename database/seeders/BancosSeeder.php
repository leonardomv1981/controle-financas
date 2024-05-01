<?php

namespace Database\Seeders;

use App\Models\Bancos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BancosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bancos::create([
            'nome' => 'Bradesco',
            'situacao' => 'ativo',
        ]);
    }
}
