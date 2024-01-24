<?php

namespace App\View\Components\Users;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

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
