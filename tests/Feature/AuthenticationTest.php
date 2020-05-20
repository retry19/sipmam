<?php

namespace Tests\Feature;

use App\Http\Livewire\Auth\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function can_login()
    {
        $user = factory('App\User')->create();
        $this->actingAs($user);

        Livewire::test(Login::class)
            ->set('username', $user->username)
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect('/');
        
        $this->assertAuthenticatedAs($user);
    }

    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
