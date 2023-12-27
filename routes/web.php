<?php

use App\Livewire\Settings\Settings;
use App\Livewire\Threads\ThreadEdit;
use App\Livewire\Threads\ThreadShow;
use App\Livewire\Profile\ProfileShow;
use App\Livewire\Threads\ThreadIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Threads\ThreadCreate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Threads
Route::get('discussions', ThreadIndex::class)->name('threads.index');
Route::get('discussions/create', ThreadCreate::class)->name('threads.create')->middleware('auth');
Route::get('discussions/channels/{channel:slug}', ThreadIndex::class)->name('channels');
Route::get('discussions/{thread:slug}', ThreadShow::class)->name('threads.show');
Route::get('discussions/{thread:slug}/edit', ThreadEdit::class)->name('threads.edit')->middleware('auth');

// Profile
Route::get('user/{user:username}', ProfileShow::class)->name('profile.show');

// Settings
Route::get('settings', Settings::class)->name('settings')->middleware('auth');

require __DIR__ . '/auth.php';
