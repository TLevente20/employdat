<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(){
        $name = request('name');
        if($name==""){
            return redirect()->route('home',['people'=>Person::with('cvs')
            ->cursorPaginate(8)
        ]);
        };
        return view('home', ['people' => Person::with('cvs')
            ->where('name', 'LIKE', "%$name%")->orWhere('post', 'LIKE', "%$name%")
            ->cursorPaginate(8)
            //->get()
        ]);
    }
}
