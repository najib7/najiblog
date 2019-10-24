<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $permission_ids = [];
        // foreach(Route::getRoutes()->getRoutes() as $key => $route)
        // {
        //     $action = explode('@', $route->getActionname());
        //     $controller = $action[0];
        //     $method = end($action);

        //     $permission_check = Permission::where([
        //         'controller' => $controller,
        //         'method'     => $method
        //     ])->first();

        //     if(!$permission_check)
        //     {
        //         $permission = new Permission;

        //         $permission->controller = $controller;
        //         $permission->method     = $method;
        //         $permission->save();

        //     }

        // }


        return view('home');
    }
}
