<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowProfile extends Component
{

    public $user; 

    public function mount()
    {
        $this->user = Auth::user(); 
    }

    public function render()
    {
        return view('livewire.profile.show-profile', ['user' => $this->user]);
    }
}
