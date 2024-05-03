<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination,WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $sortId=true;
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
    #[Js]
    public function pollRefresh()
    {
        return <<<'JS'
            console.log('poll')
        JS;

    }

    public function placeholder()
    {
        return view('livewire.admin.lazy');
    }

    public function render()
    {
        $users = User::query()
            ->orderBy('id', $this->sortId ? "ASC" : "DESC")
            ->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->orWhere('mobile', 'like', '%'.$this->search.'%')
            ->paginate(10);
        return view('livewire.admin.user.users' , compact('users'));
    }
}
