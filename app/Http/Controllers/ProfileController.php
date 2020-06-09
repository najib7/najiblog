<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:edit-profile,user', 'password.confirm'])->only('destroy', 'edit', 'update');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $posts    = $user->posts()->orderBy('id', 'desc')->take(5)->get();
        $comments = $user->comments()->orderBy('id', 'desc')->take(5)->get();

        return view('blog.profile.show', compact('user', 'posts', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('blog.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username'      => "required|alpha_dash|max:20|min:3|unique:users,username," . $user->id,
            'email'         => "required|string|email|max:255|unique:users,email," . $user->id,
            'profile_image' => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            'gender'        => "required|in:male,female",
            'first_name'    => "required|min:3|max:20|alpha_dash",
            'last_name'     => "required|min:3|max:20|alpha_dash",
            'country'       => "required|" . Rule::in(config('blog.country_list')),
            'date_of_birth' => "date|before:5 years ago|nullable",
            'role'          => "in:admin,author,standard",
        ]);
        
        // users table
        $user->username = $request->username;
        $user->email    = $request->email;

        // profiles table
        $profile                = $user->profile;
        $profile->first_name    = $request->first_name;
        $profile->last_name     = $request->last_name;
        $profile->gender        = $request->gender;
        $profile->country       = $request->country;
        $profile->date_of_birth = $request->date_of_birth;
        $profile->about         = $request->about;

        // upload image
        if($request->hasFile('profile_image')) {

            $old_image_path = profiles_storage_path($profile->image);
            if($profile->image && File::exists($old_image_path)) {
                File::delete($old_image_path);
            }

            $file = $request->file('profile_image');
            $fileName = 'profile-' . strtolower($user->username) . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profiles', $fileName);
            $profile->image = $fileName;
        }

        // assign role
        if(Auth::user()->hasRole('admin') && $request->role) {
            $user->syncRoles($request->role);
        }
        
        $user->save();
        $profile->save();

        return redirect(route('profile.show', $user))->with('success', 'user has been saved succesfully !');
    }

    public function editPassword(User $user)
    {
        $this->authorize('change-password', $user);
        return view('blog.profile.editPassword', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $this->authorize('change-password', $user);



        $request->validate([
            'password'     => ['required', 'string', 'min:8', 'password'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->password = Hash::make($request->new_password);
        $user->save();

        Auth::logout();
        Session::flush();
        return redirect(route('login'));
    }
}
