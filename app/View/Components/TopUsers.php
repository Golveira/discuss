<?php

namespace App\View\Components;

use Closure;
use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class TopUsers extends Component
{
    public function render(): View|Closure|string
    {
        $users = Cache::remember('top-users', now()->addWeek(), function () {
            return User::byMostSolutions()->limit(10)->get();
        });

        return view('components.top-users', compact('users'));
    }
}
