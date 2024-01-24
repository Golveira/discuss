<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Livewire\Actions\Logout;
use App\Livewire\Forms\ProfileForm;
use App\Livewire\Forms\PasswordForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Usernotnull\Toast\Concerns\WireToast;

#[Title('Settings')]
class SettingsIndex extends Component
{
    use WireToast;

    public ProfileForm $profileForm;

    public PasswordForm $passwordForm;

    public User $user;

    public function mount()
    {
        $this->user = Auth::user();

        $this->profileForm->setProperties(Auth::user());
    }

    public function updateProfile(): void
    {
        $this->profileForm->validate();

        $this->user->fill($this->profileForm->all());

        if ($this->user->isDirty('email')) {
            $this->user->email_verified_at = null;
        }

        $this->user->save();

        toast()->success('Profile updated')->push();
    }

    public function updatePassword(): void
    {
        $this->passwordForm->validate();

        $this->user->update([
            'password' => Hash::make($this->passwordForm->password),
        ]);

        $this->passwordForm->reset();

        toast()->success('Password updated successfully')->push();
    }

    public function deleteAccount(Logout $logout): void
    {
        tap($this->user, $logout(...))->delete();

        toast()->success('Your account has been deleted.')->pushOnNextPage();

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }

    public function sendVerification(): void
    {
        if ($this->user->hasVerifiedEmail()) {
            $path = session('url.intended', RouteServiceProvider::HOME);

            $this->redirect($path);

            return;
        }

        $this->user->sendEmailVerificationNotification();

        toast()->success('Verification link sent')->push();
    }

    public function render()
    {
        return view('livewire.pages.settings-index');
    }
}
