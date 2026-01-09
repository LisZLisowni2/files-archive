<?php

use App\Models\User;
use function Pest\Laravel\assertAuthenticatedAs;

test('loginpage can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

it('successful login', function () {
    $user = User::factory()->create([
        "password" => bcrypt("test1234"),
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'test1234',
    ]);

    $response->assertRedirect('/dashboard');
    assertAuthenticatedAs($user);
});

it('wrong password login', function () {
    $user = User::factory()->create([
        "password" => bcrypt("test1234"),
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'test9876',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

it('non-existed email login', function () {
    $user = User::factory()->create([
        "password" => bcrypt("test1234"),
    ]);

    $response = $this->post('/login', [
        'email' => "xd@pl.pl",
        'password' => 'test1234',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

it('empty field login', function () {
    $user = User::factory()->create([
        "password" => bcrypt("test1234"),
    ]);

    $response = $this->post('/login', [
        'email' => "",
        'password' => '',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});