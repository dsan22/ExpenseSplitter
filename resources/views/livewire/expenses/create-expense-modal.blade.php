<?php

use Livewire\Volt\Component;
use App\Models\Group;
use App\Models\Expense;

new class extends Component {
    public $modalOpen = false;
    public Group $group;
    public $expenseName;
    public $expenseAmount;
    public $expenseUnitPrice;



    public function createNewExpense(){
        $this->validate([
            'expenseName'       => 'required|string|max:255',
            'expenseAmount'     => 'required|integer|min:1',
            'expenseUnitPrice' => 'required|numeric|min:0',
        ]);

        $expense = new Expense([
            'name' => $this->expenseName,
            'amount' => $this->expenseAmount,
            'unit_price' => $this->expenseUnitPrice,
        ]);
        $expense->group()->associate($this->group);
        $expense->added_by()->associate(auth()->user());
        $expense->save();

        $this->reset('expenseName');
        $this->reset('expenseAmount');
        $this->reset('expenseUnitPrice');

        $this->modalOpen = false;
        $this->dispatch('groupsChanged');
    }
    public function openModal(){
        $this->modalOpen=true;
    }
    public function mount(Group $group){
        $this->group=$group;
    }
}; ?>

<div>
    <div>
        <x-button emerald icon="plus" wire:click="openModal">Add New Expense</x-button>
    </div>
    <x-modal.card title="Create New Expense" blur wire:model="modalOpen">
        <form wire:submit="createNewExpense">
            <x-input label="Name" placeholder="Soda" wire:model="expenseName"  />
            <div class="grid grid-cols-2 gap-2 mt-2">
                <x-input label="Amount" type="number" placeholder="2" wire:model="expenseAmount"  />
                <x-input label="Unit Price" type="number" step="0.01"  placeholder="4.3" wire:model="expenseUnitPrice"  />    
            </div>
            <div class="flex justify-end">
                <div class="flex mt-3">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" type="submit"/>
                </div>
            </div>
        </form>
    </x-modal.card>
</div>