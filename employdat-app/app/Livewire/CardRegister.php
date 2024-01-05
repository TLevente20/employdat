<?php

namespace App\Livewire;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;

class CardRegister extends Component
{

    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    public function rules()
    {
        return [
            'name' => [
                'required','min:3','max:255',
            ],
            'email'=>['required','min:3','max:255','email'
            ],
            'password'=>[
                'required','min:8','max:255','confirmed'
            ],
            'password_confirmation'=>[
                'required','min:8','max:255',
            ],

        ];
    }
    public function save()
    {

        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);
        return $this->redirect('/profile');
    }

    public function render()
    {
        return view('livewire.cards.card-register');
    }
}
