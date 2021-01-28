<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('auth.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $users = User::with('articles')->get();
//        $comments = User::find($id)->comments;
//
//        dd($comments);

        $sub = DB::table('subscribable')
            ->join('users', function($join) use ($id) {
                $join->on('users.id', '=', 'subscribable.user_id')
                ->where('subscribable.subscribable_id', '=', $id)
                    ->select('users.name as user_name', 'id', 'username');
            })->join('media', 'subscribable.id','=', 'media.model_id')->get();

        $subsc = Subscribe::all();
        return view('user', compact('user', 'sub', 'subsc', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function subscribe($id)
    {
        $user = User::find($id);

        if ( !$id ) redirect()->route('home');
        if ( Auth::id() == $id ) {
            return redirect()->back();
        }

        $link = (bool) DB::table('subscribable')
            ->where('subscribable_id', $user->id)
            ->where('user_id', Auth::id())
            ->where('subscribable_type', 'App\Models\User')
            ->first();

        if (!$link) {
            Subscribe::create([
                'user_id' => Auth::id(),
                'subscribable_type' => 'App\Models\User',
                'subscribable_id' => $user->id
            ]);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
    public function unsubscribe(Request $request, $id)
    {
//        dd($id);
        $user = User::find($id);

         DB::table('subscribable')
            ->where('subscribable_id', $user->id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->back();
    }


}
