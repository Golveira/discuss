<?php

namespace App\View\Components\Categories;

use Closure;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class CategoriesList extends Component
{
    public function render(): View|Closure|string
    {
        $categories = Cache::remember('categories-list', now()->addWeek(), function () {
            return Category::orderBy('name')->get();
        });

        return view('components.categories.categories-list', compact('categories'));
    }
}
