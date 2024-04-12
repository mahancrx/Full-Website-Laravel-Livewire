<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination,WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $image;
    public $search;
    public $editUserIndex=null;
    //-------------{Update User}-----------
    public function updateRow($user_id)
    {
        $this->dispatch('updateRow', $user_id);
    }
    //-------------{Edit User Row Table}-----------
    public function editRow($user_id)
    {
        $this->editUserIndex=$user_id;
        $this->dispatch('editRow', $user_id);
    }

    //-------------{Refresh Component After Create User}-----------
    #[on('user-created')]
//    public function userCreated()
//    {
//
//    }
    #[on('user-updated')]
    public function userUpdated()
    {
        $this->editUserIndex=null;
    }

    public function render()
    {
        $users = User::query()
            ->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->orWhere('mobile', 'like', '%'.$this->search.'%')
            ->paginate(10);
        return view('livewire.admin.user.user-list', compact('users'))->layout('admin.master');
    }
}
