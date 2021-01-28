<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\Subscribe;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $role = Role::create(['name' => 'author']);
//        $role2 = Role::create(['name' => 'developer']);
//        $permission = Permission::create(['name' => 'edit author']);
//
//        $role = Role::findById(1);
//        $permission = Permission::findById(1);


        $articles = Article::
            join('users', 'articles.user_id', '=', 'users.id')
            ->where('status', '=', 2)
            ->with('comments')
            ->with('likes')
            ->join('media', function ($join) {
                $join->on('articles.id', '=', 'media.model_id')
                    ->where('media.model_type', '=', 'App\Models\Article');
            })
            ->select('users.name as name', 'articles.*', 'users.id as user_id', 'media.file_name as image', 'media.id as image_id')
            ->get();

        $tags = Tag::
            leftJoin('media', function ($join) {
                $join->on('tags.id', '=', 'media.model_id')
                    ->where('media.model_type', '=', 'App\Models\Tag');
            })
            ->select('tags.*', 'media.id as image_id', 'media.file_name as image')
            ->get();

        return view('welcome', ['articles' => $articles, 'tags' => $tags]);
    }
    public function dashboard()
    {
        return view('auth.dashboard');
    }
    public function feed()
    {
        // Все id категорий, на которые подписан пользователь
        $fe = Subscribe::select('subscribable_id')->where('user_id', Auth::id())->where('subscribable_type', 'App\Models\Tag')->get()->flatten('subscribable_id')->toArray();

        $feed = Article::
            join('tags', 'articles.tag', '=', 'tags.id')
            ->whereIn('tag', $fe)
            ->join('media', function ($join) {
                $join->on('articles.id', '=', 'media.model_id')
                    ->where('media.model_type', '=', 'App\Models\Article');
            })
            ->with('author')
            ->with('comments')
            ->with('likes')
            ->select('articles.*', 'media.file_name as image', 'media.id as image_id')
            ->get();


        return view('feed', compact('feed'));
    }
}
