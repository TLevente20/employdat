<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserOrderController extends Controller
{
    public function index($orderBy)
    {
        return view('users', ['users' => User::orderBy($orderBy)
            ->cursorPaginate(8),
            //->get()
        ]);
    }
}
