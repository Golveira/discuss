<?php

namespace App\Livewire\Replies;

use App\Models\Reply;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ReplyCard extends Component
{
    public Reply $reply;

    public bool $isAuthoredByUser;

    public function mount(Reply $reply): void
    {
        $this->reply = $reply;

        $this->isAuthoredByUser = $reply->isAuthoredBy(Auth::user());
    }

    public function render(): View
    {
        return view('livewire.replies.reply-card');
    }
}
