<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\NotificationsIndex;
use App\Livewire\Pages\SettingsIndex;
use App\Livewire\Pages\ProfileShow;
use App\Livewire\Pages\Threads\ThreadEdit;
use App\Livewire\Pages\Threads\ThreadShow;
use App\Livewire\Pages\Threads\ThreadIndex;
use App\Livewire\Pages\Threads\ThreadCreate;

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
Route::get('notifications', NotificationsIndex::class)->name('notifications.index')->middleware('auth');

// Settings
Route::get('settings', SettingsIndex::class)->name('settings.index')->middleware('auth');

require __DIR__ . '/auth.php';
