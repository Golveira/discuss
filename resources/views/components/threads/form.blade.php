@props(['title'])

<x-card>
    <div class="lg:p-4">
        <h2 class="mb-10 text-2xl font-bold text-gray-900 dark:text-white">
            {{ $title }}
        </h2>

        @if ($errors->any())
            <x-forms.errors />
        @endif

        <form wire:submit="save">
            <div class="mb-8">
                <x-forms.label for="form.title" value="Title *" />
                <x-forms.input id="form.title" name="form.title" type="text" wire:model="form.title" />
                <x-forms.input-error name="form.title" />
            </div>

            <div class="mb-8">
                <x-forms.label for="form.body" value="Body *" />
                <x-forms.text-area id="form.body" name="form.body" rows="16" wire:model="form.body">
                </x-forms.text-area>
                <x-forms.input-error name="form.body" />
            </div>

            <div class="flex gap-4">
                <x-buttons.primary type="submit">
                    {{ __('Submit') }}
                </x-buttons.primary>

                <x-buttons.secondary href="{{ route('discussions.index') }}" wire:navigate>
                    {{ __('Cancel') }}
                </x-buttons.secondary>
            </div>
        </form>
    </div>
</x-card>
