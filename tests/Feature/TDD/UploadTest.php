<?php

use App\EnumsScope;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

test('upload file', function () {
    // Storage::fake('avatars');
    $user = User::factory()->create([
        'scope' => EnumsScope::ADMIN,
    ]);

    $file = UploadedFile::fake()->image('avatar.jpg');

    $response = $this->actingAs($user)
                    ->postJson('/dashboard/upload', [
                        'file' => $file,
                        'scope' => 'public'
                    ]);

    $response->assertStatus(302);
});

test('upload no file', function () {
    // Storage::fake('avatars');
    $user = User::factory()->create([
        'scope' => EnumsScope::ADMIN,
    ]);

    $file = "";

    $response = $this->actingAs($user)
                    ->postJson('/dashboard/upload', [
                        'file' => $file,
                        'scope' => 'public'
                    ]);

    $response->assertStatus(422);
    // $response->assertSessionHasErrors('image');
});

it('access denied from guest', function () {
    $file = UploadedFile::fake()->image('avatar.jpg');

    $response = $this->actingAsGuest()
                    ->postJson('/dashboard/upload', [
                        'file' => $file,
                        'scope' => 'public'
                    ]);

    $response->assertStatus(status: 401);
});

it('access denied from user', function () {
    $user = User::factory()->create();

    $file = UploadedFile::fake()->image('avatar.jpg');

    $response = $this->actingAsGuest()
                    ->postJson('/dashboard/upload', [
                        'file' => $file,
                        'scope' => 'public'
                    ]);

    // echo $response->json();
    $response->assertStatus(401);
});

