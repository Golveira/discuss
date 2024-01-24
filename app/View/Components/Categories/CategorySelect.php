<?php

namespace App\View\Components\Categories;

use Closure;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class CategorySelect extends Component
{
    public function render(): View|Closure|string
    {
        $categories = Cache::remember('category-select', now()->addWeek(), function () {
            return Category::orderBy('name')->get();
        });

        return view('components.categories.category-select', compact('categories'));
    }
}
