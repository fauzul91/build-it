<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate([
            'name' => 'Web Development',
            'slug' => 'web-development',
        ]);
        Category::firstOrCreate([
            'name' => 'Mobile Development',
            'slug' => 'mobile-development',
        ]);
        Category::firstOrCreate([
            'name' => 'UI/UX Design',
            'slug' => 'ui-ux-design',
        ]);
        Category::firstOrCreate([
            'name' => 'Artificial Intelligence',
            'slug' => 'artificial-intelligence',
        ]);
    }
}
