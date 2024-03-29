<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    public $name;
    public $email;
    public $mobile;
    public $password;
    public $image;

    public function saveUser()
    {
        User::query()->create([
            'name'=>$this->name,
            'email'=>$this->email,
            'mobile'=>$this->mobile,
            'password'=>Hash::make($this->password),
            'image'=>'',

        ]);

        session()->flash('message', 'کاربر جدید ایجاد شد');
    }

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $user = User::query()->paginate(10);
        return view('livewire.admin.user.user-list', compact('user'))->layout('admin.master');
    }
}
