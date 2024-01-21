<?php

use App\Livewire\Settings\Settings;
use App\Livewire\Pages\Threads\ThreadEdit;
use App\Livewire\Pages\Threads\ThreadShow;
use App\Livewire\Pages\Profile\ProfileShow;
use App\Livewire\Pages\Threads\ThreadIndex;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Threads\ThreadCreate;
use App\Livewire\Pages\Notifications\NotificationIndex;

// Threads
Route::permanentRedirect('/', '/discussions');
Route::get('discussions', ThreadIndex::class)->name('threads.index');
Route::get('discussions/new', ThreadCreate::class)->name('threads.create')->middleware('auth');
Route::get('discussions/categories/{category:slug}', ThreadIndex::class)->name('categories');
Route::get('discussions/{thread}', ThreadShow::class)->name('threads.show');
Route::get('discussions/{thread}/edit', ThreadEdit::class)->name('threads.edit')->middleware('auth');

// Profile
Route::get('user/{user:username}', ProfileShow::class)->name('profile.show');

// Notifications
Route::get('notifications', NotificationIndex::class)->name('notifications.index')->middleware('auth');

// Settings
Route::get('settings', Settings::class)->name('settings')->middleware('auth');

require __DIR__ . '/auth.php';
