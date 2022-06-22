<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/websites');
});

Route::any('websites', [WebsiteController::class, 'index'])->name('websites');
Route::get('websites/load', [WebsiteController::class, 'load'])->name('websites.load');
Route::get('websites/{website}', [WebsiteController::class, 'show'])->name('websites.show');
Route::post('websites/{website}/subscribe', [SubscriptionController::class, 'subscribe'])->name('websites.subscribe');

Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
