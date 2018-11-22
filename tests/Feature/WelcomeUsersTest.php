<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /** @test */
    public function saludo_usuario_con_nickname()
    {
        $this->get("saludo/wilfred/walr")
            ->assertStatus(200)
            ->assertSee("Bienvenido Wilfred, tu nickname es walr");
    }

    /** @test */
    public function saludo_usuario_sin_nickname()
    {
        $this->get("saludo/wilfred")
            ->assertStatus(200)
            ->assertSee("Bienvenido Wilfred, sin nickname");
    }
}
