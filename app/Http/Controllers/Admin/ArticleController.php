<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticlesRequest;
use App\Http\Requests\UpdateArticlesRequest;
use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\PostHasViewed;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = User::find(Auth::id())->articles;
        return view('auth.articles.index', compact('articles'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('auth.articles.create', compact('tags'));
    }

    public function store(StoreArticlesRequest $request)
    {
        $article = Article::create([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'article_text' => $request->article_text,
            'user_id' => Auth::id(),
            'article_image' => $request->article_image,
        ]);
        if (isset($request['article_image'])) {
            $article->addMediaFromRequest('article_image')->toMediaCollection('articles');
        }

        $article->tag()->sync((array)$request->input('tag'));
        return redirect()->route('articles.index');
    }

    public function edit($id)
    {
        // ... to be discussed later
    }

    public function update(UpdateArticlesRequest $request, $id)
    {
        // ... to be discussed later
    }

    public function destroy($id)
    {
        // ... to be discussed later
    }
    public function getLike($id)
    {
        $article = Article::find($id);

        if ( !$id ) redirect()->route('home');

        if ( Auth::user()->isLike($article) ) {
//            return redirect()->back();
            $article->likes()->delete(['user_id' => Auth::id()]);
        } else {
            $article->likes()->create(['user_id' => Auth::id()]);
        }



        return redirect()->back();
    }
}
