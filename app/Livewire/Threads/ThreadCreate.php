<?php

namespace App\Livewire\Threads;

use App\Livewire\Forms\ThreadForm;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class ThreadCreate extends Component
{
    use WireToast;

    public ThreadForm $form;

    #[Url(keep: true)]
    public string $category = 'general';

    #[Computed()]
    public function channel()
    {
        return Channel::whereSlug($this->category)->first();
    }

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
