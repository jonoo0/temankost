<?php

namespace Database\Seeders;

use App\Models\JenisKost;
use Illuminate\Database\Seeder;

class JenisKostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenis = [
            'Putra',
            'Putri',
            'Campur',
            'Pasutri',
         ];

         foreach ($jenis as $val) {
              JenisKost::create(['jenis' => $val]);
         }
    }
}
