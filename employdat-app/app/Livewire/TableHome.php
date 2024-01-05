<?php

namespace App\Livewire;
use App\Models\Person;
use Livewire\Component;
use Livewire\WithPagination;

class TableHome extends Component
{    
    use WithPagination;

    public $orderBy = 'id';

    public function order($field){
        $this->orderBy = $field;
    }
    public function render()
    {
        return view('livewire.tables.table-home',['peoplePaginate'=>Person::with('cvs')->orderBy($this->orderBy)->paginate(8)]);
    }
}
