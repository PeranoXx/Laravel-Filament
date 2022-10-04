<div>
    <form wire:submit.prevent="submit">
        {{ $this->form }}

        <button type="submit" class="mt-5 hover:bg-indigo-500 hover:text-white py-2 px-4 rounded-md border border-indigo-500 text-indigo-500">
            Submit
        </button>
    </form>
</div>
