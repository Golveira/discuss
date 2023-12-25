<?php

namespace App\Livewire\Replies;

use App\Livewire\Forms\ReplyForm;
use App\Models\Reply;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ReplyCard extends Component
{
    public Reply $reply;

    public ReplyForm $form;

    public bool $isAuthoredByUser;

    public bool $isEditing = false;

    public function mount(Reply $reply): void
    {
        $this->reply = $reply;

        $this->form->setProperties($reply);

        $this->isAuthoredByUser = $reply->isAuthoredBy(Auth::user());
    }

    public function update(): void
    {
        $this->authorize('update', $this->reply);

        $this->form->validate();

        $this->reply->update($this->form->all());

        $this->isEditing = false;
    }

    public function render(): View
    {
        return view('livewire.replies.reply-card');
    }
}
