<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $user = User::query()->paginate(1);
        return view('livewire.admin.user.user-list', compact('user'))->layout('admin.master');
    }
}
