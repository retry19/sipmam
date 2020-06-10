<?php

namespace Tests\Feature;

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Pelayan\OrderIndex;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class OrderPesananTest extends TestCase
{
    use WithFaker;

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

    public function test_pelayan_can_login()
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

    public function test_go_to_order_page()
    {
        $response = $this->get('/dashboard/order');
        $response->assertStatus(302);
    }

    public function test_search_menu()
    {
        Livewire::test(OrderIndex::class)
            ->set('menuSearch', 'Sate Ayam')
            ->assertSee('Sate Ayam Spesial');
    }

    public function test_filter_by_categories_makanan()
    {
        Livewire::test(OrderIndex::class)
            ->call('handleCategorySelected', 'makanan')
            ->assertDontSee('Ice Blue');
    }

    public function test_filter_by_categories_minuman()
    {
        Livewire::test(OrderIndex::class)
            ->call('handleCategorySelected', 'minuman')
            ->assertDontSee('Sate Ayam Spesial');
    }
}
