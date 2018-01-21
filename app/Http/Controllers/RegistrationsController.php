<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mail\Welcome;
use App\Events\UserRegistered;
use Mail;

class RegistrationsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('guest');        
    }

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

        if( $request->hasFile('photofile') ) {
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

        event(new UserRegistered($user));

		return redirect()->route('home')->with('message', 'User signed up successfully');
    }
}
