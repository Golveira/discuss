<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikeButton extends Component
{
    public Model $likeable;

    public bool $isLiked;

    public function mount(Model $likeable): void
    {
        $this->likeable = $likeable;

        $this->isLiked = $likeable->isLikedBy(Auth::user());
    }

    public function toggleLike(): void
    {
        $this->likeable->toggleLike(Auth::user());

        $this->isLiked = !$this->isLiked;

        $this->likeable->loadCount('likes');
    }

    public function render(): View
    {
        return view('livewire.like-button');
    }
}
