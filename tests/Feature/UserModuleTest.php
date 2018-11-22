<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function carga_lista_de_usuarios()
    {
        factory(User::class)->create([
            'name' => 'Pedro'
        ]);

        factory(User::class)->create([
            'name' => 'Juan'
        ]);
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee("Listado de usuarios")
            ->assertSee("Pedro")
            ->assertSee("Juan");
    }

    /** @test */
    function carga_lista_de_usuarios_vacio()
    {
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee("No hay usuarios registrados");
    }

    /** @test */
    function carga_pagina_detalle_usuario()
    {
        $user = factory(User::class)->create([
            'name' => 'Rachel Lemus'
        ]);

        $this->get('/usuarios/'.$user->id)
            ->assertStatus(200)
            ->assertSee("Rachel Lemus");
    }

    /** @test */
    function it_muestra_404_usuario_no_encontrado()
    {
        $this->get('/usuarios/999')
            ->assertStatus(404)
            ->assertSee("La página no encontrada.");
    }

    /** @test */
    function carga_pagina_crear_usuario()
    {
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee("Crear Nuevo Usuario");
    }

    /** @test */
    function it_crear_un_nuevo_usuario()
    {
        $this->post('/usuarios', [
            'name' => 'Wlemus',
            'email' => 'wlemus@gmail.com',
            'password' => '123456789'
        ])->assertRedirect(route('users.index'));

        // $this->assertDatabaseHas('users', [
        //     'name' => 'Wlemus',
        //     'email' => 'wlemus@gmail.com',
        // ]);
        $this->assertCredentials([
            'name' => 'Wlemus',
            'email' => 'wlemus@gmail.com',
            'password' => '123456789'
        ]);
    }

    /** @test */
    function it_campos_obligatorios()
    {
        $this->from(route('users.create'))
            ->post('/usuarios')
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['name', 'email', 'password']);

        // $this->assertDatabaseMissing('users', [
        //     'email' => 'wlemus@gmail.com',
        // ]);
        $this->assertEquals(0, User::count());
    }

    /** @test */
    function it_email_unico()
    {
        factory(User::class)->create([
            'email' => 'wlemus@gmail.com'
        ]);

        $this->from(route('users.create'))
            ->post('/usuarios', [
                'name' => 'Wlemus',
                'email' => 'wlemus@gmail.com',
                'password' => '123456789'
            ])
            ->assertRedirect(route('users.create'))
            ->assertSessionHasErrors(['email']);

        // $this->assertDatabaseMissing('users', [
        //     'email' => 'wlemus@gmail.com',
        // ]);
        $this->assertEquals(1, User::count());
    }

    /** @test */
    function carga_pagina_editar_usuario()
    {
        $user = factory(User::class)->create();

        $this->get("/usuarios/{$user->id}/editar")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee("Editar Usuario")
            ->assertViewHas('user');
    }

    /** @test */
    function it_edit_usuario()
    {
        // $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $this->put("/usuarios/{$user->id}", [
                'name' => 'Wlemus',
                'email' => 'wlemus@gmail.com',
                'password' => '123456789'
            ])->assertRedirect(route('users.show', ['user' => $user]));

        $this->assertCredentials([
            'name' => 'Wlemus',
            'email' => 'wlemus@gmail.com',
            'password' => '123456789'
        ]);
    }

    /** @test */
    function it_edit_usuario_password_opcional()
    {
        // $this->withoutExceptionHandling();
        $oldPassword = 'CLAVEANTERIOR';
        $user = factory(User::class)->create([
            'password' => bcrypt($oldPassword)
        ]);

        $this->put("/usuarios/{$user->id}", [
            'name' => 'Wlemus',
            'email' => 'wlemus@gmail.com',
            'password' => ''
        ])->assertRedirect(route('users.show', ['user' => $user]));

        // dd($user);

        // $this->assertCredentials([
        //     'name' => 'Wilfred Lemus',
        //     'email' => 'wlemus123@gmail.com',
        //     'password' => 'CLAVEANTERIOR'
        // ]);
    }

    /** @test */
    function it_edit_usuario_email_unico()
    {
        $user = factory(User::class)->create([
            'email' => 'wlemus@gmail.com'
        ]);

        $this->put("/usuarios/{$user->id}", [
            'name' => 'Wlemus',
            'email' => 'wlemus@gmail.com',
            'password' => '123456789'
        ])->assertRedirect(route('users.show', ['user' => $user]));


        $this->assertCredentials([
            'name' => 'Wlemus',
            'email' => 'wlemus@gmail.com',
            'password' => '123456789'
        ]);
    }

    /** @test */
    function it_show_vista_delete_un_usuario()
    {
        $user = factory(User::class)->create();

        $this->get("/usuarios/{$user->id}/eliminar")
            ->assertStatus(200)
            ->assertViewIs('users.delete')
            ->assertSee("Eliminar el Usuario")
            ->assertViewHas('user');

    }

    /** @test */
    function it_delete_un_usuario()
    {
        $user = factory(User::class)->create();

        $this->delete("/usuarios/{$user->id}")
            ->assertRedirect(route('users.index'));

        // $this->assertEquals(0, User::count());
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);

    }

}
