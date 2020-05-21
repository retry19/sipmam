<?php

namespace Tests\Feature;

use App\Http\Livewire\Auth\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_go_to_login_page()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_user_can_login()
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

    public function test_wrong_password_and_show_error_message()
    {
        $user = factory('App\User')->create();
        $this->actingAs($user);

        Livewire::test(Login::class)
            ->set('username', $user->username)
            ->set('password', 'password123')
            ->call('login')
            ->assertSee('Username atau Password yang anda masukan salah ☹');
    }

    public function test_user_not_input_username_then_show_message_validation()
    {
        Livewire::test(Login::class)
            ->set('username', '')
            ->call('login')
            ->assertSee('The username field is required.');
    }

    public function test_user_not_input_password_then_show_message_validation()
    {
        Livewire::test(Login::class)
            ->set('password', '')
            ->call('login')
            ->assertSee('The password field is required.');
    }

}
