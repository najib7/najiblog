<?php

use App\User;
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

        User::create([
            'name' => 'admin',
            'email' => 'najib-v@hotmail.com',
            'password' => '$2y$12$GaOGF7NAb69hRiL.s4ppB.GsA6/Xz2G.sLvPy0yJAVKRm2UXp5A7u', //admin
        ])->assignRole('admin');
    }
}
