<?php

namespace App\Livewire\Threads;

use App\Models\Thread;
use Livewire\Component;
use App\Livewire\Forms\ThreadForm;
use Usernotnull\Toast\Concerns\WireToast;

class ThreadEdit extends Component
{
    use WireToast;

    public Thread $thread;

    public ThreadForm $form;

    public function mount(Thread $thread)
    {
        $this->authorize('update', $thread);

        $this->thread = $thread;

        $this->form->setProperties($thread);
    }

    public function save()
    {
        $this->form->validate();

        $this->thread->update($this->form->all());

        toast()->success('Thread Updated!')->pushOnNextPage();

        return $this->redirect(
            route('threads.show', $this->thread->slug),
            navigate: true
        );
    }

    public function render()
    {
        return view('livewire.threads.thread-edit');
    }
}
