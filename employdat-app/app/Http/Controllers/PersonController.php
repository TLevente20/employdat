<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home', ['people' => Person::with('cvs')
            ->cursorPaginate(8),
            //->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $id)
    {
        $this->validate($request, [
            'textarea' => 'required',
        ]);
        CV::create([
            'person_id' => $id,
            'body' => $request->textarea,
        ]);

        return view('cv', ['person' => Person::where('id', $id)
            ->with('cvs')
            ->first(), 'message' => 'CV is created!']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:people,email',
            'post' => 'required',
        ]);
        Person::create([
            'name' => $request->name,
            'email' => $request->email,
            'post' => $request->post,
        ]);

        return view('home', ['people' => Person::with('cvs')
            ->cursorPaginate(8),
            //->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        return view('edit', ['person' => Person::where('id', $id)->first()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => "required|email|unique:people,email,$id",
            'post' => 'required',
        ]);
        Person::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'post' => $request->post,
        ]);

        return redirect()->route('home', ['people' => Person::with('cvs')
            ->cursorPaginate(8),
            //->get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Person::destroy($id);

        return redirect()->route('home', ['people' => Person::with('cvs')
            ->cursorPaginate(8),
            //->get()
        ]);
    }
}
