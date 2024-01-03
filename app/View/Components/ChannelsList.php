<?php

namespace App\View\Components;

use Closure;
use App\Models\Channel;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class ChannelsList extends Component
{
    public function render(): View|Closure|string
    {
        $channels = Cache::remember('channels-list', now()->addWeek(), function () {
            return Channel::orderBy('name')->get();
        });

        return view('components.channels-list', compact('channels'));
    }
}
