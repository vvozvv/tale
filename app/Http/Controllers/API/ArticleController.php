<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::all();
    }

    public function userArticle($id)
    {
        return Article::
            leftJoin('media', function ($join) {
                $join->on('articles.id', '=', 'media.model_id')
                    ->where('media.model_type', '=', 'App\Models\Article');
            })
            ->leftJoin('users', 'articles.user_id', '=', 'users.id')
            ->where('user_id', $id)
            ->with('comments')
            ->with('likes')
            ->where('status', 2)
            ->select('articles.id', 'articles.title', 'articles.article_text', 'articles.slug', 'articles.view_count',
                'articles.status', 'articles.created_at', 'articles.user_id', 'media.id as media_id', 'media.file_name',
                'users.surname as user_surname', 'users.name as user_name')
            ->get();
    }
    public function show($id)
    {
        return Article::find($id);
    }
    public function comments($id)
    {
        return Article::find($id)->comments;
    }
    public function articles()
    {
        return Article::
            join('users', 'articles.user_id', '=', 'users.id')
            ->with('comments')
            ->with('tag')
            ->with('likes')
            ->join('media', function ($join) {
                $join->on('articles.id', '=', 'media.model_id')
                    ->where('media.model_type', '=', 'App\Models\Article');
            })
            ->select('users.name as name', 'articles.*', 'users.id as user_id', 'media.file_name as image', 'media.id as image_id')
            ->offset(\request('offset'))
            ->take(6)
            ->get();
    }
    public function store() {

        $title = \request('title');
        $tag = \request('tag');
        $image = \request('image');
        $user_id = \request('user_id');
        $status = \request('status');

        $article = Article::create([
            'title' => \request('title'),
            'slug' => str_slug($title),
            'article_text' => \request('article_text'),
            'status' => $status,
            'user_id' => $user_id,
            'article_image' => $image,
            'tag' => $tag,
        ]);
//        $article->tag()->sync((array)$tag);


        $exploded = explode(',', $image);
        $decode = base64_decode($exploded[1]);

        if (str_contains($exploded[0], 'jpeg'))
            $extension = 'jpg';
        else
            $extension = 'png';


        $fileName = str_random().'.'.$extension;
        $path = public_path().'/'.$fileName;
        $file = file_put_contents($path, $decode);


        if (isset($image)) {
            return $article->addMedia($fileName)->toMediaCollection('articles');
        }
    }
    public function top() {
        return Article::
            leftJoin('users', 'articles.user_id', '=', 'users.id')
            ->leftJoin('tags','articles.tag', '=', 'tags.id')
            ->select('users.name as name', 'articles.*', 'tags.name as tag_name')
            ->offset(\request('offset'))
            ->take(4)
            ->orderBy('id')
            ->get();
    }
}
