<form class="mb-8 space-y-3" wire:submit="create">
    <x-forms.text-area class="dark:bg-gray-800" id="form.body" name="form.body" rows="6" placeholder="Write a Reply"
        wire:model="form.body" />

    <x-buttons.primary type="submit">
        {{ __('Post reply') }}
    </x-buttons.primary>
</form>
