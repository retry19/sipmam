<?php

namespace App\Http\Livewire;

use App\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class NotificationList extends Component
{
    use WithPagination;

    public $countNotif;
    public $no = 1;

    public function handleAksiNotif($notifId, $pesananId)
    {
        Notification::find($notifId)->update([
            'selesai' => 1
        ]);

        $this->emit('readNotif');
        
        return redirect()->route('pelayan.pesanan-edit', $pesananId);
    }

    public function handleReadNotif($notifId)
    {
        Notification::find($notifId)->update([
            'selesai' => 1
        ]);

        $this->emit('readNotif');
    }

    public function render()
    {
        $notifications = Notification::where('role', auth()->user()->role)
                            ->orderBy('selesai', 'asc')
                            ->orderBy('id', 'desc')
                            ->paginate(10);

        $countNotif = Notification::where('role', auth()->user()->role)
                        ->count();
        
        $this->countNotif = $countNotif;

        return view('livewire.notification-list', ['notifications' => $notifications]);
    }
}
