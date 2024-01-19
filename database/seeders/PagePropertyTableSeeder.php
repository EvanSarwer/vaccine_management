<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagePropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('page_properties')->insert([
            [
                'title' => 'Striving for a Healthier Bangladesh - Vaccine Management Initiative',
                'subtitle' => "Facilitating Health and Well-being: Navigating Bangladesh's Vaccine Landscape with Ease and Efficiency.",
                'testimonial_text' => 'Chronicling my illness on PLM over the past 8 years has served as a solid longitudinal record of the trajectory of my conditions, a record arguably more significant to me than my formal medical records.',
                'testimonial_author_name' => 'Dr. Md. Abdul Mottalib',
                'testimonial_author_photo' => 'testimonial_author_photo.png',
                'vaccination_title1' => 'Advice and experience',
                'vaccination_description1' => 'Tap into the shared knowledge of our community and see what has worked for other members.',
                'vaccination_image1' => 'vaccination1.png',
                'vaccination_title2' => 'Share and compare',
                'vaccination_description2' => 'See how your experience aligns with the community and if another treatment can help.',
                'vaccination_image2' => 'vaccination2.png',
                'vaccination_title3' => 'Trend data',
                'vaccination_description3' => 'Understand what to expect when starting a new treatment.',
                'vaccination_image3' => 'vaccination3.png',
            ],
        ]);
    }
}
