<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Profile
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Update your profile information.
        </p>
    </header>

    <div class="flex gap-6">
        <form class="mt-6 w-2/3 space-y-6" wire:submit="updateProfile">
            {{-- Name --}}
            <div>
                <x-forms.input id="profileForm.name" name="profileForm.name" type="text" label="Name"
                    wire:model="profileForm.name" />
            </div>

            {{-- Username --}}
            <div>
                <x-forms.input id="profileForm.username" name="profileForm.username" type="text" label="Username"
                    wire:model="profileForm.username" />
            </div>

            {{-- Email --}}
            <div>
                <x-forms.input id="profileForm.email" name="profileForm.email" type="email" label="Email"
                    wire:model="profileForm.email" />

                <x-profile.verify-email />
            </div>

            <div class="flex items-center gap-4">
                <x-buttons.primary>
                    {{ __('Update profile') }}
                </x-buttons.primary>
            </div>
        </form>

        <livewire:upload-avatar>
    </div>
</section>
