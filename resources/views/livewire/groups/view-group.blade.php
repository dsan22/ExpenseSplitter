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
}; ?>

<div>
    <div class="flex justify-between px-20">
        <div class="text-4xl font-bold">{{$group->name}}</div>
        <livewire:groups.show-members-modal :group="$group"/>
    </div>
    <div class="w-full mt-6">
        @if (!$group->finished)
        <div class="m-5">
            <livewire:expenses.create-expense-modal :group="$group"/>
        </div>
        @endif
      

        <div>
            <livewire:expenses.expense-table :group="$group" :key="$tableKey"/>
        </div>
    </div>
</div>
