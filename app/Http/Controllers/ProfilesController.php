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
        $user = User::with(['topics','posts'])->find($id);

        $profileImageUrl = $this->getProfileImageUrl($user->photourl);

        return view('profiles.show', [
            'user' => $user,
            'profileImageUrl' => $profileImageUrl
        ]);
    }

    protected function getProfileImageUrl($imageFile)
    {
        if (Storage::disk('dropbox')->exists($imageFile)) {
                return Storage::disk('dropbox')
                             ->getAdapter()
                             ->getTemporaryLink($imageFile);
        }

        return null;
    }
}
