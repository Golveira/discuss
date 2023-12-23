<?php

namespace App\Livewire\Threads;

use App\Livewire\Forms\ThreadForm;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class ThreadCreate extends Component
{
    use WireToast;

    public ThreadForm $form;

    public function save()
    {
        $this->form->validate();

        $thread = Thread::create([
            'user_id' => Auth::id(),
            'channel_id' => $this->form->channel_id,
            'title' => $this->form->title,
            'body' => $this->form->body,
        ]);

        toast()->success('Thread created!')->pushOnNextPage();

        return $this->redirect(
            route('discuss.show', $thread->slug),
            navigate: true
        );
    }

    public function render()
    {
        return view('livewire.threads.thread-create');
    }
}
