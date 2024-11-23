<?php

use Livewire\Volt\Component;
use App\Models\Expense;

new class extends Component {
   

    public $expenses;
    public $show=null;

    public function mount($expenses){
        $this->expenses = $expenses;
    }

    public function toggle($id){
        $this->show = ($this->show === $id) ? null : $id;
    }
    public function openAddExpenseModal(Expense $expense){
        $this->dispatch('openAddExpenseShareModal',$expense);
    }
};?>
<div>
<table class="w-full">
    <thead class="bg-cyan-100">
        <tr>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Amount</th>
            <th class="px-4 py-2">Unit Price</th>
            <th class="px-4 py-2">Total Price</th>
            <th class="px-4 py-2">Added By</th>
            <th class="px-4 py-2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenses as $expense)
            <tr 
                class="{{ $loop->even ? 'bg-cyan-50 hover:bg-cyan-100' : 'bg-white hover:bg-cyan-100' }}"
                wire:key="expense-{{ $expense->id }}"
               
            >
                <td class="px-3 py-3"  wire:click="toggle({{ $expense->id }})">{{ $expense->name }}</td>
                <td class="px-3 py-3">{{ $expense->amount }}</td>
                <td class="px-3 py-3">{{ $expense->unit_price }}</td>
                <td class="px-3 py-3">{{ $expense->getTotalPrice() }}</td>
                <td class="px-3 py-3">{{ $expense->added_by->name }}</td>
                <td class="px-3 py-3">
                    <x-button.circle  emerald icon="user-add"  wire:click="openAddExpenseModal({{$expense}})"/>
                </td>
            </tr>
        
            <tr 
                class="{{ $show === $expense->id ? '' : 'hidden' }}" 
                wire:key="expense-details-{{ $expense->id }}"
            >
                <td class="px-5" colspan="5">
                    @if ($show===$expense->id)
                    <livewire:expense_shares.expense_share_table :expense="$expense"  />
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<livewire:expense_shares.add-expense-share-modal   />
<div>
