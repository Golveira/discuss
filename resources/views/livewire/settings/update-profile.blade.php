<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Update your profile information.') }}
        </p>
    </header>

    <form class="mt-6 space-y-6" wire:submit="updateProfileInformation">
        <div>
            <x-forms.input id="name" name="name" type="text" label="Name" wire:model="name" />
        </div>

        <div>
            <x-forms.input id="username" name="username" type="text" label="Username" wire:model="username" />
        </div>

        <div>
            <x-forms.input id="email" name="email" type="email" label="Email" wire:model="email" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&
                    !auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="mt-2 text-sm text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button
                            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                            wire:click.prevent="sendVerification">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-buttons.primary>
                {{ __('Save') }}
            </x-buttons.primary>
        </div>
    </form>
</section>
