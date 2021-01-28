<?php

namespace App\Providers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        // get top categories
        View::composer(['layouts.rightside', 'layouts.footer'], function ($view) {

            $view->with('categories', Tag::has('articles')
                ->with('articles')
                ->withCount('articles')
                ->orderByDesc('articles_count')
                ->get());

            $view->with('users', User::has('articles')
                ->with('articles')
                ->withCount('articles')
                ->orderByDesc('articles_count')
                ->take(5)
                ->get());
        });

        // get users subscribes categories
        View::composer(['layouts.leftside'], function ($view) {
            $view->with('user_category', DB::table('subscribable')
                ->where('subscribable_type', 'App\Models\Tag')
                ->where('subscribable.user_id', Auth::id())
                ->join('tags', function($join) {
                    $join->on('tags.id', '=', 'subscribable.subscribable_id');
                })
                ->get());


        });

        // all posts users
        View::composer(['auth.layouts.master', 'auth.analytics'], function ($view) {
            $view->with('comments_count', Auth::user()->articles->sum('comments_count'));
            $view->with('likes_count', Auth::user()->articles->sum('likes_count'));
            $view->with('articles_count', Auth::user()->articles->count());
            $view->with('subscribes', Auth::user()->subscribes->count());
        });

        // Get user
        View::composer(['*'], function ($view) {
            $view->with('auth_user', Auth::user());

        });

    }

}
