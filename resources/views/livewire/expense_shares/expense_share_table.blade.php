<?php

use Livewire\Volt\Component;
use App\Models\Expense;
use App\Models\ExpenseShare;
new class extends Component {
    public Expense $expense; 
    public $expenseShares;

    public function mount(Expense $expense){
        $this->expense= $expense;
        $this->expenseShares=$expense->expenseShare;
    }

}; ?>


<table class="w-full">
    <thead class="bg-gray-300">
        <tr>
            <th class="px-4 py-2">Member</th>
            <th class="px-4 py-2">Portion</th>
            <th class="px-4 py-2">Ammount portion</th>
            <th class="px-4 py-2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenseShares as $share)
        <tr class="bg-gray-200"
            wire:key="expense-{{ $expense->id }}">
            <td class="px-4 py-2">{{$share->user->name}}</td>
            <td class="px-4 py-2">{{$share->weight}}</td>
            <td class="px-4 py-2">to be done</td>
            <td class="px-4 py-2">...</td>
        </tr>
        @endforeach
    </tbody>
</table>
