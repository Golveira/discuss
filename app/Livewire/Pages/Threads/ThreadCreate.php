<?php

namespace App\Livewire\Pages\Threads;

use Livewire\Component;
use App\Livewire\Forms\ThreadForm;
use Illuminate\Support\Facades\Auth;
use Usernotnull\Toast\Concerns\WireToast;

class ThreadCreate extends Component
{
    use WireToast;

    public ThreadForm $form;

    public function save()
    {
        $this->form->validate();

        $thread = Auth::user()->threads()->create($this->form->all());

        $thread->subscribe(Auth::user());

        $thread->toggleLike(Auth::user());

        toast()->success('Thread created!')->pushOnNextPage();

        return $this->redirect(
            route('threads.show', $thread->id),
            navigate: true
        );
    }

    public function render()
    {
        return view('livewire.pages.threads.thread-create');
    }
}
