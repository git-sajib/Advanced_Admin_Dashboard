<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $title = 'About Us';
        Page::updateOrCreate([
            'page_title' => $title,
            'page_slug' => Str::slug($title),
            'page_short' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry's standard dummy text ever since the 1500s when an unknown printer.",
            'page_long' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry's standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book It has survived not only five centuries but also the leap into electronic typesetting remaining essentially unchanged It was popularised in the 1960s with the release of Letraset sheets contai",
            'meta_title' => 'about us know more about us',
            'meta_keywords' => 'about us, know more, get in touch',
            'meta_description' => 'This is a about page by letting you know about us',
            'is_active' => true,
        ]);
    }
}
