<?php

use Livewire\Volt\Component;
use App\Models\Group;

new class extends Component {
    public $modalOpen = false;
    public $groupName;
    public function createNewGroup(){
        $this->validate([
            'groupName' => 'required|string|max:255',
        ]);
        $group = Group::create([
            'name' => $this->groupName,
        ]);
        $this->reset('groupName');
        Auth::user()->groups()->attach($group->id);
        $this->modalOpen = false;
        $this->dispatch('groupsChanged');
    }
    public function openModal(){
        $this->modalOpen=true;
    }
}; ?>

<div>
    <div>
        <x-button emerald icon="plus" wire:click="openModal">Create New Group</x-button>
    </div>
    <x-modal.card title="Create New Group" blur wire:model="modalOpen">
        <form wire:submit="createNewGroup">
            <x-input label="Name" placeholder="Group name" wire:model="groupName"  />

            <div class="flex justify-end">
                <div class="flex mt-3">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" type="submit"/>
                </div>
            </div>
        </form>
    </x-modal.card>
</div>