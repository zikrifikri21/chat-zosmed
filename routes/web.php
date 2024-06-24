<?php

use App\Http\Controllers\ListChatController;
use App\Http\Controllers\OauthController;
use Illuminate\Support\Facades\Route;
use \App\Livewire\Chat;

Route::get('/', fn () => redirect()->route('login'));
Route::controller(OauthController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('chat/all', [ListChatController::class, 'index'])->name('dashboard');
    Route::get('chat/{user:name}', Chat::class)->name('chat');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__ . '/auth.php';
