<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Cv;
use Illuminate\Http\Request;

class CvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id) {
        return view('cv',['person'=>Person::where('id',$id)
            ->with('cvs')
            ->first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request,$id){
        $this->validate($request,array(
            'textarea' =>'required'
        ));
       CV::create([
            'person_id' => $id,
            'body' => $request->textarea
        ]);
        return view('cv',['person'=>Person::where('id',$id)
            ->with('cvs')
            ->first()
        ,'message'=> 'CV is created!']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id,$id_cv){
        $message ="";
        if($request->textarea !==Null){
            Cv::where('id',$id_cv)->update([
                'body'=>$request->textarea
            ]);
            $message="CV is updated!";
        }else{
            $message="CV cannot be updated to empty!";
        }
        
        
        return view('cv',['person'=>Person::where('id',$id)
            ->with('cvs')
            ->first()
        ,'message'=>$message]);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,$id_cv){
        Cv::destroy($id_cv);

    return view('cv',['person'=>Person::where('id',$id)
            ->with('cvs')
            ->first()
        ,'message'=> 'CV is deleted!']);
    }
}
