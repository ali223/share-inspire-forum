<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with(['topics', 'posts'])->find($id);

        $profileImageUrl = $this->getProfileImageUrl($user->photourl);

        return view('profiles.show', [
            'user' => $user,
            'profileImageUrl' => $profileImageUrl
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $profileImageUrl = $this->getProfileImageUrl($user->photourl);

        return view('profiles.edit', [
            'user' => $user,
            'profileImageUrl' => $profileImageUrl
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $this->validate($request, [
            'about' => 'required',
            'photofile' => 'image|max:500'
        ]);

        $path = $user->photourl;

        if ($request->hasFile('photofile')) {
            $path = $request->file('photofile')->store('images', 'dropbox');
        }

        $user->update([
            'about' => $request->about,
            'photourl' => $path
        ]);

        return redirect()
            ->route('profiles.show', $user)
            ->with('message', 'Profile updated successfully');
    }

    protected function getProfileImageUrl($imageFile)
    {
        if (Storage::disk('dropbox')->exists($imageFile)) {
            return Storage::disk('dropbox')
                             ->getAdapter()
                             ->getTemporaryLink($imageFile);
        }
    }
}
