<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('centers')->insert([

            //Centers
            [
                'hospital' => 'Dhaka Medical College Hospital',
                'division' => 'Dhaka',
                'address' => 'Dhaka Medical College, Bakshibazar, Dhaka-1211',
                'phone' => '+8809666700100',
                'email' => 'info@dmc.com.bd',
            ],

            [
                'hospital' => 'Chattogram Medical College Hospital',
                'division' => 'Chattogram',
                'address' => 'Chattogram Medical College, Bakshibazar, Dhaka-1211',
                'phone' => '+8809666700100',
                'email' => 'info@cmch.com.bd',
            ],

            [
                'hospital' => 'Rajshahi Medical College Hospital',
                'division' => 'Rajshahi',
                'address' => 'Rajshahi Medical College, Bakshibazar, Dhaka-1211',
                'phone' => '+8809666700100',
                'email' => 'info@rmc.com.bd',
            ],

            [
                'hospital' => 'Khulna Medical College Hospital',
                'division' => 'Khulna',
                'address' => 'Khulna Medical College, Bakshibazar, Dhaka-1211',
                'phone' => '+8809666700100',
                'email' => 'info@kmc.com.bd',
            ],
                
            [
                'hospital' => 'Barishal Medical College Hospital',
                'division' => 'Barishal',
                'address' => 'Barishal Medical College, Bakshibazar, Dhaka-1211',
                'phone' => '+8809666700100',
                'email' => 'info@bmch.com.bd',
            ],

            [
                'hospital' => 'Sylhet Medical College Hospital',
                'division' => 'Sylhet',
                'address' => 'Sylhet Medical College, Bakshibazar, Dhaka-1211',
                'phone' => '+8809666700100',
                'email' => 'info@smch.com.bd',
            ],

            [
                'hospital' => 'Rangpur Medical College Hospital',
                'division' => 'Rangpur',
                'address' => 'Rangpur Medical College, Bakshibazar, Dhaka-1211',
                'phone' => '+8809666700100',
                'email' => 'info@ramch.com.bd',
            ],
                
            [
                'hospital' => 'Mymensingh Medical College Hospital',
                'division' => 'Mymensingh',
                'address' => 'Mymensingh Medical College, Bakshibazar, Dhaka-1211',
                'phone' => '+8809666700100',
                'email' => 'info@mmch.com.bd',
            ],


        
        
            
        ]);

    }
}
