<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category; // 11.22


class CategorySeeder extends Seeder
{
    private $category; // 11.22
    public function __construct(Category $category){
        $this->category = $category;
        // Seeder is used to populate your data during a test if the database is still fresh
        // Seeder is a default value to a certain tables in our database.
        // We are going to make a default 6 categories.
    }
    /**
     * Run the database seeds.
     */
    public function run() { // 11.22
        $categories = [
            [
            'name' => 'Travel',
            'created_at' => NOW(),
            'updated_at' => NOW()
            ],
            [
            'name' => 'Food',
            'created_at' => NOW(),
            'updated_at' => NOW()
            ],
            [
            'name' => 'Lifestyle',
            'created_at' => NOW(),
            'updated_at' => NOW()
            ],
            [
            'name' => 'Music',
            'created_at' => NOW(),
            'updated_at' => NOW()
            ],
            [
            'name' => 'Career',
            'created_at' => NOW(),
            'updated_at' => NOW()
            ],
            [
            'name' => 'Movie',
            'created_at' => NOW(),
            'updated_at' => NOW()
            ]
        ];
        $this->category->insert($categories);
    }

}
