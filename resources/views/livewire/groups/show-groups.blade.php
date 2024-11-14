<?php

use Livewire\Volt\Component;
use App\Models\Group;

new class extends Component {
    public $groups;
    protected $listeners = ['groupsChanged' => 'refreshGroups'];
    public function mount($groups)
    {
        $this->groups = $groups; 
    }
    public function refreshGroups()
    {
        $this->groups = auth()->user()->groups;
    }

    public function deleteGroup($id)
    {
        $group = Group::find($id);
        $group->delete();
        $this->dispatch('groupsChanged');
    }
}; ?>

<div>
    <div class="grid grid-cols-2 gap-2 mt-6">
   @foreach ($this->groups as $group)
    <x-card wire:key="{{$group->id}}">
        <div class="flex justify-between ">
            <div >
                <a href="#" class="text-xl font-bold ">{{$group->name}}</a>
            </div>
            <div class="flex">
                <div class="text-gray-400 text-sm mx-7 py-1 "> Members: {{$group->users->count()}} </div> 
                <x-button.circle icon="trash" negative wire:click="deleteGroup({{$group->id}})"/>
            </div>
        </div>
       
    </x-card>
       
   @endforeach
    </div>
</div>
