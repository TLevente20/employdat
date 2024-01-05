<?php

namespace App\Livewire;
use Livewire\Attributes\Validate;
use App\Models\Person;

use Livewire\Component;

class CardAddPerson extends Component
{
    #[Validate('required|min:3|max:255')] 
    public $name = '';

    #[Validate('required|min:3|max:255|email|unique:people')] 
    public $email = '';

    #[Validate('required|min:3|max:255|')] 
    public $post = '';

    public function save()
    {
        $this->validate();
        
        Person::create([
            'name' => $this->name,
            'email' => $this->email,
            'post' => $this->post
        ]);
 
        return redirect()->to('/home');
    }

    public function render()
    {
        
        return view('livewire.cards.card-add-person');
    }
}
