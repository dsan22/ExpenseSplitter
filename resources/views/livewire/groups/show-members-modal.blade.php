<?php

use Livewire\Volt\Component;
use App\Models\Group;
use App\Models\User;

new class extends Component {
    protected $listeners = [
        'membersChanged' => 'loadUsers'
    ];
    public $modalOpen = false;
    public $users;
    public Group $group;

    public function openModal()
    {
        $this->modalOpen = true;
    }

    public function mount(Group $group)
    {
        $this->group = $group;
        $this->loadUsers();
      
    }
    public function loadUsers(){
        $this->users= $this->group->users->except(auth()->id());
    }

    public function removeFromGroup($userId)
    {
        $this->group->users()->detach($userId);
        $this->group->refresh();
        $this->loadUsers();
    }
};?>
<div>
    <div>
        <x-button.circle lg sky icon="user-group" wire:click="openModal" />
    </div>
    <x-modal.card title="Members" blur wire:model="modalOpen">
        <div class="flex justify-end px-8 space-x-3">
            <x-button negative label="Leave" />
            <livewire:groups.add-members-modal :group="$group" />
        </div>

        <div class="bg-gray-50 mt-5 p-6 space-y-4">
            @foreach ($users as $user)
                <div 
                    wire:key="user-{{ $user->id }}" 
                    class="flex items-center justify-between py-4 border-b border-gray-200"
                    wire:transition.fade
                >
                    <div class="text-gray-700 font-medium">{{ $user->name }}</div>
                    <x-button.circle 
                        sm 
                        negative 
                        icon="user-remove" 
                        wire:click="removeFromGroup({{ $user->id }})" 
                    />
                </div>
            @endforeach
        </div>
    </x-modal.card>
</div>