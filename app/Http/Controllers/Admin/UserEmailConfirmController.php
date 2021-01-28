<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\EmailConfirmation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserEmailConfirmController extends Controller
{
    //
    public function confirmEmail(User $user)
    {
        return view('auth.confirm-email', compact('user'));
    }
    public function sendConfirmationEmail (User $user, Request $request)
    {
        $token = $user->getEmailConfirmationToken();
        Mail::to($user->email)->send(new EmailConfirmation($user, $token));

        session()->flash('success', 'На вашу почту отправленна подтверждающая ссылка. Перейдите в вашу почту, чтобы подтвердить аккаунт!');

        return redirect()->back();
    }
    public function requestConfirmEmail (User $user, $token)
    {
        $userToConfirm = User::where('email', $user->email)->where('confirmation_token', $token)->first();
        if (!$userToConfirm) {
            return redirect()->route('profile.confirm', $user);
        }

        $userToConfirm->confirm();

        return redirect()->back();
    }
}
