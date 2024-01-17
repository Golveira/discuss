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

class ThreadIndex extends Component
{
    use WithPagination;

    public Channel $channel;

    #[Url(as: 'q')]
    public string $query = '';

    #[Url(keep: true)]
    public string $sort = 'latest_activity';

    #[Url]
    public string $filter = 'all';

    public function mount(Channel $channel): void
    {
        $this->channel = $channel;
    }

    #[Computed]
    public function threads(): LengthAwarePaginator
    {
        return Thread::query()
            ->with(['author', 'channel', 'likes'])
            ->search($this->query)
            ->filter($this->filter)
            ->sort($this->sort)
            ->when($this->channel->exists, function ($query) {
                $query->whereBelongsTo($this->channel);
            })
            ->paginate();
    }

    public function search(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        return view('livewire.threads.thread-index');
    }
}
