<?php

namespace App\Livewire;

use App\Models\Reply;
use Livewire\Component;
use App\Models\Thread;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Usernotnull\Toast\Concerns\WireToast;

class ReplyComposer extends Component
{
    use WireToast;

    public Thread $thread;

    public ?Reply $parentReply = null;

    public bool $isOpen = false;

    #[Validate('required|min:2|max:5000')]
    public string $body = '';

    #[On('open-reply-creator')]
    public function open(?int $parentId = null): void
    {
        $this->fill([
            'isOpen' => true,
            'action' => 'create',
            'buttonText' => 'Reply',
        ]);

        if ($parentId) {
            $this->setParentReply($parentId);
        }
    }

    protected function setParentReply(int $parentId): void
    {
        $this->parentReply = Reply::findOrFail($parentId);

        $this->body = "@{$this->parentReply->author->username} ";
    }

    public function close(): void
    {
        $this->resetExcept(['thread']);

        $this->resetValidation();
    }

    public function create(): void
    {
        $this->validate();

        Reply::create([
            'user_id' => Auth::id(),
            'thread_id' => $this->thread->id,
            'parent_id' => $this->parentReply?->id,
            'body' => $this->body,
        ]);

        toast()->success('Reply created!')->push();

        if ($this->parentReply) {
            $this->dispatch('child-reply-created.' . $this->parentReply->id);
        } else {
            $this->dispatch('reply-created');
        }

        $this->close();
    }


    public function render(): View
    {
        return view('livewire.reply-composer');
    }
}
