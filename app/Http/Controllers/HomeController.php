<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

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
        $cajero = Role::find(1);
        $admin = Role::find(2);

        $cristian = User::find(1);
        $cristian->roles()->attach([$admin->id, $cajero->id]);

        $pablo = User::find(2);
        $pablo->roles()->attach([$cajero->id]);
        
        return view('home');

    }
}
