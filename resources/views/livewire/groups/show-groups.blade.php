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
    <div class="grid grid-cols-2 gap-2 mt-6">
   @foreach ($this->groups as $group)
    <x-card wire:key="{{$group->id}}">
        <div class="flex justify-between ">
            <a href="#" class="text-xl font-bold ">{{$group->name}}</a>
            <div class="text-gray-400 text-sm mx-7 py-1 "> Members: {{$group->users->count()}} </div> 
        </div>
       
    </x-card>
       
   @endforeach
    </div>
</div>
