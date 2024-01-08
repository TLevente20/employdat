<?php

namespace App\Http\Controllers;

use App\Models\Person;

class CvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show($id)
    {
        return view('cv', ['person' => Person::where('id', $id)
            ->with('cvs')
            ->first(),
        ]);
    }
}
