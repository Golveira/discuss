<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class ProfileShow extends Component
{
    use WithPagination, WireToast;

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
            ->with(['thread', 'author', 'parent.author'])
            ->latest()
            ->paginate();
    }

    public function updatedSelectedTab(): void
    {
        $this->resetPage();
    }

    public function ban()
    {
        $this->authorize('ban', $this->user);

        $this->user->ban();

        toast()->success('User has been banned!')->push();
    }

    public function unban()
    {
        $this->authorize('ban', $this->user);

        $this->user->unban();

        toast()->success('User has been unbanned!')->push();
    }

    public function render(): View
    {
        return view('livewire.pages.profile-show');
    }
}
