<?php

namespace App\Livewire;
use App\Models\Cv;
use App\Models\Person;
use Livewire\Component;


class TableCv extends Component
{
    public $person;
    public $id;
    public $name;
    public $newCvText;
    public $cvTexts=[];

    
    public function mount($person = null)
    {
        $this->id = $person->id;
        $this->name = $person->name;

        $cvList = Cv::where('person_id',$this->person->id)->get();
        
        foreach( $cvList as $Cv){
            $this->cvTexts[$Cv->id] = $Cv->body;
        }
    }

    public function create(){
        CV::create([
            'person_id' => $this->id,
            'body' => $this->newCvText,
        ]);
        return redirect();
    }

    public function edit($idToEdit){
        Cv::where('id', $idToEdit)->update([
            'body' => $this->cvTexts[$idToEdit]
        ]);
        return redirect();
    }

    public function destroy($idToDestroy){

        Cv::destroy($idToDestroy);
        return redirect();
    }

    public function render()
    {
        
        $this->person = Person::where('id', $this->id)
        ->with('cvs')
        ->first();
        return view('livewire.tables.table-cv');
    }
}
