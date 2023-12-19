<div class="flex items-center justify-end">
    <span class="me-4 text-white">
        {{ __('Sort by') }}
    </span>

    <x-forms.select class="w-32" wire:model.live="sortBy">
        <option value="old" selected>
            {{ __('Oldest') }}
        </option>

        <option value="new">
            {{ __('Newest') }}
        </option>

        <option value="popular">
            {{ __('Popular') }}
        </option>
    </x-forms.select>
</div>
