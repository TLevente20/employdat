<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class dats_controller extends Controller
{
    public function index(){
        return view('home',['people'=>Person::with('cvs')
            ->cursorPaginate(8)
            //->get()
        ]);
    }


    public function search(){
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


    public function store(Request $request){
        $this->validate($request,array(
            'name'=>'required',
            'email'=>'required|email|unique:people,email',
            'post' => 'required'
        ));
        Person::create([
            'name' => $request->name,
            'email' => $request->email,
            'post' => $request->post,
        ]);

        return view('home',['people'=>Person::with('cvs')
            ->cursorPaginate(8)
            //->get()
        ]);
    }

    public function confirm($id){
        return view('delete_confirm',['id'=>$id]);
    }


    public function delete($id){
        Person::destroy($id);

        return redirect()->route('home',['people'=>Person::with('cvs')
            ->cursorPaginate(8)
            //->get()
        ]);
    }


    public function edit($id){
        
        return view('edit',['person'=>Person::where('id',$id)->first()]);
    }
    public function update(Request $request,$id){
        $this->validate($request,array(
            'name'=>'required',
            'email'=>"required|email|unique:people,email,$id",
            'post' => 'required'
        ));
        Person::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'post' => $request->post,
        ]);
        return redirect()->route('home',['people'=>Person::with('cvs')
            ->cursorPaginate(8)
            //->get()
        ]);
    }
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