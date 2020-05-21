<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordsController extends Controller
{
    public function create(Request $request)
    {
        $token = $request->input('token');
        $email = $request->input('email');

        return view('reset-passwords.create', compact('token', 'email'));
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $response = Password::reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();

            event(new PasswordReset($user));
        });

        if ($response == Password::PASSWORD_RESET) {
            return redirect()
                ->route('sessions.create')
                ->withMessage(trans($response));
        }

        return redirect()
            ->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }
}
