<x-app-layout>
    <div class="grid grid-cols-4 gap-4">
        <div class="col-span-1">
            <livewire:category-list /> 
        </div>
        <div class="col-span-3">
            <livewire:post-list /> 
            {{$page[0]->title}}
        </div>
    </div>
</x-app-layout>
