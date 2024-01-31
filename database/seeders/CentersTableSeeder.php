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
                'location_link' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.604362965682!2d90.39410427576038!3d23.725818539718787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8e6474187cf%3A0xb3d3783755659522!2sDhaka%20Medical%20College%20Hospital!5e0!3m2!1sen!2sbd!4v1703358730059!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'phone' => '+8809666700100',
                'email' => 'info@dmc.com.bd',
            ],
            [
                'hospital' => 'United Hospital Vaccination Center',
                'division' => 'Dhaka',
                'address' => 'Ka-58, kalachandpur, Model town, ঢাকা, 1212',
                'location_link' => '<iframe src="<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d116812.54866576825!2d90.33320362031537!3d23.80465061848666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c767812f6d4f%3A0xd892dc353c2e0db3!2sUnited%20Hospital%20Vaccination%20Center!5e0!3m2!1sen!2sbd!4v1706535286035!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'phone' => '+8809666700100',
                'email' => 'info@uhvc.com.bd',
            ],

            [
                'hospital' => 'Chattogram Medical College Hospital',
                'division' => 'Chattogram',
                'address' => 'Chattogram Medical College, Bakshibazar, Dhaka-1211',
                'location_link' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3689.84514702174!2d91.8293951257301!3d22.359475190747155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30acd882a59437c7%3A0xf99d92fdc17dd741!2sChattogram%20Medical%20College%20Hospital!5e0!3m2!1sen!2sbd!4v1703358773611!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'phone' => '+8809666700100',
                'email' => 'info@cmch.com.bd',
            ],

            [
                'hospital' => 'Rajshahi Medical College Hospital',
                'division' => 'Rajshahi',
                'address' => 'Rajshahi Medical College, Bakshibazar, Dhaka-1211',
                'location_link' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3634.2667023982817!2d88.58385097577545!3d24.37202386462746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fbef02d4899947%3A0x6c5031675c0796a8!2sRajshahi%20Medical%20College%20Hospital!5e0!3m2!1sen!2sbd!4v1703358825271!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'phone' => '+8809666700100',
                'email' => 'info@rmc.com.bd',
            ],

            [
                'hospital' => 'Khulna Medical College Hospital',
                'division' => 'Khulna',
                'address' => 'Khulna Medical College, Bakshibazar, Dhaka-1211',
                'location_link' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3677.3058535660193!2d89.53456597574025!3d22.82817112355411!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff9abc698fbea9%3A0x19d86c4a95e15ad3!2sKhulna%20Medical%20College%20Hospital!5e0!3m2!1sen!2sbd!4v1703358858844!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'phone' => '+8809666700100',
                'email' => 'info@kmc.com.bd',
            ],
                
            [
                'hospital' => 'Barishal Medical College Hospital',
                'division' => 'Barishal',
                'address' => 'Barishal Medical College, Bakshibazar, Dhaka-1211',
                'location_link' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3681.131840532783!2d90.35834447573713!3d22.686135478798708!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755346bf0db06e1%3A0x21da2b091e2262df!2sBarisal%20Medical%20College%20Emergency!5e0!3m2!1sen!2sbd!4v1703358897385!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'phone' => '+8809666700100',
                'email' => 'info@bmch.com.bd',
            ],

            [
                'hospital' => 'Sylhet Medical College Hospital',
                'division' => 'Sylhet',
                'address' => 'Sylhet Medical College, Bakshibazar, Dhaka-1211',
                'location_link' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28954.11039680879!2d91.84899045687385!3d24.888981866267695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x37505537426c0325%3A0x12341139d23360e7!2sSylhet%20MAG%20Osmani%20Medical%20College%20Hospital!5e0!3m2!1sen!2sbd!4v1703358940427!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'phone' => '+8809666700100',
                'email' => 'info@smch.com.bd',
            ],

            [
                'hospital' => 'Rangpur Medical College Hospital',
                'division' => 'Rangpur',
                'address' => 'Rangpur Medical College, Bakshibazar, Dhaka-1211',
                'location_link' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3593.0946577014147!2d89.22965977580948!3d25.767436808367275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e331f209862d71%3A0x712b251636097fe1!2sRangpur%20Medical%20College%20Hospital%2C%20Near%20Central%20Jail%2C%20Rangpur%205400!5e0!3m2!1sen!2sbd!4v1703358971767!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'phone' => '+8809666700100',
                'email' => 'info@ramch.com.bd',
            ],
                
            [
                'hospital' => 'Mymensingh Medical College Hospital',
                'division' => 'Mymensingh',
                'address' => 'Mymensingh Medical College, Bakshibazar, Dhaka-1211',
                'location_link' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3623.5254500587025!2d90.40654652578428!3d24.743167099940212!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x37564f0bb84cc539%3A0xa3d1b21cb813ffd4!2sMymensingh%20Medical%20College!5e0!3m2!1sen!2sbd!4v1703359002178!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'phone' => '+8809666700100',
                'email' => 'info@mmch.com.bd',
            ],


        
        
            
        ]);

    }
}
