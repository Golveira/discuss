<?php

namespace App\Livewire\Pages\Threads;

use App\Models\Category;
use App\Models\Thread;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ThreadIndex extends Component
{
    use WithPagination;

    public Category $category;

    #[Url(as: 'q')]
    public string $query = '';

    #[Url(keep: true)]
    public string $sort = 'latest_activity';

    #[Url]
    public string $filter = 'all';

    #[Computed]
    public function threads(): LengthAwarePaginator
    {
        return Thread::query()
            ->with(['author', 'category', 'likes'])
            ->search($this->query)
            ->filter($this->filter)
            ->sort($this->sort)
            ->when(isset($this->category), function ($query) {
                $query->whereBelongsTo($this->category);
            })
            ->paginate();
    }

    #[Computed()]
    public function pinnedThreads(): Collection
    {
        return Thread::pinned()
            ->with(['author', 'category'])
            ->limit(4)
            ->get();
    }

    public function search(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        return view('livewire.pages.threads.thread-index');
    }
}
