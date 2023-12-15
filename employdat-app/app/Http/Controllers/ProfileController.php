<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(Request $request): View
    {
        return view('users', ['users' => User::all(),
            //->get()
        ]);
    }

    public function create(Request $request): View
    {
        return view('register');

    }

    public function store(Request $request): View
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));

        Auth::login($user);

        return view('users', ['users' => User::all(),
            //->get()
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, $id)
    {

        return view('profileEdit', ['user' => User::where('id', $id)->first()]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, $id): View
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => "required|email|unique:users,email,$id",
        ]);
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return view('users', ['users' => User::all(),
            //->get()
        ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, $id): View
    {
        /* $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]); */

        User::destroy($id);

        return view('users', ['users' => User::all(),
            //->get()
        ]);
    }
}
