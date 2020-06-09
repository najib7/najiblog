<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username'      => "required|alpha_dash|max:20|min:3|unique:users",
            'email'         => "required|string|email|max:255|unique:users",
            'password'      => "required|string|min:8|confirmed",
            'profile_image' => "image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            'gender'        => "required|in:male,female",
            'first_name'    => "required|min:3|max:20|alpha_dash",
            'last_name'     => "required|min:3|max:20|alpha_dash",
            'country'       => "required|" . Rule::in(config('blog.country_list')),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'username'   => $data['username'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'last_login' => Carbon::now(),
        ]);

        $profile             = new Profile();
        $profile->gender     = $data['gender'];
        $profile->first_name = $data['first_name'];
        $profile->last_name  = $data['last_name'];
        $profile->country    = $data['country'];
        
        // upload profile image
        if(request()->hasFile('profile_image')) {
            $file = request()->file('profile_image');
            $fileName = 'profile-' . strtolower($user->username) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profiles', $fileName);
            $profile->image = $fileName;
        }

        $user->profile()->save($profile);
        $user->assignRole('standard');

        return $user;
    }
}
