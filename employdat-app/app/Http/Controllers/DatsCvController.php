<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Cv;
use Illuminate\Http\Request;

class DatsCvController extends Controller
{
    public function index($id) {
        return view('cv',['person'=>Person::where('id',$id)
            ->with('cvs')
            ->first()
        ]);
    }
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

    public function destroy($id,$id_cv){
        Cv::destroy($id_cv);

    return view('cv',['person'=>Person::where('id',$id)
            ->with('cvs')
            ->first()
        ,'message'=> 'CV is deleted!']);
    }
}
