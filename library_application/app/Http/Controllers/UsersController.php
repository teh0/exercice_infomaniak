<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use File;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * profile
     *
     * @return void
     */
    public function profile() {
        return view('users.profile');
    }

    /**
     * update_avatar
     *
     * @param Request $request
     * @return void
     */
    public function update_avatar(Request $request) {
        $user = Auth::user();
        if($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $prefix_filename = $user->id;
            $filename = $prefix_filename.'.'. $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save( public_path('/upload/avatars/'.$filename) );

            $user->avatar = $filename;
            $user->save();
        }
        return redirect()->route('profile');
    }
}
