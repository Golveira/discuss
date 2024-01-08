<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Reply;
use Livewire\Attributes\Validate;

class ReplyForm extends Form
{
    #[Validate('required|min:2|max:5000')]
    public string $body = '';

    public function setProperties(Reply $reply)
    {
        $this->body = $reply->body;
    }
}
