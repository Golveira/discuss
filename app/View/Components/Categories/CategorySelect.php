<?php

namespace App\View\Components\Categories;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategorySelect extends Component
{
    public function render(): View|Closure|string
    {
        $categories = Category::orderBy('name')->get();

        return view('components.categories.category-select', compact('categories'));
    }
}
