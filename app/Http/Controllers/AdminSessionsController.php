<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'destroy']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminsessions.create');
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
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (! auth()->guard('admin')->attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'message' => 'Please check your credentials and try again.'
            ]);
        }

        return redirect()->route('admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        auth()->guard('admin')->logout();

        return redirect()
            ->route('adminsessions.create')
            ->withMessage('Admin has been logged out successfully.');
    }
}
