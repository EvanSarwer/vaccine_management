<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blog_posts')->insert([
            [
                'title' => 'Blog Post 1',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
                'image' => 'https://picsum.photos/200/300',
                'link' => 'https://picsum.photos/200/300',
            ],
            [
                'title' => 'Blog Post 2',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
                'image' => 'https://picsum.photos/200/300',
                'link' => 'https://picsum.photos/200/300',
            ],
            
        ]);
    }
}
