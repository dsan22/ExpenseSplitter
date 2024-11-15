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
        $this->users=$group->users;
    }
}; ?>

<div>
    <div>
        <x-button.circle lg sky icon="user-group"  wire:click="openModal"/>
    </div>
    <x-modal.card title="Members" blur wire:model="modalOpen">
        <livewire:groups.add-members-modal :group="$group"/>
    </x-modal.card>
</div>