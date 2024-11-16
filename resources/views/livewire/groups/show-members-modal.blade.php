<?php

use Livewire\Volt\Component;
use App\Models\Group;

new class extends Component {
    public $modalOpen = false;
    public $users;
    public $group;
    public function openModal(){
        $this->modalOpen=true;
    }
    public function mount($group){
        $this->group=$group;
        $this->users = $group->users->except(auth()->id());
    }
}; ?>

<div>
    <div>
        <x-button.circle lg sky icon="user-group"  wire:click="openModal"/>
    </div>
    <x-modal.card title="Members" blur wire:model="modalOpen">
        <div class="flex justify-end px-8 space-x-3">
            <x-button negative label="Leave"/>
            <livewire:groups.add-members-modal :group="$group" />
        </div>
       
        <div class="bg-gray-50 mt-5 p-6">
            @foreach ($users as $user)
                <div class="flex items-center justify-between py-4 border-b border-gray-200">
                    <div class="text-gray-700 font-medium">{{ $user->name }}</div>
                    <x-button.circle sm negative icon="user-remove" wire:click="removeFromGroup" />
                </div>
            @endforeach
        </div>
    </x-modal.card>
</div>