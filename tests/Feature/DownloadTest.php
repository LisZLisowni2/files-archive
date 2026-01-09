<?php

// use App\EnumsScope;
// use App\Models\User;

// test('dashboard could be rendered', function () {
//     $user = User::factory()->create();

//     $this->actingAs($user)
//         ->get('/dashboard')
//         ->assertStatus(200);
// });

// it('can download file (admin)', function () {
//     $user = User::factory()->create([
//         "scope" => EnumsScope::ADMIN,
//     ]);

//     $this->actingAs($user)
//         ->get('/download')
//         ->assertStatus(200)
//         ->assertDownload('erecepta.png');
// });

// it('can not download file (user)', function () {
//     $user = User::factory()->create([]);

//     $this->actingAs($user)
//         ->get('/download')
//         ->assertStatus(403);
// });

// it('can not download file (guest)', function () {
//     $this->actingAsGuest()
//         ->get('/download')
//         ->assertStatus(403);
// });
