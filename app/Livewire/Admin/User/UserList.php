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
        session()->flash('message', 'کاربر ویرایش شد');
        $this->editUserIndex=null;
    }
    //-------------{Edit User Row Table}-----------
    public function editRow($user_id)
    {
        $this->editUserIndex=$user_id;
        $user = User::query()->find($user_id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->mobile = $user->mobile;
    }

    //-------------{Refresh Component After Create User}-----------
    #[on('user-created')]
    public function userUpdated()
    {

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
