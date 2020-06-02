<?php

namespace App\Http\Livewire\Pelayan;

use App\Notification;
use Carbon\Carbon;
use Livewire\Component;

class NotifSection extends Component
{
    public $notifications;
    public $countNewNotif;

    protected $listeners = [
        'echo:koki,MenuEmpty' => 'notifyMenuEmpty',
        'readNotif' => 'handleReadNotif'
    ];

    public function handleReadNotif()
    {
        $this->notifications = Notification::whereDate('created_at', Carbon::today())
                                    ->where('role', 'pelayan')
                                    ->orderBy('id', 'desc')
                                    ->get();
    }

    public function notifyMenuEmpty($value)
    {
        Notification::create([
            'pesanan_id' => $value['pesananId'],
            'menu_id' => $value['menuId'],
            'message' => 'Terdapat menu kosong, harap diganti...',
            'role' => 'pelayan',
            'aksi' => 1
        ]);
    }

    public function render()
    {
        $this->notifications = Notification::whereDate('created_at', Carbon::today())
                                    ->where('role', 'pelayan')
                                    ->orderBy('selesai', 'asc')
                                    ->orderBy('id', 'desc')
                                    ->get();

        $this->countNewNotif = Notification::whereDate('created_at', Carbon::today())
                                    ->where('role', 'pelayan')
                                    ->where('selesai', '0')
                                    ->count();

        return view('livewire.pelayan.notif-section');
    }
}
