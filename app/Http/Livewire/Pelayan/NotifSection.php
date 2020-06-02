<?php

namespace App\Http\Livewire\Pelayan;

use App\Notification;
use Carbon\Carbon;
use Livewire\Component;

class NotifSection extends Component
{
    public $notifications;

    protected $listeners = ['echo:koki,MenuEmpty' => 'notifyMenuEmpty'];

    public function notifyMenuEmpty($value)
    {
        Notification::create([
            'pesanan_id' => $value['pesananId'],
            'menu_id' => $value['menuId'],
            'message' => 'Terdapat menu kosong, harap diganti...',
            'role' => 'pelayan'
        ]);
    }

    public function render()
    {
        $this->notifications = Notification::whereDate('created_at', Carbon::today())
                                        ->where('role', 'pelayan')->get();

        return view('livewire.pelayan.notif-section');
    }
}
