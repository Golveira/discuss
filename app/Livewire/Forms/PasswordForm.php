<?php

namespace App\Livewire\Forms;

use Illuminate\Validation\Rules\Password;
use Livewire\Form;

class PasswordForm extends Form
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function rules()
    {
        return [
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
        ];
    }
}
