<?php

namespace App\Livewire\Threads;

use App\Livewire\Forms\ThreadForm;
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

        $thread = Auth::user()->threads()->create($this->form->all());

        $thread->subscribe(Auth::user());

        toast()->success('Thread created!')->pushOnNextPage();

        return $this->redirect(route('threads.show', $thread->slug), navigate: true);
    }

    public function render()
    {
        return view('livewire.threads.thread-create');
    }
}
