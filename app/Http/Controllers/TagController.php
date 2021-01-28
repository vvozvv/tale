<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function index() {
        $tags = Tag::
            leftJoin('media', function ($join) {
                $join->on('tags.id', '=', 'media.model_id')
                    ->where('media.model_type', '=', 'App\Models\Tag');
            })
            ->select('tags.*', 'media.id as image_id', 'media.file_name as image')
            ->get();
//        dd($tags);
        return view('tags', compact('tags'));
    }

    public function subscribe($id)
    {
        $tag = Tag::find($id);
        $post = Subscribe::where('user_id', Auth::id())
            ->where('subscribable_id', $id)
            ->where('subscribable_type', 'App\Models\Tag')
            ->first();

        if ( !is_null($post) ) {
            return redirect()->back();
        } else {
            $tag->subscribes()->create(['user_id' => Auth::id()]);
            return redirect()->back();
        }
    }
    public function unsubscribe($id)
    {
        $record = Subscribe::where('subscribable_id', '=', $id)
            ->where('user_id', '=', Auth::id())
            ->where('subscribable_type', '=', 'App\Models\Tag')
            ->first();
        $record->delete();
        return redirect()->back();
    }
    public function show($id)
    {
        $tag = Tag::find($id);
        $tags = Tag::all();
        return view('tag', ['tag' => $tag, 'tags' => $tags]);
    }
}
