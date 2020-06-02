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

    public function render()
    {
        $notifications = Notification::where('role', auth()->user()->role)
                            ->orderBy('id', 'desc')
                            ->paginate(10);
        $countNotif = Notification::where('role', auth()->user()->role)->count();
        
        $this->countNotif = $countNotif;

        return view('livewire.notification-list', ['notifications' => $notifications]);
    }
}
