<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
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


Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => true,
]);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/** Пользователи */
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('profile');

/** Поиск */
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
/** Статьи */
Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles');
Route::get('/article/{slug}', [App\Http\Controllers\ArticleController::class, 'show'])->name('article.open');
Route::post('/article/{slug}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('send.comment');

/** Теги */
Route::get('/tags', [App\Http\Controllers\TagController::class, 'index'])->name('tags');
Route::get('/tags/{id}', [App\Http\Controllers\TagController::class, 'show'])->name('tags.show.front');
Route::get('/tags/{id}/subscribe', [App\Http\Controllers\TagController::class, 'subscribe'])->name('tag.subscribe');
Route::get('/tags/{id}/unsubscribe', [App\Http\Controllers\TagController::class, 'unsubscribe'])->name('tag.unsubscribe');




Route::group([
    'middleware' => 'role:author',
    ], function() {

    /** feed */
    Route::get('/feed', [App\Http\Controllers\HomeController::class, 'feed'])->name('feed');
    Route::get('/favorite', [App\Http\Controllers\Admin\FavoriteController::class, 'show'])->name('favorite');
    Route::post('/users/{id}/subscribe', [App\Http\Controllers\UserController::class, 'subscribe'])->name('user.subscribe');
    Route::delete('/users/{id}/unsubscribe', [App\Http\Controllers\UserController::class, 'unsubscribe'])->name('user.unsubscribe');

    Route::group(['prefix' => 'auth'], function() {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        /** Статьи */
            Route::resource('articles', '\App\Http\Controllers\Admin\ArticleController');
        Route::get('/article/{id}/like', [App\Http\Controllers\Admin\ArticleController::class, 'getLike'])->name('get.like');
        Route::get('/article/{id}/subscribe', [App\Http\Controllers\Admin\FavoriteController::class, 'getFavorite'])->name('get.subscribe');

        /** Избранное */
        Route::get('/favorite/{id}', [App\Http\Controllers\Admin\FavoriteController::class, 'getFavorite'])->name('get.favorite');
        Route::post('/favorite/{id}', [App\Http\Controllers\Admin\FavoriteController::class, 'deleteFavorite'])->name('delete.favorite');

        /** Редактирование профиля */
        Route::get('/edit', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('profile.edit');
        Route::put('/save', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('profile.update');
        Route::get('/confirm/{user}', [App\Http\Controllers\Admin\UserEmailConfirmController::class, 'confirmEmail'])->name('profile.confirm');
        Route::post('/confirm/{user}/send-confirmation-email', [App\Http\Controllers\Admin\UserEmailConfirmController::class, 'sendConfirmationEmail'])->name('profile.send.confirm');
        Route::get('/confirm/{user}/confirm-email/{token}', [App\Http\Controllers\Admin\UserEmailConfirmController::class, 'requestConfirmEmail'])->name('profile.confirm.email');

        /** Подписки */
        Route::get('/subscribes', [App\Http\Controllers\Admin\SubscribeController::class, 'index'])->name('subscribes');
    });
});
Route::group([
    'middleware' => 'role:developer',
    'prefix' => 'admin'
], function() {
    Route::get('/dashboard', [\App\Http\Controllers\Developer\DashboardController::class, 'index'])->name('dashboard-developer');
    Route::resource('/comments', '\App\Http\Controllers\Developer\CommentController');
    Route::resource('/article', '\App\Http\Controllers\Developer\ArticleController');
    Route::get('/article/{id}/restore', '\App\Http\Controllers\Developer\ArticleController@restore')->name('article.restore');
    Route::resource('/tags', '\App\Http\Controllers\Developer\TagController');
    Route::resource('/users', '\App\Http\Controllers\Developer\UserController');
    Route::resource('/roles', '\App\Http\Controllers\Developer\RoleController');
    /** Логи */
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');
});



