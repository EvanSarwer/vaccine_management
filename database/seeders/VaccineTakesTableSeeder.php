<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VaccineTakesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vaccine_takes')->insert([

            //vaccine-take/order
            [
                'user_id' => 2,
                'vaccine_id' => 1,
                'division' => 'Dhaka',
                'center_id' => 1,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-15',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 2,
                'vaccine_id' => 2,
                'division' => 'Dhaka',
                'center_id' => 1,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-15',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 2,
                'vaccine_id' => 3,
                'division' => 'Dhaka',
                'center_id' => 1,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-15',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 2,
                'vaccine_id' => 4,
                'division' => 'Dhaka',
                'center_id' => 1,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-15',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 2,
                'vaccine_id' => 5,
                'division' => 'Dhaka',
                'center_id' => 1,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-15',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 2,
                'vaccine_id' => 6,
                'division' => 'Dhaka',
                'center_id' => 1,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-15',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 2,
                'vaccine_id' => 7,
                'division' => 'Dhaka',
                'center_id' => 1,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-15',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 2,
                'vaccine_id' => 8,
                'division' => 'Dhaka',
                'center_id' => 1,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-15',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 3,
                'vaccine_id' => 1,
                'division' => 'Dhaka',
                'center_id' => 1,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-15',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 3,
                'vaccine_id' => 2,
                'division' => 'Chattogram',
                'center_id' => 2,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-16',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 3,
                'vaccine_id' => 3,
                'division' => 'Chattogram',
                'center_id' => 2,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-17',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 3,
                'vaccine_id' => 4,
                'division' => 'Chattogram',
                'center_id' => 2,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-18',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 3,
                'vaccine_id' => 5,
                'division' => 'Chattogram',
                'center_id' => 2,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-19',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 3,
                'vaccine_id' => 6,
                'division' => 'Chattogram',
                'center_id' => 2,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-20',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 3,
                'vaccine_id' => 7,
                'division' => 'Chattogram',
                'center_id' => 2,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-21',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 3,
                'vaccine_id' => 8,
                'division' => 'Chattogram',
                'center_id' => 2,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-22',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 4,
                'vaccine_id' => 1,
                'division' => 'Chattogram',
                'center_id' => 2,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-23',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 4,
                'vaccine_id' => 2,
                'division' => 'Chattogram',
                'center_id' => 2,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-24',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 4,
                'vaccine_id' => 3,
                'division' => 'Chattogram',
                'center_id' => 2,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-25',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 4,
                'vaccine_id' => 4,
                'division' => 'Chattogram',
                'center_id' => 2,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-26',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 4,
                'vaccine_id' => 5,
                'division' => 'Chattogram',
                'center_id' => 2,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-27',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 4,
                'vaccine_id' => 6,
                'division' => 'Chattogram',
                'center_id' => 2,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-28',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 4,
                'vaccine_id' => 7,
                'division' => 'Chattogram',
                'center_id' => 2,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-29',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 4,
                'vaccine_id' => 8,
                'division' => 'Chattogram',
                'center_id' => 2,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-30',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 5,
                'vaccine_id' => 1,
                'division' => 'Rajshahi',
                'center_id' => 3,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-10-31',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 5,
                'vaccine_id' => 2,
                'division' => 'Rajshahi',
                'center_id' => 3,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-01',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 5,
                'vaccine_id' => 3,
                'division' => 'Rajshahi',
                'center_id' => 3,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-02',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 5,
                'vaccine_id' => 4,
                'division' => 'Rajshahi',
                'center_id' => 3,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-03',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 5,
                'vaccine_id' => 5,
                'division' => 'Rajshahi',
                'center_id' => 3,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-04',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 5,
                'vaccine_id' => 6,
                'division' => 'Rajshahi',
                'center_id' => 3,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-05',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 5,
                'vaccine_id' => 7,
                'division' => 'Rajshahi',
                'center_id' => 3,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-06',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 5,
                'vaccine_id' => 8,
                'division' => 'Rajshahi',
                'center_id' => 3,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-07',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 6,
                'vaccine_id' => 1,
                'division' => 'Rajshahi',
                'center_id' => 3,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-08',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 6,
                'vaccine_id' => 2,
                'division' => 'Rajshahi',
                'center_id' => 3,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-09',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 6,
                'vaccine_id' => 3,
                'division' => 'Rajshahi',
                'center_id' => 3,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-10',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 6,
                'vaccine_id' => 4,
                'division' => 'Rajshahi',
                'center_id' => 3,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-11',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 6,
                'vaccine_id' => 5,
                'division' => 'Rajshahi',
                'center_id' => 3,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-12',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 6,
                'vaccine_id' => 9,
                'division' => 'Rajshahi',
                'center_id' => 3,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-13',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 6,
                'vaccine_id' => 7,
                'division' => 'Rajshahi',
                'center_id' => 3,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-14',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 6,
                'vaccine_id' => 8,
                'division' => 'Rajshahi',
                'center_id' => 3,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-15',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 7,
                'vaccine_id' => 10,
                'division' => 'Mymensingh',
                'center_id' => 8,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-16',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 7,
                'vaccine_id' => 11,
                'division' => 'Mymensingh',
                'center_id' => 8,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-17',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 7,
                'vaccine_id' => 8,
                'division' => 'Mymensingh',
                'center_id' => 8,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-18',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 7,
                'vaccine_id' => 7,
                'division' => 'Mymensingh',
                'center_id' => 8,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-19',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 7,
                'vaccine_id' => 5,
                'division' => 'Mymensingh',
                'center_id' => 8,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-20',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 7,
                'vaccine_id' => 9,
                'division' => 'Mymensingh',
                'center_id' => 8,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-21',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 7,
                'vaccine_id' => 1,
                'division' => 'Mymensingh',
                'center_id' => 8,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-22',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 7,
                'vaccine_id' => 2,
                'division' => 'Mymensingh',
                'center_id' => 8,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-23',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            [
                'user_id' => 8,
                'vaccine_id' => 3,
                'division' => 'Mymensingh',
                'center_id' => 8,
                'order_date' => '2021-10-15',
                'first_dose_date' => '2021-11-24',
                'completed_doses' => 1,
                'total_cost' => '1000',
            ],

            
        ]);
    }
}
