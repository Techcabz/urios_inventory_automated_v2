<?php

namespace App\Livewire;

use Livewire\Component;

class GlobalEventHandler extends Component
{
    
    protected $listeners = ['userStatusUpdatedEvent' => 'relayUserStatusUpdated'];

    public function relayUserStatusUpdated()
    {
        //  dd("test1");
        $this->dispatch('userStatusUpdated')->to('global.frontend.status');

    }

    public function render()
    {
        return view('livewire.global-event-handler');
    }
}
