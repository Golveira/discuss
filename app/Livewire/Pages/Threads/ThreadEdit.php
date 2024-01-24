<?php

namespace App\Livewire\Pages\Threads;

use App\Livewire\Forms\ThreadForm;
use App\Models\Thread;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

#[Title('Edit Discussion')]
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

        $this->redirect(
            route('threads.show', $this->thread->id),
            navigate: true
        );
    }

    public function render(): View
    {
        return view('livewire.pages.threads.thread-edit');
    }
}
