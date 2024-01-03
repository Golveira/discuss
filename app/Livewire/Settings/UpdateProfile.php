<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class UpdateProfile extends Component
{
    use WireToast, WithFileUploads;

    public $avatar;
    public string $name = '';
    public string $username = '';
    public string $email = '';

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->username = Auth::user()->username;
        $this->email = Auth::user()->email;
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'avatar' => ['nullable', 'image', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'alpha_dash', 'max:40', Rule::unique(User::class)->ignore($user->id)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($this->avatar) {
            $user->avatar_path = $this->avatar->store('avatars', 'public');
        }

        $user->save();

        $this->dispatch('avatar-updated');

        toast()->success('Profile updated successfully')->push();
    }

    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $path = session('url.intended', RouteServiceProvider::HOME);

            $this->redirect($path);

            return;
        }

        $user->sendEmailVerificationNotification();

        toast()->success('Verification link sent')->push();
    }

    public function render()
    {
        return view('livewire.settings.update-profile');
    }
}
