<?php

namespace App\Http\Controllers;

use App\Models\Person;

class SearchController extends Controller
{
    public function index()
    {
        $name = request('name');
        if ($name == '') {
            return redirect()->route('home', ['people' => Person::with('cvs')
                ->get(),
            ]);
        }

        return view('home', ['people' => Person::with('cvs')
            ->where('name', 'LIKE', "%$name%")->orWhere('post', 'LIKE', "%$name%")
            ->get(),
            //->get()
        ]);
    }
}
