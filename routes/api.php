<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/user/{id}', [App\Http\Controllers\API\UserController::class, 'index']);
Route::get('/user/{id}/subscribes', [App\Http\Controllers\API\UserController::class, 'subscribes']);
Route::get('/articles/{id}/comments', [App\Http\Controllers\API\ArticleController::class, 'comments']);
Route::get('/articles/user/{id}', [App\Http\Controllers\API\ArticleController::class, 'userArticle']);
Route::resource('articles', '\App\Http\Controllers\API\ArticleController');
Route::post('/filter', [App\Http\Controllers\API\FilterController::class, 'index']);
Route::get('/top-articles', [App\Http\Controllers\API\ArticleController::class, 'top']);
Route::get('/feed', [App\Http\Controllers\API\ArticleController::class, 'feed']);
Route::get('/tags', [App\Http\Controllers\API\TagController::class, 'tags']);
Route::get('/subscribe-tags/{id}', [App\Http\Controllers\API\TagController::class, 'subscribeTags']);
Route::get('/tags/{id}', [App\Http\Controllers\API\TagController::class, 'tagsArticles']);
Route::post('/tags/{id}/subscribe', [App\Http\Controllers\API\TagController::class, 'subscribe']);
Route::delete('/tags/{id}/unsubscribe', [App\Http\Controllers\API\TagController::class, 'unsubscribe']);
Route::post('/search', [App\Http\Controllers\API\SearchController::class, 'index']);
Route::resource('/mailer', '\App\Http\Controllers\API\MailerController');


//Route::resource('/article', [App\Http\Controllers\API\ArticleController::class]);
