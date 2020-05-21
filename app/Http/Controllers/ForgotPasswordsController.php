<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgotPasswordsController extends Controller
{
    public function create()
    {
        return view('forgot-passwords.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::findByEmail($validatedData['email']);

        if (is_null($user)) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'Could not find any account with this email address'
                ]);
        }

        $token = Password::createToken($user);

        Mail::to($user->email)
            ->send(new PasswordResetMail($user->email, $token));

        return back()
            ->withMessage('The password reset link has been emailed to you.');
    }
}
