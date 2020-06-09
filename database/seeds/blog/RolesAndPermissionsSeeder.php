<?php

use App\User;
use App\Profile;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'author']);
        Role::create(['name' => 'standard']);

        $user = User::create([
            'username'   => 'najib',
            'email'      => 'najib-v@hotmail.com',
            'password'   => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',   // password,
            'last_login' => Carbon::now()
        ]);

        $profile = new Profile();
        $profile->first_name = 'najib';
        $profile->last_name = 'najib';
        $profile->country = 'Morroco';
        $profile->gender = 'male';

        $user->profile()->save($profile);
        $user->assignRole('admin');
    }
}
