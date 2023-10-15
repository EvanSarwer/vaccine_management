<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            //admin
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345'),
                'role' => 'admin',
                'status' => 'active',
            ],

            //user
            [
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('12345'),
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'username' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('12345'),
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'username' => 'user2',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('12345'),
                'role' => 'user',
                'status' => 'active',
            ],
        ]);
    }
}
