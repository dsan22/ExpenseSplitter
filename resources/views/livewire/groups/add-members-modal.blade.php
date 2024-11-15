<?php

use Livewire\Volt\Component;
use App\Models\User;

new class extends Component {
    public $modalOpen = false;
    public $email;
    public $group;
    public function mount($group){
        $this->group=$group;
    }
    public function addUser(){
        $this->validate([
            'email' => 'required|exists:users,email',
        ]);
        $user=User::where("email",$this->email)->first();
        if ($this->group->users->contains($user)) {
            $this->addError('email', 'This user is already a member of the group.');
            return;
        }
        $user->groups()->attach($this->group->id);
        
    }
    
    public function openModal(){
        $this->modalOpen=true;
    }
}; ?>

<div>
    <div>
        <x-button.circle  emerald icon="user-add"  wire:click="openModal"/>
    </div>
    <x-modal.card title="Add User" blur wire:model="modalOpen">
        <form wire:submit="addUser">
            <x-input label="Email"  type="email" placeholder="mail@email.com" wire:model="email"  />

            <div class="flex justify-end">
                <div class="flex mt-3">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Add" type="submit"/>
                </div>
            </div>
        </form>
    </x-modal.card>
</div>