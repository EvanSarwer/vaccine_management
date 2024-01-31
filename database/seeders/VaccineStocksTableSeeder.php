<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VaccineStocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vaccine_stocks')->insert([
            [
                'vaccine_id' => 3,
                'center_id' => 1,
                'available' => 70,
                'reserved' => 20,
                'quantity' => 90,
            ],
            [
                'vaccine_id' => 2,
                'center_id' => 1,
                'available' => 80,
                'reserved' => 20,
                'quantity' => 100,
            ],
            [
                'vaccine_id' => 3,
                'center_id' => 2,
                'available' => 80,
                'reserved' => 20,
                'quantity' => 100,
            ],
            [
                'vaccine_id' => 2,
                'center_id' => 2,
                'available' => 80,
                'reserved' => 20,
                'quantity' => 100,
            ],
        ]); 
    }
}
