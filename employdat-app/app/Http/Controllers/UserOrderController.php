<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index($orderBy){
        return view('users',['users'=>User::orderBy($orderBy)
            ->get()
            //->get()
        ]);
    }
}
