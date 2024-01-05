<?php

namespace App\Livewire;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;

class TableUsers extends Component
{
    use WithPagination;
    public $users;

    public $orderBy = 'id';

    public function order($field){
        $this->orderBy = $field;
    }

    public function render()
    {
        return view('livewire.tables.table-users',['usersPaginate'=>User::orderBy($this->orderBy)->paginate(8)]);
    }
}
