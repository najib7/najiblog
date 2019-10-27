<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Role::all() as $r) {
            Role::destroy($r->id);
        }
        foreach (Permission::all() as $p) {
            Permission::destroy($p->id);
        }


        $role = Role::create(['name' => 'writer']);
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'post articles']);

        $permission = Permission::all();

        $role->syncPermissions($permission);
    }
}
