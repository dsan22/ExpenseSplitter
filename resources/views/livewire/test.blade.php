<?php

use Livewire\Volt\Component;

new class extends Component {
    public $list=[1,2,3,4,5,6,7,8,9];
    public $show=null;

    public function showComponent($item){
        $this->show= $item===$this->show?null:$item;
    }
}; ?>

<div>
    <livewire:expense_shares.expense_share_table  />
    
</div>
