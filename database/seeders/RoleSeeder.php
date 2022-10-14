<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            ['id' => 1, 'role' => 'Support'],
            ['id' => 2, 'role' => 'Developer'],
        ];

        Role::insert($role);
    }
}
