<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagePropertyTabTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('page_property_tabs')->insert([
            // Tab 1: Meet others like me
            [
                'tab_name' => 'Meet others like me',
                'title' => 'Share your story',
                'description' => "Introduce yourself to the community. Share as little, or as much, about your health journey and the support you're looking for.",
                'image' => 'day-1-1.png'
            ],
            [
                'tab_name' => 'Meet others like me',
                'title' => 'Find your community',
                'description' => "We offer 70 communities that cover 2,800 conditions where you can make helpful connections and be part of a safe community.",
                'image' => 'day-1-2.png'
            ],
            [
                'tab_name' => 'Meet others like me',
                'title' => 'Join the discussion',
                'description' => "Find personalized answers, offer advice and feel supported by people who know what you are going through.",
                'image' => 'day-1-3.png'
            ],


            // Tab 2: Learn about my condition
            [
                'tab_name' => 'Learn about my condition',
                'title' => 'Discover the next step in your care',
                'description' => "Explore first-hand treatment reviews from people living with your condition to uncover personalized and effective options.",
                'image' => 'day-2-1.png'
            ],
            [
                'tab_name' => 'Learn about my condition',
                'title' => 'Get insights into your condition',
                'description' => "Ask questions that matter to you – and get “real, lived experiences” that help you move forward.",
                'image' => 'day-2-2.png'
            ],
            [
                'tab_name' => 'Learn about my condition',
                'title' => 'Learn new ways to influence your health outcomes',
                'description' => "Join in conversations about treatments, diagnosis, and recovery journey.",
                'image' => 'day-2-3.png'
            ], 


            // Tab 3: Track my health
            [
                'tab_name' => 'Track my health',
                'title' => 'Make informed care decisions',
                'description' => "Track your conditions, symptoms and treatment effectiveness in one place so you can see your complete health picture.",
                'image' => 'day-3-1.png'
            ],
            [
                'tab_name' => 'Track my health',
                'title' => 'Take control of your healthcare decision making',
                'description' => "Get personalized education, tools, and motivational nudges that will help you take charge of your health.",
                'image' => 'day-3-2.png'
            ],
            [
                'tab_name' => 'Track my health',
                'title' => 'Get the most out of your care team',
                'description' => "Easily share your health data with doctors, caregivers, family or friends to lead to more efficient conversations and effective care plans.",
                'image' => 'day-3-3.png'
            ],
            


        ]);
    }
}
