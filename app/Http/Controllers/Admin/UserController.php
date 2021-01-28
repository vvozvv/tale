<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\User;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        return view('auth.profile.edit', compact('user'));
    }
    public function update(Request $request)
    {

//        Добавить добавление дефолтного изображения
//        dd($request->all());
        $params = $request->all();
        $user = User::find(Auth::id());
        $user->clearMediaCollection('avatars');

        $time = Carbon::now();

        if (isset($params['avatar'])) {
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
            $user->addMediaConversion('thumb')->width(500)->height(500);
        }

        $user->update($params);



        return redirect()->back();
    }
}
