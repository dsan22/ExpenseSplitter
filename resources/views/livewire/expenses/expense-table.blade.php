<?php

use Livewire\Volt\Component;
use App\Models\Expense;

new class extends Component {
    public $expenses;

    public function mount($expenses){
        $this->expenses = $expenses;
    }
};?>
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
        @foreach ($expenses as $expense)
            <div 
                class="{{'table-row '.($loop->even ? 'bg-cyan-50 hover:bg-cyan-100' : 'bg-white hover:bg-cyan-100') }}"
                wire:key="expense-{{$expense->id }}"
            >
                <div class="table-cell ps-3 py-3">  {{$expense->name}}</div>
                <div class="table-cell ps-3 py-3">  {{$expense->amount}}</div>
                <div class="table-cell ps-3 py-3">  {{$expense->unit_price}}</div>
                <div class="table-cell ps-3 py-3">  {{$expense->added_by->name}}</div>
                <div class="table-cell ps-3 py-3">  ...</div>
            </div>
    
        @endforeach
    </div>
</div>

