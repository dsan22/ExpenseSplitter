<?php

use Livewire\Volt\Component;
use App\Models\Expense;
use App\Models\ExpenseShare;
new class extends Component {

    protected $listeners = [
        'expenseSharesChanged' => 'refreshExpense'
    ];
    public Expense $expense; 
    public $expenseShares;

    public function mount(Expense $expense){
        $this->expense= $expense;
        $this->expenseShares=$expense->expenseShares;
    }
    public function refreshExpense(){
        $this->expense->refresh();
        $this->expenseShares=$this->expense->expenseShares;
    }
    
    public function deleteExpenseShare(ExpenseShare $share){
        $share->delete();
        $this->refreshExpense();
    }

}; ?>


<table class="w-full">
    <thead class="bg-gray-300">
        <tr>
            <th class="px-4 py-2">Member</th>
            <th class="px-4 py-2">Weight</th>
            <th class="px-4 py-2">Portion</th>
            <th class="px-4 py-2">Users Payment</th>
            <th class="px-4 py-2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenseShares as $share)
        <tr class="bg-gray-200"
            wire:key="expense-share-{{ $expense->id }}">
            <td class="px-4 py-2">{{$share->user->name}}</td>
            <td class="px-4 py-2">{{$share->weight}}</td>
            <td class="px-4 py-2">{{$share->calculatePortion()}}</td>
            <td class="px-4 py-2">{{$share->calculateUserPayment()}}</td>
            <td class="px-4 py-2">
                @if(!$expense->group->finished)
                    <x-button.circle  negative  icon="trash"  wire:click="deleteExpenseShare({{$share}})"/>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
