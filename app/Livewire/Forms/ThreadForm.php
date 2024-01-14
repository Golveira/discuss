<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Thread;
use Livewire\Attributes\Validate;

class ThreadForm extends Form
{
    #[Validate('required|min:2|max:100')]
    public string $title = '';

    #[Validate('required|min:2|max:5000',)]
    public string $body = 'testing';

    #[Validate('required|exists:channels,id', as: 'channel')]
    public string $channel_id = '';

    public function setProperties(Thread $thread)
    {
        $this->title = $thread->title;
        $this->body = $thread->body;
        $this->channel_id = $thread->channel_id;
    }
}
