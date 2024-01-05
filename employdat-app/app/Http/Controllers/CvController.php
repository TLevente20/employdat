<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\Person;
use Illuminate\Http\Request;

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
