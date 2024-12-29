<?php

use Livewire\Volt\Component;

new class extends Component {
    protected $listeners = [
        'groupsChanged' => 'refreshGroup'
    ];
   public $group;
   public $expenses;
   public $tableKey;

    public function mount($group){
        $this->group=$group;
        $this->expenses=$group->expenses;
        $this->tableKey = uniqid();
    }
    public function refreshGroup(){
        $this->group->refresh();
        $this->expenses=$this->group->expenses;
        $this->tableKey = uniqid();
    }
    public function finilizeGroup(){
        $this->group->finished=true;
        $this->group->save();
        $this->refreshGroup();
    }
}; ?>

<div>
    <div class="flex justify-between px-20">
        <div>
            <div class="text-4xl font-bold">{{$group->name}}</div>
            <div class="text-2xl text-gray-400">Admin: {{$group->admin->name}}</div>
        </div>
        <livewire:groups.show-members-modal :group="$group"/>
    </div>
    <div class="w-full mt-6">
        @if (!$group->finished)
        <div class="m-5 flex gap-3">
            <livewire:expenses.create-expense-modal :group="$group"/>
            <x-button sky icon="check" wire:click="finilizeGroup">Finilize Group</x-button>
        </div>
        @endif
      

        <div>
            <livewire:expenses.expense-table :group="$group" :key="$tableKey"/>
        </div>
    </div>
</div>
