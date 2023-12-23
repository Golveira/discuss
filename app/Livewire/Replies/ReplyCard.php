<?php

namespace App\Livewire\Replies;

use App\Models\Reply;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class ReplyCard extends Component
{
    public Reply $reply;

    public function mount(Reply $reply): void
    {
        $this->reply = $reply;
    }

    public function render(): View
    {
        return view('livewire.replies.reply-card');
    }
}
