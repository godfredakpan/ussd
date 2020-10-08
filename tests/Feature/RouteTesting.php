<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class RouteTesting extends TestCase
{
    /**
     * A basic test example.
     *@test
     * @return void
     */
    public function AllRoutes()
    {
        // Account is created for a user
        $user = factory(User::class)->create([
            'id' => random_int(1, 100),
            'password' => bcrypt($password = 'password'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
            'remember' => 'on',
        ]);

        // User is logged in and
        // cookie assertion goes here
        $this->assertAuthenticatedAs($user);

        // User visits the dashboard after logging in
        $response = $this->get(route('dashboard'));

        $response->assertStatus(200);

        // User creates account for another user
        $response = $this->get(route('create_user'));

        $response->assertStatus(200);

        // Pending Request page
        $response = $this->get(route('request.pending'));

        $response->assertStatus(200);

        // Declined Request page
        $response = $this->get(route('request.declined'));

        $response->assertStatus(200);

        // Request Making page
        $response = $this->get(route('create_vendor.request'));

        $response->assertStatus(200);


    }
}
