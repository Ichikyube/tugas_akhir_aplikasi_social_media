<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Livewire\Component;



class Register extends Component
{
    /** @var string */
    public $name = '';

    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var string */
    public $passwordConfirmation = '';

    public function register()
    {
        $input = $this->all();

        $validator = Validator::make ($input, [
            'fullname'      => ['required', 'max:255', 'string', 'max:50' ],
            'username'      => ['required','unique:users', 'string', 'max:50' ],
            'dateofbirth'   => ['required','date'],
            'email'         => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password'      => ['required', 'min:8', 'same:passwordConfirmation']
        ], [
            'required'      => ':harus diisi',
            'fullname.required', 'dateofbirth.required' => ':Excuse us to know more about you',
            'dateofbirth.required'  => ':Excuse us to know more about you'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        // Retrieve the validated input...
        $validated = $validator->validated();

        $user = User::create([
            'username' => $validated['username'],
            'slug' => Str::of($validated['username'])->slug('-'),
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Profile::create([
            'user_id' => $user->id,
            'fullname' => $input['fullname'],

            'gender' => $input['gender'],
        ]);

        if($user) {
            Auth::login($user);
            return redirect()->route('dashboard');
        }


        event(new Registered($user));

        Auth::login($user, true);

        return redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
