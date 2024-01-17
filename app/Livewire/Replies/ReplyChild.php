<?php

namespace App\Livewire\Replies;

use App\Models\Reply;
use Livewire\Component;

class ReplyChild extends Component
{
    public Reply $reply;

    public bool $isEditing = false;

    public function render()
    {
        return view('livewire.replies.reply-child');
    }
}
