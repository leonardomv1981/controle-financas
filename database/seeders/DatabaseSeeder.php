<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Movimentacaocartoes;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        $this->call([
            BandeirasSeeder::class,
            BancosSeeder::class,
            Movimentacaocartoes::class
        ]);
    }
}
