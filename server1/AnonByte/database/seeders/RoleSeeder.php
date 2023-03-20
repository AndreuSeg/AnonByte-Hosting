<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->createMany([
            [
                'name' => 'User',
                'level' => 'user'
            ],
            [
                'name' => 'Administrator',
                'level' => 'admin'
            ],
            [
                'name' => 'Superadministrator',
                'level' => 'superadmin'
            ]
        ]);
    }
}
