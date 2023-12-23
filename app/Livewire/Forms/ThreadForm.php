<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ThreadForm extends Form
{
    #[Validate('required|min:5|max:100')]
    public string $title = '';

    #[Validate('required|min:5|max:5000',)]
    public string $body = '';

    #[Validate('required|exists:channels,id', as: 'channel')]
    public string $channel_id = '';
}
