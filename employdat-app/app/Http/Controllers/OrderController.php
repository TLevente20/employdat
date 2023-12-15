<?php

namespace App\Http\Controllers;

use App\Models\Person;

class OrderController extends Controller
{
    public function index($orderBy)
    {
        return view('home', ['people' => Person::with('cvs')
            ->orderBy($orderBy)
            ->cursorPaginate(8),
            //->get()
        ]);
    }
}
