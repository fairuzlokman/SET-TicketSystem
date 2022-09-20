<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            ['id' => 1, 'category' => 'Adnexio'],
            ['id' => 2, 'category' => 'Meniaga'],
            ['id' => 3, 'category' => 'Decoris']
        ];

        Category::insert($category);
    }
}
