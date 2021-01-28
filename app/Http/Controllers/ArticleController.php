<?php

namespace App\Http\Controllers;

use App\Events\PostHasViewed;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('articles', compact('articles'));
    }
    public function show($slug) {


        $article = Article::where('slug', $slug)->first();

        Cache::put('view', $article->view_count, 1);
//        dd(Cache::get('view'), $article->view_count);
        if ( Cache::get('view') > $article->view_count  ) {
            event(new PostHasViewed($article));
        }



        $comments = Article::find($article->id)->comments;
        $author = Article::find($article->id)->author;
        $categories = Tag::has('articles')
            ->with('articles')
            ->withCount('articles')
            ->orderByDesc('articles_count')
            ->get();

        return view('article', compact('article', 'comments', 'author', 'categories'));
    }
}
