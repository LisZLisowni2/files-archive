<?php

use App\EnumsScope;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

test('uploadpage can be rendered', function () {
    $user = User::factory()->create([
        'scope' => EnumsScope::ADMIN,
    ]);

    $this->actingAs($user)
        ->getJson('/dashboard/upload')
        ->assertStatus(200);
});

it('access denied from guest', function () {
    $this->actingAsGuest()
        ->getJson('/dashboard/upload')
        ->assertStatus(401);
});

it('access denied from user', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->getJson('/dashboard/upload')
        ->assertStatus(403);
});