<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $posts = $user->posts->sortByDesc('id')->take(5);
        $comments = $user->comments->sortByDesc('id')->take(5);

        return view('profile.show', compact('user', 'posts', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('profile.edit', compact('user'));
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
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id]
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect(route('profile.show', $user))->with('success', 'Success !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/');
    }

    public function editPassword(User $user)
    {
        $this->authorize('change-password', $user);
        return view('profile.editPassword', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $this->authorize('change-password', $user);
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        Auth::logout();
        Session::flush();
        return redirect(route('login'));
    }
}
