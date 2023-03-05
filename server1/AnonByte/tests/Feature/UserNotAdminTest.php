<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserNotAdminTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserNotAdmin()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin.users.users-table');

        $response->assertStatus(404);
    }
}
