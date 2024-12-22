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
    public function loadUsers() {
        //todo users dose not refresh as intended  
        $this->users= $this->group->users->except(auth()->id());
    }

    public function removeFromGroup($userId)
    {
        $this->group->users()->detach($userId);
        $this->group->refresh();
        $this->loadUsers();
    }
    public function confirmPayment($userId)
    {
        $user=User::find($userId);
        $user->setPaymentDone($this->group);
        $this->group->refresh();
        $this->loadUsers();
    }

    public function leave()
    {
        $this->group->users()->detach(auth()->user());
        return redirect()->route('groups.index'); //
    }
};?>
<div>
    <div>
        <x-button.circle lg sky icon="user-group" wire:click="openModal" />
    </div>
    <x-modal.card title="Members" blur wire:model="modalOpen" wire:key="modal-group-{{ $group->id }}">
        <div class="flex justify-between px-8 space-x-3">
            <div class="flex justify-between px-8 w-3/4">
                <div>{{auth()->user()->name}}</div>
                <div>Your payment: {{auth()->user()->calculateUserPaymentForGroup($group)}} $</div>
            </div>
            @if (!$group->finished)
                <div class="flex justify-between px-3 w-1/4">
                    <x-button negative label="Leave"  wire:click="leave" />
                    <livewire:groups.add-members-modal :group="$group" />
                </div>
            @endif
            
        </div>

        <div class="bg-gray-50 mt-5 p-6 space-y-4">
            @foreach ($users as $user)
                <div 
                    wire:key="{{$user->id}}" 
                    class="flex items-center justify-between py-4 border-b border-gray-200"
                >
                    <div class="text-gray-700 font-medium w-2/5 ">{{ $user->name }}</div>
                    <div class="text-gray-700 font-medium w-1/5 text-center">{{ $user->calculateUserPaymentForGroup($group) }} $</div>
                    <div class="flex justify-center w-1/5">
                        @if (!$group->finished)
                            <x-button.circle 
                                sm 
                                negative 
                                icon="user-remove" 
                                wire:click="removeFromGroup({{ $user->id }})" 
                            />
                        @else
                            @if(!$user->getPaymentDone($group))
                                <x-badge negative label="Not paid" />
                            @else
                                <x-badge green label="Paid" />
                            @endif
                        @endif
                    </div>
                    @if ($group->finished&&$group->admin_id===auth()->id())
                    <div class="text-gray-700 font-medium w-1/5 ">
                        @if (!$user->getPaymentDone($group))
                            <x-button xs positive label="Confirm Payment"  wire:click="confirmPayment({{ $user->id }})" />
                        @endif
                    </div>
                    @endif
                </div>
            @endforeach
        </div>
    </x-modal.card>
</div>