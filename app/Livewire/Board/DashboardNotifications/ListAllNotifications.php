<?php

namespace App\Livewire\Board\DashboardNotifications;

use Livewire\Component;
use App\Models\{DashboardNotification } ;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class ListAllNotifications extends Component
{

    use WithPagination , WithoutUrlPagination ;
    protected $paginationTheme = 'bootstrap';
    public $rows;



    public function render()
    {
        $notifications = DashboardNotification::query()
        ->latest()
        ->paginate($this->rows);
        return view('livewire.board.dashboard-notifications.list-all-notifications' , compact('notifications') );
    }
}
