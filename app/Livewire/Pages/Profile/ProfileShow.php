<?php

namespace App\Livewire\Pages\Profile;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProfileShow extends Component
{
    use WithPagination;

    public User $user;

    #[Url(as: 'tab', keep: true)]
    public string $selectedTab = 'threads';

    #[Computed]
    public function threads(): LengthAwarePaginator
    {
        return $this->user
            ->threads()
            ->latest()
            ->paginate();
    }

    #[Computed]
    public function replies(): LengthAwarePaginator
    {
        return $this->user
            ->replies()
            ->with('thread')
            ->latest()
            ->paginate();
    }

    public function updatedSelectedTab(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        return view('livewire.pages.profile.profile-show');
    }
}
