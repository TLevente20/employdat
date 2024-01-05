<?php

namespace App\Livewire;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use App\Models\Person;
use Livewire\Component;


class CardEditPerson extends Component
{
    public $id;
    #[Validate('required|min:3|max:255')] 
    public $name = '';

    public $email = '';

    #[Validate('required|min:3|max:255|')] 
    public $post = '';

    public function rules()
    {
        return [
            'email' => [
                'required','min:3','max:255',
                Rule::unique('people')->ignore($this->person), 
            ],
        ];
    }
    public $person;

    public function mount($person = null)
    {
        $this->name = $person->name;
        $this->email = $person->email;
        $this->post = $person->post;
        $this->id = $person->id;
    }

    
    public function save()
    {
        $this->validate();

        Person::whereId($this->id)->update([
            'name' => $this->name,
            'email' => $this->email,
            'post' => $this->post,
        ]);
        return redirect()->to('/home');
    }
    public function render()
    {
        $this->person = Person::whereId($this->id)
        ->with('cvs')->first();
        return view('livewire.cards.card-edit-person');
    }
    
}


