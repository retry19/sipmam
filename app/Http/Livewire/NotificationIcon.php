<?php

namespace App\Http\Livewire;

use App\Notification;
use Carbon\Carbon;
use Livewire\Component;

class NotificationIcon extends Component
{
    public $notifications;
    public $countNewNotif;
    public $getRole;

    protected $listeners = [
        'echo:koki,MenuEmpty' => 'notifyMenuEmpty',
        'echo:pelayan,OrderedPesanan' => 'notifyOrderedPesanan',
        'echo:pelayan,AddedPesanan' => 'notifyAddedPesanan',
        'echo:pelayan,DeletedPesanan' => 'notifyDeletedPesanan',
        'readNotif' => 'handleReadNotif'
    ];

    public function notifyOrderedPesanan($value)
    {
        $this->storeNotification($value, 'OrderedPesanan');
    }

    public function notifyAddedPesanan($value)
    {
        $this->storeNotification($value, 'AddedPesanan');
    }

    public function notifyDeletedPesanan($value)
    {
        return $this->storeNotification($value, 'DeletedPesanan');
    }

    public function handleReadNotif()
    {
        $this->notifications = Notification::whereDate('created_at', Carbon::today())
                                    ->where('role', 'pelayan')
                                    ->orderBy('id', 'desc')
                                    ->get();
    }

    public function notifyMenuEmpty($value)
    {
        $this->storeNotification($value, 'MenuEmpty');
    }

    private function storeNotification($value, $type)
    {
        $message = '';
        $role = '';
        $aksi = '';

        switch ($type) {
            case 'MenuEmpty':
                $message = 'Terdapat menu kosong, harap diganti...';
                $role = 'pelayan';
                $aksi = 1;
                break;
            case 'OrderedPesanan':
                $message = 'Pesanan baru telah ditambahkan...';
                $role = 'koki';
                $aksi = 0;
                break;
            case 'AddedPesanan':
                $message = 'Pesanan telah diubah dan ditambahkan...';
                $role = 'koki';
                $aksi = 0;
                break;
            case 'DeletedPesanan':
                $message = 'Pesanan telah diubah dan dihapus...';
                $role = 'koki';
                $aksi = 0;
                break;
            default:
                break;
        }

        Notification::create([
            'pesanan_id' => $value['pesananId'],
            'menu_id' => $value['menuId'] ? json_encode($value['menuId']) : null,
            'message' => $message,
            'role' => $role,
            'aksi' => $aksi
        ]);
    }

    public function mount($role)
    {
        $this->getRole = $role;
    }

    public function render()
    {
        $this->notifications = Notification::whereDate('created_at', Carbon::today())
                                    ->where('role', $this->getRole)
                                    ->orderBy('selesai', 'asc')
                                    ->orderBy('id', 'desc')
                                    ->get();

        $this->countNewNotif = Notification::whereDate('created_at', Carbon::today())
                                    ->where('role', $this->getRole)
                                    ->where('selesai', '0')
                                    ->count();

        return view('livewire.notification-icon');
    }
}
