<?php

namespace App\Livewire\Admin\Panel;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.panel.index')->layout('admin.master');
    }
}
