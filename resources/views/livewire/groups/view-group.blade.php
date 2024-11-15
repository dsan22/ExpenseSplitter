<?php

use Livewire\Volt\Component;

new class extends Component {
   public $group;


    public function mount($group){
        $this->group=$group;
    }


}; ?>

<div>
    <div class="flex justify-between px-20">
        <div class="text-4xl font-bold">{{$group->name}}</div>
       
        <livewire:groups.show-members-modal :group="$group"/>
    </div>
   
</div>
