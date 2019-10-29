<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function users()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return view('dashboard.users', compact('users'));
    }

    public function createUser()
    {
        
    }
}
