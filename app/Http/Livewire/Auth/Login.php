<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $username, $password;

    public function updated($field)
    {
        $this->validateOnly($field, [
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username harus diisi!.',
            'password.required' => 'Password harus diisi!.'
        ]);
    }

    public function login()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username harus diisi!.',
            'password.required' => 'Password harus diisi!.'
        ]);

        if (Auth::attempt(['username' => $this->username, 'password' => $this->password])) {
            session()->flash('success', 'Selamat datang di halaman dashboard 😆');
            return redirect()->route('dashboard');
        } else {
            session()->flash('error', 'Username atau Password yang anda masukan salah ☹');
            return redirect()->back();
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
