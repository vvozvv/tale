<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {

        $article_id = Article::where('slug', $request->route('slug'))->first();

        $params = $request->all();
        $params['user_id'] = Auth::id();
        $params['article_id'] = $article_id->id;
        $comment = Comment::create($params);

        return redirect()->back();
    }
}
