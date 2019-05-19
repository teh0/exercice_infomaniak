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

    public function profile() {
        return view('users.profile');
    }

    public function update_avatar(Request $request) {
        $user = Auth::user();
        if($request->hasFile('avatar')) {
            $old_avatar = $user->avatar;
            $avatar = $request->file('avatar');
            $prefix_filename = str_replace(' ','',$user->id).time();
            $filename = $prefix_filename.'.'. $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save( public_path('/upload/avatars/'.$filename) );

            if(file_exists(public_path('/upload/avatars/'.$old_avatar))) {
                File::delete(public_path('upload/avatars/'.$old_avatar));
            }

            $user->avatar = $filename;
            $user->save();
        }
        return redirect()->route('profile');
    }
}
