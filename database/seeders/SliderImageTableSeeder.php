<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('slider_images')->insert([
            [
                'image' => 'home_hero_meet_bd.png',
            ],
            [
                'image' => 'home_hero_learn_bd.png',
            ],
            [
                'image' => 'home_hero_track_bd.png',
            ],
        ]);
    }
}
