<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VeccinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vaccines')->insert([

            //Vaccines
            [
                'name' => 'Influenza Vaccine (Flu Shot)',
                'disease_id' => 1,
                'doses_required' => 1,
                'dose_gap' => null,
                'dose_gap_number' => null,
                'dose_gap_time' => null,
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Pfizer-BioNTech',
                'disease_id' => 2,
                'doses_required' => 2,
                'dose_gap' => '[
                    {"dose_number": 1, "gap_in_days": 0},
                    {"dose_number": 2, "gap_in_days": 21},
                 ]',
                'dose_gap_number' => 21,
                'dose_gap_time' => 'day',
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Moderna',
                'disease_id' => 2,
                'doses_required' => 2,
                'dose_gap' => '[
                    {"dose_number": 1, "gap_in_days": 0},
                    {"dose_number": 2, "gap_in_days": 28},
                 ]',
                'dose_gap_number' => 28,
                'dose_gap_time' => 'day',
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Johnson & Johnson',
                'disease_id' => 2,
                'doses_required' => 1,
                'dose_gap' => null,
                'dose_gap_number' => null,
                'dose_gap_time' => null,
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Measles',
                'disease_id' => 3,
                'doses_required' => 2,
                'dose_gap' => '[
                    {"dose_number": 1, "gap_in_days": 0},
                    {"dose_number": 2, "gap_in_days": 28},
                 ]',
                'dose_gap_number' => 28,
                'dose_gap_time' => 'day',
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Mumps',
                'disease_id' => 3,
                'doses_required' => 2,
                'dose_gap' => '[
                    {"dose_number": 1, "gap_in_days": 0},
                    {"dose_number": 2, "gap_in_days": 28},
                 ]',
                'dose_gap_number' => 28,
                'dose_gap_time' => 'day',
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Rubella (MMR)',
                'disease_id' => 3,
                'doses_required' => 2,
                'dose_gap' => '[
                    {"dose_number": 1, "gap_in_days": 0},
                    {"dose_number": 2, "gap_in_days": 28},
                 ]',
                'dose_gap_number' => 28,
                'dose_gap_time' => 'day',
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Inactivated Polio Vaccine (IPV)',
                'disease_id' => 4,
                'doses_required' => 4,
                'dose_gap' => '[
                    {"dose_number": 1, "gap_in_days": 0},
                    {"dose_number": 2, "gap_in_days": 60},
                    {"dose_number": 3, "gap_in_days": 120},
                    {"dose_number": 4, "gap_in_days": 180},
                 ]',
                'dose_gap_number' => 60,
                'dose_gap_time' => 'day',
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Tetanus Vaccine',
                'disease_id' => 5,
                'doses_required' => 5,
                'dose_gap' => '[
                    {"dose_number": 1, "gap_in_years": 0},
                    {"dose_number": 2, "gap_in_years": 10},
                    {"dose_number": 3, "gap_in_years": 20},
                    {"dose_number": 4, "gap_in_years": 30},
                    {"dose_number": 5, "gap_in_years": 40},
                 ]',
                'dose_gap_number' => 10,
                'dose_gap_time' => 'year',
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Diphtheria',
                'disease_id' => 6,
                'doses_required' => 5,
                'dose_gap' => '[
                    {"dose_number": 1, "gap_in_months": 0},
                    {"dose_number": 2, "gap_in_months": 2},
                    {"dose_number": 3, "gap_in_months": 4},
                    {"dose_number": 4, "gap_in_months": 6},
                    {"dose_number": 5, "gap_in_months": 15},
                 ]',
                'dose_gap_number' => 2,
                'dose_gap_time' => 'month',
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Tetanus',
                'disease_id' => 6,
                'doses_required' => 5,
                'dose_gap' => '[
                    {"dose_number": 1, "gap_in_months": 0},
                    {"dose_number": 2, "gap_in_months": 2},
                    {"dose_number": 3, "gap_in_months": 4},
                    {"dose_number": 4, "gap_in_months": 6},
                    {"dose_number": 5, "gap_in_months": 15},
                 ]',
                'dose_gap_number' => 2,
                'dose_gap_time' => 'month',
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Pertussis (DTaP) Vaccine',
                'disease_id' => 6,
                'doses_required' => 5,
                'dose_gap' => '[
                    {"dose_number": 1, "gap_in_months": 0},
                    {"dose_number": 2, "gap_in_months": 2},
                    {"dose_number": 3, "gap_in_months": 4},
                    {"dose_number": 4, "gap_in_months": 6},
                    {"dose_number": 5, "gap_in_months": 15},
                 ]',
                'dose_gap_number' => 2,
                'dose_gap_time' => 'month',
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Hepatitis B Vaccine',
                'disease_id' => 6,
                'doses_required' => 3,
                'dose_gap' => '[
                    {"dose_number": 1, "gap_in_months": 0},
                    {"dose_number": 2, "gap_in_months": 1},
                    {"dose_number": 3, "gap_in_months": 6},
                 ]',
                'dose_gap_number' => 1,
                'dose_gap_time' => 'month',
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Hepatitis A Vaccine',
                'disease_id' => 8,
                'doses_required' => 2,
                'dose_gap' => '[
                    {"dose_number": 1, "gap_in_months": 0},
                    {"dose_number": 2, "gap_in_months": 6},
                 ]',
                'dose_gap_number' => 6,
                'dose_gap_time' => 'month',
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Varicella Vaccine',
                'disease_id' => 9,
                'doses_required' => 2,
                'dose_gap' => '[
                    {"dose_number": 1, "gap_in_days": 0},
                    {"dose_number": 2, "gap_in_days": 150},
                 ]',
                'dose_gap_number' => 150,
                'dose_gap_time' => 'day',
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Gardasil',
                'disease_id' => 10,
                'doses_required' => 2,
                'dose_gap' => '[
                    {"dose_number": 1, "gap_in_days": 0},
                    {"dose_number": 2, "gap_in_days": 60},
                 ]',
                'dose_gap_number' => 60,
                'dose_gap_time' => 'day',
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Cervarix',
                'disease_id' => 10,
                'doses_required' => 3,
                'dose_gap' => '[
                    {"dose_number": 1, "gap_in_days": 0},
                    {"dose_number": 2, "gap_in_days": 60},
                    {"dose_number": 3, "gap_in_days": 180},
                 ]',
                'dose_gap_number' => 60,
                'dose_gap_time' => 'day',
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Pneumococcal Conjugate Vaccine (PCV13)',
                'disease_id' => 11,
                'doses_required' => 1,
                'dose_gap' => null,
                'dose_gap_number' => null,
                'dose_gap_time' => null,
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Pneumococcal',
                'disease_id' => 11,
                'doses_required' => 1,
                'dose_gap' => null,
                'dose_gap_number' => null,
                'dose_gap_time' => null,
                'stock_quantity' => 100,
            ],

            [
                'name' => 'Meningococcal Conjugate Vaccine (MenACWY)',
                'disease_id' => 12,
                'doses_required' => 1,
                'dose_gap' => null,
                'dose_gap_number' => null,
                'dose_gap_time' => null,
                'stock_quantity' => 100,
            ],


        
            
        ]);
    }
}
