<?php

use Livewire\Volt\Component;

new class extends Component {
    protected $listeners = [
        'groupsChanged' => 'refreshGroup'
    ];
   public $group;

    public function mount($group){
        $this->group=$group;
    }
    public function refreshGroup(){
        $this->group->refresh();
    }
}; ?>

<div>
    <div class="flex justify-between px-20">
        <div class="text-4xl font-bold">{{$group->name}}</div>
        <livewire:groups.show-members-modal :group="$group"/>
    </div>
    <div class="w-full mt-6">
        <div class="m-5">
            <livewire:expenses.create-expense-modal :group="$group"/>
        </div>
        <div class="table w-full">
            <div class="table-header-group bg-cyan-100">
                <div class="table-row">
                    <div class="table-cell px-4 py-2 ">Name</div>
                    <div class="table-cell px-4 py-2  ">Amount</div>
                    <div class="table-cell px-4 py-2  ">Unit Price</div>
                    <div class="table-cell px-4 py-2  ">Added By</div>
                    <div class="table-cell px-4 py-2  ">Action</div>
                </div>
            </div>
            <div class="table-row-group">
                @foreach ($group->expenses as $expense)
                    <livewire:expenses.expense-row wire:key="{{$expense->id}}"
                        :expense="$expense"
                        :class="$loop->even ? 'bg-cyan-50 hover:bg-cyan-100' : 'bg-white hover:bg-cyan-100'"
                    />
                 @endforeach
            </div>
       
        </div>
    </div>
</div>
