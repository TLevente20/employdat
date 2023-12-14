<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    public function index(){
        $name = request('name');
        if($name==""){
            return view('users',['users'=>User::get()
            //->get()
        ]);
        };
        return view('users', ['users' => User::where('name', 'LIKE', "%$name%")->get()
        ]);
    }
}
