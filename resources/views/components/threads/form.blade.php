@props(['title'])

<x-card>
    <div class="lg:p-4">
        <h2 class="mb-10 text-2xl font-bold text-gray-900 dark:text-white">
            {{ $title }}
        </h2>

        <form class="space-y-8" wire:submit="save">
            <div>
                <x-forms.input id="form.title" name="form.title" type="text" label="Title" wire:model="form.title" />
            </div>

            <div>
                <x-channel-select id="form.channel_id" name="form.channel_id" label="Channel"
                    wire:model="form.channel_id" />
            </div>

            <div>
                <x-forms.text-area id="form.body" name="form.body" rows="16" label="Body"
                    wire:model="form.body" />
            </div>

            <div class="flex justify-end gap-4">
                <x-buttons.secondary href="{{ route('threads.index') }}" wire:navigate>
                    {{ __('Cancel') }}
                </x-buttons.secondary>

                <x-buttons.primary type="submit">
                    {{ __('Submit') }}
                </x-buttons.primary>
            </div>
        </form>
    </div>
</x-card>
