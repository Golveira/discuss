<?php

use App\Livewire\Home\HomeIndex;
use App\Livewire\Settings\Settings;
use App\Livewire\Threads\ThreadEdit;
use App\Livewire\Threads\ThreadShow;
use App\Livewire\Profile\ProfileShow;
use App\Livewire\Threads\ThreadIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Threads\ThreadCreate;
use App\Livewire\Notifications\NotificationIndex;

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

// Home
Route::get('/', HomeIndex::class)->name('home');

// Notifications
Route::get('notifications', NotificationIndex::class)->name('notifications.index')->middleware('auth');

// Threads
Route::get('discussions', ThreadIndex::class)->name('threads.index');
Route::get('discussions/new', ThreadCreate::class)->name('threads.create')->middleware('auth');
Route::get('discussions/categories/{category:slug}', ThreadIndex::class)->name('categories');
Route::get('discussions/{thread}', ThreadShow::class)->name('threads.show');
Route::get('discussions/{thread}/edit', ThreadEdit::class)->name('threads.edit')->middleware('auth');

// Profile
Route::get('user/{user:username}', ProfileShow::class)->name('profile.show');

// Settings
Route::get('settings', Settings::class)->name('settings')->middleware('auth');

require __DIR__ . '/auth.php';
