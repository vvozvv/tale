<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public function index(Request $request) {

        $query = $request->input('query');
//        Article::where('title', 'like', "%$query%")->get();
        return Article::where('title', 'like', "%$query%")
            ->join('users', 'articles.user_id', '=', 'users.id')
            ->join('media', function ($join) {
                $join->on('articles.id', '=', 'media.model_id')
                    ->where('media.model_type', '=', 'App\Models\Article');
            })
            ->with('comments')
            ->with('likes')
            ->select('articles.*', 'media.file_name as file_name', 'media.id as media_id', 'users.name as name', 'users.id as user_id')
            ->get();

    }
}
