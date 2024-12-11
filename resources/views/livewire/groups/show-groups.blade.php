<?php

use Livewire\Volt\Component;
use App\Models\Group;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    protected $listeners = [
        'groupsChanged' => '$refresh'
    ];

    public function with()
    {
        return [
            "groups"=>Auth::user()->groups
        ];
    }
}; ?>

<div wire:poll.5s>
    @if ($groups->isEmpty())
        <div class="flex align-middle items-center text-center justify-center w-full">
            <div class="mt-16">
                <div class="text-3xl">You dont have any group</div>
                <div class="text-xl">Create new one.</div>
            </div>
        </div>
    @else    
        <div class="grid grid-cols-2 gap-2 mt-6">
            @foreach ($groups as $group)
                <div wire:key="{{$group->id}}" wire:transition>
                    <x-card  >
                        <div class="flex justify-between ">
                            <div class="flex gap-5 items-center">
                                <div >
                                    <a href={{route('groups.view',$group)}} class="text-xl font-bold ">{{$group->name}}</a>
                                </div>
                                <div>
                                    @if ($group->finished)
                                        <x-badge rose label="Finished" /> 
                                    @endif 
                                </div>
                            </div>
                            <div class="flex">
                                <div class="text-gray-400 text-sm mx-7 py-1 "> Members: {{$group->users->count()}} </div> 
                            </div>
                        </div>
                    </x-card>
                </div>
            @endforeach
        </div>
    @endif
</div>
