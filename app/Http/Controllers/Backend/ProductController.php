<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Backend\Product;
use App\Models\Backend\Category;
use App\Models\Backend\SubCategory;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {

        $products= Product::orderbydesc('id')->paginate(5);
        return view('backend.product.index', compact('products'));
    }

    public function create()
    {       $categories = Category::orderbydesc('id')->where('status', '1')->get();
        return view('backend.product.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $category = new Category();
        $category->name = request('name');
        $category->status = request('status');
        $category->order = request('order');
        if ($category->save()) {
            return redirect(route('product'))->with('success', 'product added successfully');
        }
        return redirect()->back()->with('danger', 'product not added');

        //
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('backend.product.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->status = $request->status;
        $category->order = $request->order;
        if ($category->save()) {
            return redirect(route('category'))->with('success', 'Category updated successfully');
        }
        return redirect()->back()->with('danger', 'Category not updated');
    }

    public function destroy($id)
    {
        $category = Category::destroy($id);
        if ($category) {
            return redirect(route('product'))->with('success', 'product deleted successfully');
        }
        return redirect()->back()->with('danger', 'product not deleted');
    }

    public function getSubCategory(Request $request)
    {
        $subcategories = SubCategory::where('category_id', $request->category_id)->get();
        return response()->json(['subcategories' => $subcategories]);
    }
}
