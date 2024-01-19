<?php

namespace App\View\Components\Users;

use Closure;
use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class MostHelpfulUsers extends Component
{
    public function render(): View|Closure|string
    {
        $users = Cache::remember('most-helpful-users', now()->addMonth(), function () {
            return User::orderByMostSolutions()->limit(10)->get();
        });

        return view('components.users.most-helpful-users', compact('users'));
    }
}
