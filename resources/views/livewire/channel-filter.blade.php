<div wire:ignore>
    <x-forms.select class="w-full" wire:model.live="channelPath">
        <option value="/discussions">
            {{ __('All') }}
        </option>

        @foreach ($channels as $channel)
            <option value="{{ $channel->path }}">
                {{ $channel->name }}
            </option>
        @endforeach
    </x-forms.select>
</div>
