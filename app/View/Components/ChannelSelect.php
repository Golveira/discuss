<?php

namespace App\View\Components;

use App\Models\Channel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ChannelSelect extends Component
{
    public Collection $channels;

    public function __construct()
    {
        $this->channels = Channel::orderBy('name')->get();
    }

    public function render(): View|Closure|string
    {
        return view('components.channel-select');
    }
}
