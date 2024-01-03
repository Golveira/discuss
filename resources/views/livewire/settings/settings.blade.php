<x-section maxWidth="lg">
    <div class="grid gap-8 lg:grid-cols-4">
        <div class="lg:col-span-1">
            <x-list-group>
                <x-list-group-item href="#profile" value="Profile" />
                <x-list-group-item href="#password" value="Password" />
                <x-list-group-item href="#remove-account" value="Remove Account" />
            </x-list-group>
        </div>

        <div class="space-y-6 lg:col-span-3 lg:space-y-10">
            <x-card>
                <livewire:settings.update-profile />
            </x-card>

            <x-card>
                <livewire:settings.update-password />
            </x-card>

            <x-card>
                <livewire:settings.delete-account />
            </x-card>
        </div>
    </div>
</x-section>
