<x-app-layout>
    <div class="grid grid-cols-4 gap-4">
        <div class="col-span-1">
            <livewire:category-list />
        </div>
        <div class="col-span-3">
            <livewire:post-list />
            <x-tall-interactive::slide-over id="create-user" :form="\App\Forms\UserForm::class" />
            <button onclick="Livewire.emit('modal:open', 'create-user')" type="button" class="...">
                Open Modal
            </button>
        </div>
    </div>
</x-app-layout>
