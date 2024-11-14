<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Groups') }}
        </h2>
    </x-slot>

    <div class=" py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 overflow-hidden">
        <livewire:groups.show-groups :groups="$groups"/>
    </div>
  
</x-app-layout>
