<?php

use Livewire\Volt\Component;

new class extends Component {
    public $groups;

    public function mount($groups)
    {
        $this->groups = $groups; 
    }
}; ?>

<div>
   @foreach ($groups as $group)
    <p>{{$group->name}}</p>    
   @endforeach
</div>
