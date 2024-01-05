<x-layout>
        @livewire('banner')
        <div class="p-8">
            <livewire:card-user-edit :user="$user" />
        </div>
    </x-layout>