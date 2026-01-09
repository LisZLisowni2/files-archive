<?php

use App\Models\User;

test('registerpage can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

it('successful register', function () {
    $data = [
        'username' => 'kaczka',
        'email' => 'kaczka@gmail.com',
        'password' => 'abc12345',
        'password_confirmation' => 'abc12345',
    ];

    $response = $this->post('/register', $data);

    $response->assertStatus(302);
});

it('wrong password register', function () {
    $data = [
        'username' => 'kaczka',
        'email' => 'kaczka@gmail.com',
        'password' => '2155abd',
        'password_confirmation' => 'abc12345',
    ];

    $response = $this->post('/register', $data);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['password']);
});

it('invalid email register', function () {
    $data = [
        'username' => 'kaczka',
        'email' => 'kaczkagmail.com',
        'password' => '2155abd',
        'password_confirmation' => 'abc12345',
    ];

    $response = $this->post('/register', $data);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['email']);
});

it('empty field register', function () {
    $data = [
        'username' => '',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    $response = $this->post('/register', $data);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['email']);
});

it('existed username register', function () {
    $user = User::factory()->create([
        'password' => bcrypt('HIHIHIHI'),
    ]);

    $data = [
        'username' => $user->name,
        'email' => 'nowa@gmail.com',
        'password' => 'axxxxxxx23',
        'password_confirmation' => 'axxxxxxx23',
    ];

    $response = $this->post('/register', $data);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['name']);
});

it('existed email register', function () {
    $user = User::factory()->create([
        'password' => bcrypt('HIHIHIHI'),
    ]);

    $data = [
        'username' => 'JosefStalin',
        'email' => $user->email,
        'password' => 'axxxxxxx23',
        'password_confirmation' => 'axxxxxxx23',
    ];

    $response = $this->post('/register', $data);

    $response->assertStatus(302);
    $response->assertSessionHasErrors(['email']);
});