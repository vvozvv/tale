<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index(Request $request) {
        $articleQuery = Article::query();

        if (!empty($request->tag)) {
            $articleQuery->whereIn('tag', $request->tag);
        }
        if ($request->filled('offset')) {
            $articleQuery->offset($request->offset);
        }

        return $articleQuery
            ->leftJoin('media', function ($join) {
                $join->on('articles.id', '=', 'media.model_id')
                    ->where('media.model_type', '=', 'App\Models\Article');
            })
            ->leftJoin('users', 'articles.user_id', '=', 'users.id')
            ->leftJoin('tags', 'articles.tag', '=', 'tags.id')
            ->with('comments')
            ->with('likes')
            ->where('status', '=', 2)
            ->select('media.id as image_id', 'media.file_name as image',
                'articles.*', 'users.name', 'users.surname', 'tags.name as tag_name')
            ->take(3)
            ->get();
    }
}
