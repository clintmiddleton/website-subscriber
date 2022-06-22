<?php

use App\Http\Controllers\Api\PostApiController;
use App\Http\Controllers\Api\WebsiteApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('websites', [WebsiteApiController::class, 'index'])->name('api.websites');
Route::post('posts', [PostApiController::class, 'store'])->name('api.posts');
