<?php

namespace App\Livewire;

use App\Models\Reply;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Usernotnull\Toast\Concerns\WireToast;

class ReplyEditor extends Component
{
    use  WireToast;

    public Reply $reply;

    public Collection $participantUsernames;

    public bool $open = false;

    public bool $isPreview = false;

    public string $action;

    #[Locked]
    public int $threadId;

    #[Validate('required|min:2|max:5000')]
    public string $body = '';

    #[Computed]
    public function bodyPreview(): string
    {
        return Str::markdown($this->body);
    }

    public function mount(Collection $participantUsernames): void
    {
        $this->participantUsernames = $participantUsernames ?? collect();
    }

    #[On('open-editor')]
    public function openEditor(string $action, ?int $replyId = null): void
    {
        $this->open = true;

        $this->action = $action;

        if ($replyId) {
            $this->reply = Reply::find($replyId);

            $this->body = $this->reply->body;
        }
    }

    public function closeEditor(): void
    {
        $this->open = false;

        $this->reset('body', 'isPreview');
    }

    public function getMentionableUsers(): array
    {
        return $this->participantUsernames->map(fn ($username) => [
            'key' => $username,
            'value' => $username,
        ])->toArray();
    }

    public function create(): void
    {
        $this->validate();

        Reply::create([
            'user_id' => Auth::id(),
            'thread_id' => $this->threadId,
            'body' => $this->body,
        ]);

        toast()->success('Reply created!')->push();

        $this->reset('body');

        $this->dispatch('reply-created');

        $this->open = false;
    }

    public function update(): void
    {
        $this->validate();

        $this->reply->update(['body' => $this->body]);

        toast()->success('Reply updated!')->push();

        $this->reset('body');

        $this->dispatch('reply-updated.' . $this->reply->id);

        $this->open = false;
    }

    public function render()
    {
        return view('livewire.reply-editor');
    }
}
