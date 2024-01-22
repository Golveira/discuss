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
