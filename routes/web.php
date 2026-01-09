<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/upload', [FileController::class, 'upload'])->name('file.upload');
Route::get('/download', [FileController::class, 'download'])->name('file.download');
Route::get('/login', function () {
    return view('auth.login');
})->name('page.login')->middleware('guest');
Route::get('/register', function () {
    return view('auth.register');
})->name('page.register')->middleware('guest');

Route::name('dashboard')->prefix('/dashboard')->middleware('auth')->group(function () {
    Route::get('/', function () {
        $public = File::allFiles(public_path('/storage'));
        $private = File::allFiles(storage_path('/app/private'));

        $public = collect($public)->map(function ($file) {
            if (in_array($file->getExtension(), ['png', 'jpg', 'jpeg', 'webp', 'gif', 'ico', 'svg', 'avif', 'bmp'])) {
                $path = $file->getRelativePathname();
                return str_replace(public_path(''), '', "$path");
            }
        });

        $private = collect($private)->map(function ($file) {
            if (in_array($file->getExtension(), ['png', 'jpg', 'jpeg', 'webp', 'gif', 'ico', 'svg', 'avif', 'bmp']))
                return str_replace(storage_path(''), '', $file->getRelativePathname());
        });

        return view('dashboard', ['public' => $public, 'private' => $private]);
    });
    Route::get('/upload', function () {
        Gate::authorize('access-admin');
        return view('dashboard.upload');
    })
    ->name('.admin.upload');
    Route::post('/download/public', [FileController::class, 'downloadPublic'])->name('.file.download.public');
    Route::post('/download/private', [FileController::class, 'download'])->name('.file.download.private');
    Route::post('/upload', [FileController::class, 'uploadImg'])
        ->name('.admin.upload.action');
});