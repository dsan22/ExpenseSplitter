<?php

use Livewire\Volt\Component;
use App\Models\User;
use App\Models\Expense;
use App\Models\ExpenseShare;

new class extends Component {

    protected $listeners = [
        'openAddExpenseShareModal' => 'openModal'
    ];

    public $modalOpen = false;
    public $group;
    public $expense;
    public $members;

    public $weight;
    public $userId;
    public function mount(){
        
    }
    public function addExpenseShare(){
        $this->validate([
            'userId' => 'required|exists:users,id',
            'weight' => 'required|integer|min:1',
        ]);
        $user=User::find($this->userId);
        if ($this->expense->expenseShares->contains('user_id', $user->id)) {
            $this->addError('userId', 'This user is already given an expense share for this expense.');
            return;
        }
        $expenseShare = new ExpenseShare([
            'weight' => $this->weight,
        ]);
        $expenseShare->expense()->associate($this->expense);
        $expenseShare->user()->associate($user);
        $expenseShare->save();

        $this->dispatch('expenseSharesChanged');
        $this->reset('userId');
        $this->reset('weight');
        $this->modalOpen = false;
        
        
    }
    
    public function openModal(Expense $expense){
        $this->expense=$expense;
        $this->group=$expense->group;
        $this->members=$expense->group->users;
        $this->weight=null;
        $this->userId=$this->members[0]->id;
        $this->modalOpen=true;
    }
}; ?>

<div>
    @if($expense)
    <x-modal.card title="Add Expense Share" blur wire:model="modalOpen">
        <form wire:submit="addExpenseShare">
            <x-native-select
            label="Select Status"
            :options="$members"
            option-label="name"
            option-value="id"
            wire:model="userId"
            />
            <x-input label="Weight" type="number" placeholder="1" wire:model="weight"  />


            <div class="flex justify-end">
                <div class="flex mt-3">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Add" type="submit"/>
                </div>
            </div>
        </form>
    </x-modal.card>
    @endif
</div>