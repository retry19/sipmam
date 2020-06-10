<?php

namespace Tests\Feature;

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Logout;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class AuthenticationTest extends TestCase
{
    // use RefreshDatabase;
    use WithFaker;

    public function test_go_to_login_page()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    private function createUser()
    {
        return \App\User::create([
            'nama' => $this->faker->name,
            'no_hp' => $this->faker->e164PhoneNumber,
            'role' => 'pelayan',
            'username' => $this->faker->unique()->userName,
            'password' => bcrypt('password'),
        ]);
    }

    public function test_user_can_login()
    {
        $user = $this->createUser();
        $this->actingAs($user);

        Livewire::test(Login::class)
            ->set('username', $user->username)
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect('/dashboard');

        $this->assertAuthenticatedAs($user);
    }

    public function test_wrong_password_and_show_error_message()
    {
        $user = $this->createUser();
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
            ->assertSee('Username harus diisi!.');
    }

    public function test_user_not_input_password_then_show_message_validation()
    {
        Livewire::test(Login::class)
            ->set('password', '')
            ->call('login')
            ->assertSee('Password harus diisi!.');
    }

    public function test_user_can_logout()
    {
        $user = $this->createUser();
        $this->actingAs($user);

        Livewire::test(Login::class)
            ->set('username', $user->username)
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect('/dashboard');

        $this->assertAuthenticatedAs($user);

        Livewire::test(Logout::class)
            ->call('logout')
            ->assertRedirect('/login');
    }
}
