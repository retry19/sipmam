<?php

namespace App\Http\Livewire\Owner;

use App\User;
use Livewire\Component;

class AkunIndex extends Component
{
    public $no = 1;

    public function addUser($formData)
    {
        User::create([
            'nama' => $formData['nama'], 
            'no_hp' => $formData['no_hp'], 
            'role' => $formData['role'], 
            'username' => $formData['username'], 
            'password' => bcrypt($formData['password']) 
        ]);

        session()->flash('success', '<strong>Berhasil!</strong> akun baru telah ditambahkan.');

        return redirect()->route('owner.akun-all');
    }

    public function deleteUser($id)
    {
        User::destroy($id);

        session()->flash('<strong>Berhasil!</strong> akun telah dihapus.');
    }

    public function render()
    {
        $users = User::all();

        return view('livewire.owner.akun-index', ['users' => $users]);
    }
}
