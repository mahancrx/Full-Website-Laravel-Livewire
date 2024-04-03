<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    #[Rule('required')]
    public $name;
    #[Rule('required|unique:users,email')]
    public $email;
    #[Rule('required')]
    public $mobile;
    #[Rule('required')]
    public $password;
    #[Rule('required')]
    public $image;

    public function saveUser()
    {
        $this->validate();

        User::query()->create([
            'name'=>$this->name,
            'email'=>$this->email,
            'mobile'=>$this->mobile,
            'password'=>Hash::make($this->password),
            'image'=>'',

        ]);
        $this->reset('name','email','mobile','password','image');
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
