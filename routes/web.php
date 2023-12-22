<?php

use App\Livewire\Settings\Settings;
use Illuminate\Support\Facades\Route;
use App\Livewire\Threads\ThreadsIndex;

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
Route::get('/discuss', ThreadsIndex::class)->name('discuss');
Route::get('/discuss/channels/{channel:slug}', ThreadsIndex::class)->name('discuss.channels');

// Settings
Route::get('settings', Settings::class)->name('settings')->middleware('auth');

require __DIR__ . '/auth.php';
