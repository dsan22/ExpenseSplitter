<?php

use Livewire\Volt\Component;
use App\Models\Expense;

new class extends Component {
    public $expense;
    public $class;
    public function mount($expense){
        $this->expense=$expense;
    }
}; ?>

<div class="{{'table-row '.$this->class}}">
    <div class="table-cell ps-3 py-3">  {{$expense->name}}</div>
    <div class="table-cell ps-3 py-3">  {{$expense->amount}}</div>
    <div class="table-cell ps-3 py-3">  {{$expense->unit_price}}</div>
    <div class="table-cell ps-3 py-3">  {{$expense->added_by->name}}</div>
    <div class="table-cell ps-3 py-3">  ...</div>
</div>
