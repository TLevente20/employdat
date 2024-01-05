<?php

namespace App\Livewire;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use App\Models\User;
use Livewire\Component;

class CardUserEdit extends Component
{
    public $user;

    #[Validate('required|min:3|max:255')] 
    public $name;


    public $email;
    public $id;

    public function mount($user = null)
    {
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }
    public function rules()
    {
        return [
            'email' => [
                'required','min:3','max:255',
                Rule::unique('users')->ignore($this->user), 
            ],
        ];
    }
    
    public function save()
    {
        $this->validate();
        
        User::whereId($this->id)->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        return redirect()->to('/profile');
    }
    public function render()
    {
        $this->user = User::whereId($this->id)
        ->first();
        return view('livewire.cards.card-user-edit',['user'=>$this->user]);
    }
}
