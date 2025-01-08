<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Mobile',
                'description' => 'Description',
                'status' => 'active',
            ],
            [
                'name' => 'Computer',
                'description' => 'Description',
                'status' => 'active',
            ],
        ];

        foreach ($categories as $key => $value) {
            Category::create($value);
        }
    }
}
