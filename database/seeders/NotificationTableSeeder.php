<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notifications')->insert([

            //Centers
            [
                'user_id' => 1,
                'type' => 'message',
                'status' => 'unseen',
                'email' => 'user1@gmail.com',
                'phone' => '+8809666700100',
                'message' => 'Having problem with vaccine registration.',
                'created_at' => '2021-05-01 12:00:00',
                
            ],

            [
                'user_id' => 1,
                'type' => 'message',
                'status' => 'seen',
                'email' => 'user1@gmail.com',
                'phone' => '+8809666700100',
                'message' => 'Having problem with vaccine registration.',
                'created_at' => '2021-05-01 12:00:00',
            ],

            [
                'user_id' => 1,
                'type' => 'message',
                'status' => 'unseen',
                'email' => 'user@gmail.com',
                'phone' => null,
                'message' => 'Having problem with vaccine registration.',
                'created_at' => '2023-05-05 12:00:00',
            ],

            [
                'user_id' => 2,
                'type' => 'message',
                'status' => 'seen',
                'email' => 'admin@gmail.com',
                'phone' => '+8809666700100',
                'message' => 'Having problem with vaccine registration.',
                'created_at' => '2023-07-01 12:00:00',
            ],

            [
                'user_id' => 2,
                'type' => 'message',
                'status' => 'unseen',
                'email' => 'admin@gmail.com',
                'phone' => null,
                'message' => 'Having problem with vaccine registration.',
                'created_at' => '2023-07-05 12:00:00',
            ]


        
        
            
        ]);

    }
}
