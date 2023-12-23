<?php

namespace App\Livewire;

use App\Models\Channel;
use Illuminate\Http\Request;
use Livewire\Component;

class ChannelFilter extends Component
{
    public string $channelPath = '';

    public function mount(Request $request)
    {
        $this->channelPath = "/" . $request->path();
    }

    public function updatedChannelPath($channelPath)
    {
        $this->redirect($channelPath, navigate: true);
    }

    public function render()
    {
        $channels = Channel::orderBy('name')->get();

        return view('livewire.channel-filter', compact('channels'));
    }
}
