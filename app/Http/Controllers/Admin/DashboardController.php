<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userPosts = Article::select('id')->where('user_id', Auth::id())->get()->toArray();

//        $countComments = DB::table('articles')
//            ->join('comments', 'articles.id', '=', 'comments.article_id')
//            ->join('users', 'articles.user_id', '=', 'users.id')
//            ->get();

        $aticles = Article::whereIn('id', $userPosts)
            ->withCount('comments')
            ->withCount('likes')
            ->get();

//        dd($aticles);

        return view('auth.dashboard', compact('aticles'));
    }
}
