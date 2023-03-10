<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory(100)->stackCreated()->create();
        // \App\Models\User::factory(10)->unverified()->create();
        // Role::factory()->createMany([
        //     [
        //         'name' => 'User',
        //         'level' => 'user'
        //     ],
        //     [
        //         'name' => 'Administrator',
        //         'level' => 'admin'
        //     ],
        //     [
        //         'name' => 'Superadministrator',
        //         'level' => 'superadmin'
        //     ]
        // ]);
    }
}
