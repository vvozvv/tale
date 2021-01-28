<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() {
        $user_id = \request('id');
        return User::find($user_id);
    }
    public function subscribes() {
        $id = \request('id');
        return DB::table('subscribable')
            ->join('users', function($join) use ($id) {
                $join->on('users.id', '=', 'subscribable.user_id')
                    ->where('subscribable.subscribable_id', '=', $id)
                    ->select('users.name as user_name', 'id', 'username');
            })->join('media', 'subscribable.id','=', 'media.model_id')->get();
    }
}
