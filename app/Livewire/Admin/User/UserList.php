<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use function Laravel\Prompts\alert;

class UserList extends Component
{

    public $image;
    public $editUserIndex=null;

    #[Js]
    public function resetSearch()
    {
        return <<<'JS'
            $wire.search='';
        JS;

    }

    public function render()
    {
        return view('livewire.admin.user.user-list')->layout('admin.master');
    }
}
