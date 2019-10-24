<?php

use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission_ids = [];
        foreach(Route::getRoutes()->getRoutes() as $key => $route)
        {
            $action = explode('@', $route->getActionname());
            $controller = $action[0];
            $method = end($action);

            $permission_check = Permission::where([
                'controller' => $controller,
                'method'     => $method
            ])->first();

            if(!$permission_check)
            {
                $permission = new Permission;

                $permission->controller = $controller;
                $permission->method     = $method;
                $permission->save();
                $permission_ids[] = $permission->id;
            }

        }
        $admin_role = Role::where('name','admin')->first();
        $admin_role->permissions()->attach($permission_ids);
    }
}
