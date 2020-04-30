<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegistrationsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registrations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            'about' => 'required',
            'photofile' => 'image|max:500'
        ]);

        $path = '';

        if ($request->hasFile('photofile')) {
            $path = $request->file('photofile')->store('images', 'dropbox');
        }

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->about = $request->about;
        $user->photourl = $path;

        $user->save();

        auth()->login($user);

        Mail::to($user)
            ->send(new WelcomeMail($user));

        return redirect()
            ->route('home')
            ->with('message', 'User signed up successfully');
    }
}
