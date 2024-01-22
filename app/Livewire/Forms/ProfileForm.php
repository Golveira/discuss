<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Form;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class ProfileForm extends Form
{
    public User $user;
    public string $name = '';
    public string $username = '';
    public string $email = '';

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'alpha_dash', 'max:40', Rule::unique(User::class)->ignore($this->user->id)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user->id)],
        ];
    }

    public function setProperties(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
    }
}
