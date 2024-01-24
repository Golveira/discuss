<?php

namespace App\Livewire\Forms;

use App\Models\Reply;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ReplyForm extends Form
{
    #[Validate('required|min:1|max:5000')]
    public string $body = '';

    public function setProperties(Reply $reply)
    {
        $this->body = $reply->body;
    }
}
