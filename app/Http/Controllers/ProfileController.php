<?php

namespace LAIRE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use LAIRE\User;
use LAIRE\Profile;
use Image;
use File;


class ProfileController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewProfile($username = null)
    {
    	$user = User::where('username', $username)->first();

    	/*toggle to show either the profile or the "User not found" page*/
        $userFound = !($user === null);

        if ($userFound)
        {
            $id = $user->getId();
            $profile = Profile::where('id', $id)->first();

            $realName = $user->name;
            $bio = $profile->bio;
            if ($bio === null){
                $bio = $realName . " has not written a bio.";
            }
            $avatar = $profile->avatar;
        } else {
            $realName = null;
            $bio = null;
            $id  = null;
            $avatar = null;
        }


    	return view('profile', ['userFound' => $userFound, 'username' => $username,
                                'realName' => $realName, 'bio' => $bio, 'id' => $id,
                                'avatar' => $avatar]);
    }

    public function editProfile($username){
        $user = User::where('username', $username)->first();

        if ($user === null || Auth::id() !== $user->getId()){
            return $this->displayProfile($username);
        } else {
            $id = $user->getId();
            $profile = Profile::where('id', $id)->first();

            $realName = $user->name;
            $bio = $profile->bio;
            
            return view('editProfile', ['username' => $username, 'realName' => $realName, 'bio' => $bio]);
        }
    }

    public function commitEdit(Request $request){
        $this->validator($request->all())->validate();

        $realName = $request->name;
        $bio = $request->bio;
        $user = User::where('id', Auth::id())->first();
        $username = $user->username;

        if ($user !== null || Auth::id() === $user->getId()){
            $profile = Profile::where('id', $user->getId())->first();

            $user->name = $realName;
            $profile->bio = $bio;

            $avatar = $request->avatar;
            if ($avatar !== null)
            {
                $filename = time() . "." . $avatar->getClientOriginalExtension();
                Image::make($avatar)->fit(300, 300)->save(public_path('/images/avatars/' . $filename ) );

                File::delete(public_path('/images/avatars/' . $profile->avatar));

                $profile->avatar = $filename;
            }

            $user->save();
            $profile->save();
        }
        return redirect()->route('viewProfile', ['username' => $username]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'bio' => 'max:65535',
            'avatar' => '',
        ]);
    }
}
