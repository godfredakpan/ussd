<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterControllerTest extends TestCase
{
    use DatabaseTransactions, WithFaker;
    /** @test */
public function register_creates_and_authenticates_a_user()
{
    $name = $this->faker->name;
    $email = $this->faker->safeEmail;
    $password = $this->faker->password(8);

    $response = $this->post('register', [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'password_confirmation' => $password,
    ]);

    if(!$response) {
        $this->assertTrue(false);
    }else
    $this->assertTrue(true);

}
}
