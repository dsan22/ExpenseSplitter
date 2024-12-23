<?php

use Livewire\Volt\Component;
use App\Models\User;
use App\Models\GroupInvitation;
use App\Models\Group;
use App\Mail\GroupInvitationMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


new class extends Component {
    public $modalOpen = false;
    public $email;
    public Group $group;
    public function mount(Group $group){
        $this->group=$group;
    }
    public function addUser(){
        $this->validate([
            'email' => 'required|email',
        ]);
        
        $token = Str::random(32);
        $invitation = GroupInvitation::create([
            'group_id' => $this->group->id,
            'email' => $this->email,
            'token' => $token,
        ]);
        $url = route('groups.accept-invitation', $token);

        Mail::to($this->email)->queue(new GroupInvitationMail($this->group, $url));

        $this->dispatch('membersChanged');
        $this->reset('email'); 
        $this->modalOpen = false; 
        

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
        <form wire:submit.prevent="addUser">
            <x-input label="Email" name="email" wire:model="email" type="email" placeholder="mail@email.com"  />
            <div class="flex justify-end">
                <div class="flex mt-3">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Add" type="submit"/>
                </div>
            </div>
        </form>
    </x-modal.card>
</div>