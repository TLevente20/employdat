<x-layout>
    @livewire('banner')
    <div class="p-8">
        
        <livewire:card-edit-person :person="$person" />
    </div>
</x-layout>