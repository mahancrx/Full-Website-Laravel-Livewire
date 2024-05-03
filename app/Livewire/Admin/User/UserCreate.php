<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UserCreate extends Component
{
    use WithPagination,WithFileUploads;

    #[Rule('required')]
    public $name;
    #[Rule('required|unique:users,email')]
    public $email;
    #[Rule('required|unique:users,mobile|max:11|min:11')]
    public $mobile;
    #[Rule('required')]
    public $password;
    public $image;
    public $editUserIndex;

    //-------------{Create User}-----------
    public function saveUser()
    {
        $this->validate();

        if ($this->image != null){
            $name = time().'.'.$this->image->getClientOriginalExtension();
            $this->image->storeAs('photos',$name,'images');
        }else{
            $name=null;
        }

        User::query()->create([
            'name'=>$this->name,
            'email'=>$this->email,
            'mobile'=>$this->mobile,
            'password'=>Hash::make($this->password),
            'image'=>$name,

        ]);
        $this->reset('name','email','mobile','password','image');
        session()->flash('message', 'کاربر جدید ایجاد شد');
        $this->dispatch('user-created');
    }
    #[on('editRow')]
    public function editRow($user_id)
    {
        $this->editUserIndex=$user_id;

        $user = User::query()->find($user_id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->mobile = $user->mobile;

    }

    #[on('updateRow')]
    public function updateRow($user_id)
    {
        $this->validate([
            'name'=>'required',
            'mobile'=>'required|max:11|min:11|unique:users,mobile,'.$user_id,
            'email'=>'required|unique:users,email,'.$user_id,
        ]);
        $user = User::query()->find($user_id);
        if ($this->image != null){
            $name = time().'.'.$this->image->getClientOriginalExtension();
            $this->image->storeAs('photos',$name,'images');
        }else{
            $name=$user->image;
        }
        $user->update([
            'name'=>$this->name,
            'email'=>$this->email,
            'mobile'=>$this->mobile,
            'password'=>$this->password ? Hash::make($this->password) : $user->password,
            'image'=>$name,
        ]);
        $this->reset('name','email','mobile','image','password',);
        session()->flash('message', 'کاربر ویرایش شد');
        $this->editUserIndex=null;
        $this->dispatch('user-updated');
    }
    //-------------{livewire View}-----------
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.user.user-create');
    }
}
