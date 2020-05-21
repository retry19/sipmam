<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        Auth::logout();
        
        session()->flash('success', 'Selamat tinggal, anda telah keluar dari akun ☹');
        return redirect()->route('auth.login');
    }

    public function render()
    {
        return view('livewire.auth.logout');
    }
}
