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
    @foreach ($list as $item)
    <div class="flex" wire:key={{$item}}>
    <x-button wire:click="showComponent({{$item}})"> o</x-button>

    @if($this->show===$item)
    <div>
        <p>{{$item}}</p>
    </div>
    @endif
    </div>
    @endforeach
    
    
</div>
