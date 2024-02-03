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
                'nid' => null,
                'password' => Hash::make('12345'),
                'role' => 'admin',
                'status' => 'active',
            ],

            //user
            [
                'username' => 'user',
                'email' => 'user@gmail.com',
                'nid' => '1111111111',
                'password' => Hash::make('12345'),
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'username' => 'user1',
                'email' => 'user1@gmail.com',
                'nid' => '1111111112',
                'password' => Hash::make('12345'),
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'username' => 'user2',
                'email' => 'user2@gmail.com',
                'nid' => '1111111113',
                'password' => Hash::make('12345'),
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'username' => 'dmch',
                'email' => 'info@dmc.com.bd',
                'nid' => null,
                'password' => Hash::make('12345'),
                'role' => 'center',
                'status' => 'active',
            ],
            [
                'username' => 'uhvc',
                'email' => 'info@uhvc.com.bd',
                'nid' => null,
                'password' => Hash::make('12345'),
                'role' => 'center',
                'status' => 'active',
            ],
            [
                'username' => 'cmch',
                'email' => 'info@cmch.com.bd',
                'nid' => null,
                'password' => Hash::make('12345'),
                'role' => 'center',
                'status' => 'active',
            ],
            [
                'username' => 'rmch',
                'email' => 'info@rmc.com.bd',
                'nid' => null,
                'password' => Hash::make('12345'),
                'role' => 'center',
                'status' => 'active',
            ],
            [
                'username' => 'kmch',
                'email' => 'info@kmc.com.bd',
                'nid' => null,
                'password' => Hash::make('12345'),
                'role' => 'center',
                'status' => 'active',
            ],
            [
                'username' => 'bmch',
                'email' => 'info@bmch.com.bd',
                'nid' => null,
                'password' => Hash::make('12345'),
                'role' => 'center',
                'status' => 'active',
            ],
            [
                'username' => 'smch',
                'email' => 'info@smch.com.bd',
                'nid' => null,
                'password' => Hash::make('12345'),
                'role' => 'center',
                'status' => 'active',
            ],
            [
                'username' => 'ramch',
                'email' => 'info@ramch.com.bd',
                'nid' => null,
                'password' => Hash::make('12345'),
                'role' => 'center',
                'status' => 'active',
            ],
            [
                'username' => 'mmch',
                'email' => 'info@mmch.com.bd',
                'nid' => null,
                'password' => Hash::make('12345'),
                'role' => 'center',
                'status' => 'active',
            ],

        ]);
    }
}
