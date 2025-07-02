<?php
namespace App\View\Components\Composers;

use Illuminate\View\View;
use App\Models\Backend\Category;

class CategoryComposer
{
    public function compose(View $view)
    {
        $categories = Category::with('subcategories')->withCount('subcategories')->orderbydesc('order')->where('status', '1')->get();
        $view->with('categories', $categories);
    }
}
