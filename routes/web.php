<?php

use App\Livewire\Settings\Settings;
use Illuminate\Support\Facades\Route;
use App\Livewire\Threads\ThreadCreate;
use App\Livewire\Threads\ThreadIndex;
use App\Livewire\Threads\ThreadShow;

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

// Discussions
Route::get('/discuss', ThreadIndex::class)->name('discuss.index');
Route::get('/discuss/create', ThreadCreate::class)->name('discuss.create')->middleware('auth');
Route::get('/discuss/channels/{channel:slug}', ThreadIndex::class)->name('discuss.channels');
Route::get('/discuss/{thread:slug}', ThreadShow::class)->name('discuss.show');

// Settings
Route::get('settings', Settings::class)->name('settings')->middleware('auth');

require __DIR__ . '/auth.php';
