<?php

namespace App\View\Components\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Backend\Category;

class CategoryComposer
{
    public function compose(View $view)
    {
        $categories = Cache::remember('categories', 60 * 24, function () {
            return Category::with('subcategories')
                ->withCount('subcategories')
                ->orderbydesc('order')
                ->where('status', '1')
                ->get();
        });

        $view->with('categories', $categories);
    }
}
