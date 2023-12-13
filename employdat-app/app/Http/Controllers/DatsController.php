<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class DatsController extends Controller
{

 


    public function orderName(){
        return view('home',['people'=>Person::with('cvs')
            ->orderBy('name')
            ->cursorPaginate(8)
            //->get()
        ]);
    }
    public function orderEmail(){
        return view('home',['people'=>Person::with('cvs')
            ->orderBy('email')
            ->cursorPaginate(8)
            //->get()
        ]);
    }
    public function orderPost(){
        return view('home',['people'=>Person::with('cvs')
            ->orderBy('post')
            ->cursorPaginate(8)
            //->get()
        ]);
    }
}