<?php

namespace Tests\Feature;

use Tests\TestCase;

class GuestTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_go_to_home_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_go_to_menu_page()
    {
        $res = $this->get('/menu');
        $res->assertStatus(200);
    }

    public function test_go_to_login_page()
    {
        $res = $this->get('/login');
        $res->assertStatus(200);
    }

    public function test_guest_try_go_to_dashboard_page()
    {
        $res = $this->get('/dashboard');
        $res->assertRedirect('/login');
    }
}
