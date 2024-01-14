<?php

namespace App\Livewire\Threads;

use App\Models\Thread;
use Livewire\Component;
use App\Livewire\Forms\ThreadForm;
use Illuminate\Contracts\View\View;
use Usernotnull\Toast\Concerns\WireToast;

class ThreadEdit extends Component
{
    use WireToast;

    public Thread $thread;

    public ThreadForm $form;

    public function mount(Thread $thread): void
    {
        $this->authorize('update', $thread);

        $this->thread = $thread;

        $this->form->setProperties($thread);
    }

    public function save(): void
    {
        $this->form->validate();

        $this->thread->update($this->form->all());

        toast()->success('Thread Updated!')->pushOnNextPage();

        $this->redirect(route('threads.show', $this->thread->slug), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.threads.thread-edit');
    }
}
