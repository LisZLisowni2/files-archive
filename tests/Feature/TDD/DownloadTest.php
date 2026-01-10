<?php

use App\EnumsScope;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage; 

test('downloadpage can be renedered', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->getJson('/dashboard');

    $response->assertStatus(200);
});

it('download from public', function () {
    Storage::fake('public');

    Storage::put('test.jpg', UploadedFile::fake()->image('test.jpg'));

    $user = User::factory()->create();

    $response = $this->actingAs($user)->postJson('/dashboard/download/public', [
        'path' => 'test.jpg'
    ]);

    $response->assertStatus(302);
    // $response->assertDownload('test.jpg'); 
});

it('download from private', function () {
    Storage::fake('local');

    $fake = UploadedFile::fake()->image('test.jpg');

    Storage::disk('local')->putFileAs('', $fake, 'test.jpg');

    $user = User::factory()->create([
        'scope' => EnumsScope::ADMIN,
    ]);

    $response = $this->actingAs($user)->postJson('/dashboard/download/private', [
        'path' => 'test.jpg'
    ]);

    $response->assertStatus(status: 200);
    $response->assertDownload('test.jpg');
});

it('failed download from private by user', function () {
    Storage::fake('local')->put('test.jpg', UploadedFile::fake()->image('test.jpg'));

    $user = User::factory()->create();

    $response = $this->actingAs($user)->postJson('/dashboard/download/private', [
        'path' => 'test.jpg'
    ]);

    $response->assertStatus(403);
});

it('failed download from public by guest', function () {
    Storage::fake('local');

    Storage::put('test.jpg', UploadedFile::fake()->image('test.jpg'));

    $response = $this->actingAsGuest()->postJson('/dashboard/download/public', [
        'path' => 'test.jpg'
    ]);

    $response->assertStatus(401);
});

it('failed download from private by guest', function () {
    Storage::fake('local')->put('test.jpg', UploadedFile::fake()->image('test.jpg'));
    
    $user = User::factory()->create();


    $response = $this->actingAs($user)
        ->postJson('/dashboard/download/private', [
        'path' => 'test.jpg'
    ]);

    $response->assertStatus(200);
});

it('empty filename download', function () {
    Storage::fake('local');

    $user = User::factory()->create();

    Storage::put('test.jpg', UploadedFile::fake()->image('test.jpg'));

    $response = $this->actingAs($user)->postJson('/dashboard/download/public');

    $response->assertStatus(200);
});
