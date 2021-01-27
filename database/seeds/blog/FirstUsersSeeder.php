<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FirstUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@lagmah.com',
                'role' => 'admin',
            ],
            [
                'name' => 'author',
                'email' => 'author@lagmah.com',
                'role' => 'author',
            ],
            [
                'name' => 'user',
                'email' => 'user@lagmah.com',
                'role' => 'standard'
            ]
        ];

        foreach ($users as $user) {
            $createdUser = User::create([
                'username'   => $user['name'],
                'email'      => $user['email'],
                'password'   => Hash::make('password$$'),
                'last_login' => Carbon::now(),
            ]);
            
            $createdUser->profile()->create([
                'first_name' => $user['name'],
                'last_name' => $user['name'],
                'country' => 'Morroco',
                'gender' => 'male',
            ]);

            $createdUser->assignRole($user['role']);
        }
    }
}
