<div wire:ignore>
    <x-list-group>
        <x-list-group-item href="/discussions" value="All Threads" :active="request()->is('discussions')" wire:navigate />

        @foreach ($channels as $channel)
            <x-list-group-item :href="$channel->path" :value="$channel->name" :active="request()->is('discussions/channels/' . $channel->slug)" wire:navigate />
        @endforeach
    </x-list-group>
</div>
