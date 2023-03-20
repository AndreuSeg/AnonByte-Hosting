<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'role_id' => 3,
            'username' => 'admin',
            'name' => 'admin',
            'lastname' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'stack_created' => false,
            'password' => '$2a$10$XYRILlgas6FmUiI/YbVuyeSn5OJqps.rkI9Gk0hO8PErXc3ZxmIKS',
            'remember_token' => Str::random(10),
        ]);
    }
}
