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
        //Categories
        Category::create([
            'name' => 'Game',
        ]);
        Category::create([
            'name' => 'Computer',
        ]);
        Category::create([
            'name' => 'Kitchen',
        ]);
    }
}