<?php

namespace App\Http\Livewire\Owner;

use App\User;
use Livewire\Component;

class AkunEdit extends Component
{
    public $user;
    public $getId;

    public function saveUser($formData)
    {
        User::find($this->getId)->update([
            'nama' => $formData['nama'],
            'no_hp' => $formData['no_hp'],
            'role' => $formData['role'],
            'username' => $formData['username'],
            'password' => bcrypt($formData['password']),
        ]);

        session()->flash('<strong>Berhasil!</strong> akun telah diubah.');

        return redirect()->route('owner.akun-all');
    }

    public function mount($id)
    {
        $this->getId = $id;
        $this->user = User::find($id);
    }

    public function render()
    {
        return view('livewire.owner.akun-edit');
    }
}
