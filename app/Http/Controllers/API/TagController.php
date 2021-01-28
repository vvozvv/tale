<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Subscribe;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function tags ()
    {
        return Tag::
            join('media', function ($join) {
                $join->on('tags.id', '=', 'media.model_id')
                    ->where('media.model_type', '=', 'App\Models\Tag');
            })
            ->select('tags.*', 'media.id as image_id', 'media.file_name as image')
            ->withCount('articles')
            ->get();
    }

    public function subscribe (Request $request)
    {
        $tag = Tag::find($request->id);

        if (isset($request->user_id)) {
            return 'Авторизируйтесь, чтобы подписываться на категории!';
        }
        $post = Subscribe::where('user_id', $request->user_id)
            ->where('subscribable_id', $request->id)
            ->where('subscribable_type', 'App\Models\Tag')
            ->first();

        if ( !is_null($post) && ($post) ) {
            return 'Вы уже подписаны на эту категорию!';
        } else {
            $tag->subscribes()->create(['user_id' => $request->props['user_id']]);
            return 'Вы успешно подписались!';
        }
    }
    public function unsubscribe(Request $request) {

        $post = Subscribe::where('user_id', $request->user_id)
            ->where('subscribable_id', $request->id)
            ->where('subscribable_type', 'App\Models\Tag')
            ->first();
        $post->delete();
        return 'Вы отписались';
    }
    /**  */
    public function tagsArticles() {
        $id = \request('id');
        $articles = Article::
            join('tags', 'articles.tag', '=', 'tags.id')
            ->join('media', function ($join) {
                $join->on('articles.id', '=', 'media.model_id')
                    ->where('media.model_type', '=', 'App\Models\Article');
            })
            ->join('users', 'articles.user_id', '=', 'users.id')
            ->where('status', 2)
            ->with('comments')
            ->with('likes')
            ->select('articles.*', 'users.id as user_id', 'users.name', 'users.surname', 'media.file_name as file_name', 'media.id as media_id')
            ->get();

//        $articles = Tag::where('id', '=', $id)
//            ->with('articles')
//            ->leftJoin('media', function ($join) {
//                $join->on('articles.id', '=', 'media.model_id')
//                    ->where('media.model_type', '=', 'App\Models\Article');
//            })
//            ->get();
        return $articles;
    }
    public function subscribeTags(Request $request) {
        $list = Subscribe::
            where('user_id', $request->id)
//            ->leftJoin('media', function ($join) {
//                $join->on('subscribable.subscribable_id', '=', 'media.model_id')
//                    ->where('media.model_type', '=', 'App\Models\Tag');
//            })
//            ->leftJoin('tags', 'subscribable.subscribable_id', '=', 'tags.id')
            ->where('subscribable_type', '=', 'App\Models\Tag')
//            ->select('subscribable_id as tags_id', 'media.file_name', 'tags.name as tag_name')
//            ->select('subscribable_id as id')
//                ->pluck('id')
            ->get();
        return $list->pluck('subscribable_id');
    }
}
