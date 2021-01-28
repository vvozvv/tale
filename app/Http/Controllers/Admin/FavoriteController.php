<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    public function getFavorite($id)
    {
        $params = [ 'user_id' => Auth::id(), 'article_id' => $id];
        $favorite = Favorite::where('user_id', Auth::id())->where('article_id', $id)->first();
        (is_null($favorite)) ? Favorite::create($params) : '';

        return redirect()->back();
    }
    public function deleteFavorite($id)
    {
        $params = [ 'user_id' => Auth::id(), 'article_id' => $id];
//        $favorite = DB::table('favorite')->where('user_id', Auth::id())->first();
        $favorite = Favorite::where('user_id', Auth::id())
            ->where('article_id', $id)
            ->first();

        (!is_null($favorite)) ? $favorite->delete() : '';

        return redirect()->back();
    }
    public function show()
    {
        return view('favorite');
    }
}
