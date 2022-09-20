<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priority_level = [
            ['id' => 1, 'priority_level' => 'High'],
            ['id' => 2, 'priority_level' => 'Mid'],
            ['id' => 3, 'priority_level' => 'Low']
        ];

        Priority::insert($priority_level);
    }
}
