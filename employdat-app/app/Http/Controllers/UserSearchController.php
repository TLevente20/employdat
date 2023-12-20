<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserSearchController extends Controller
{
    public function index()
    {
        $name = request('name');
        if ($name == '') {
            return view('users', ['users' => User::cursorPaginate(8),
                //->get()
            ]);
        }

        return view('users', ['users' => User::where('name', 'LIKE', "%$name%")->cursorPaginate(8),
        ]);
    }
}
