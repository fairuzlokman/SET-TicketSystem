<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            ['id' => 1, 'status' => 'Complete'],
            ['id' => 2, 'status' => 'In-progress'],
            ['id' => 3, 'status' => 'Backlog']
        ];

        Status::insert($status);
    }
}
