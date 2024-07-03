<?php

use App\Livewire\User\UserCreateEdit;
use App\Livewire\User\UserTable;
use Illuminate\Support\Facades\Route;
use Naykel\Gotime\RouteBuilder;

(new RouteBuilder('nav-main'))->create();

Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Route::redirect('/', '/users');

Route::prefix('users')->name('users')->group(function () {
    Route::get('/{user}/edit', UserCreateEdit::class)->name('.edit');
    Route::get('/create', UserCreateEdit::class)->name('.create');
    Route::get('/', UserTable::class)->name('.index');
});
