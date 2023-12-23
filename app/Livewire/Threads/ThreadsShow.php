<?php

namespace App\Livewire\Threads;

use App\Models\Thread;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ThreadsShow extends Component
{
    public Thread $thread;

    public function mount(Thread $thread): void
    {
        $this->thread = $thread;
    }

    public function render(): View
    {
        return view('livewire.threads.threads-show');
    }
}
