<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_register()
    {
      $response = $this->postJson(route('user.register'), ['name' => 'nikoloz', 'email' => 'nikoloz@gmail.com' , 'password' => '12345678', 'password_confirmation' => '12345678']);
      $this->assertDatabaseHas('users', ['name' => 'nikoloz']);
    $response->assertStatus(200);
    }
}