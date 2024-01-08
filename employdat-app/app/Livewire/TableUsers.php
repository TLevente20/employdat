<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TableUsers extends Component
{
    use WithPagination;

    public $users;

    public $orderBy = 'id';

    public function order($field)
    {
        $this->orderBy = $field;
    }

    public function render()
    {
        return view('livewire.tables.table-users', ['usersPaginate' => User::orderBy($this->orderBy)->paginate(8)]);
    }
}
