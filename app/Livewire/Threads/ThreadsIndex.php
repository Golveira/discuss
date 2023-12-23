<?php

namespace App\Livewire\Threads;

use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Pagination\LengthAwarePaginator;

class ThreadsIndex extends Component
{
    use WithPagination;

    public Channel $channel;

    #[Url(as: 'q')]
    public string $query = '';

    #[Url]
    public string $filter = 'recent';

    #[Computed]
    public function threads(): LengthAwarePaginator
    {
        return Thread::query()
            ->search($this->query)
            ->filter($this->filter)
            ->when($this->channel->exists, function ($query) {
                $query->whereBelongsTo($this->channel);
            })
            ->paginate();
    }

    public function mount(Channel $channel): void
    {
        $this->channel = $channel;
    }

    public function updatedFilter(): void
    {
        $this->resetPage();
    }

    public function search(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        return view('livewire.threads.threads-index');
    }
}
