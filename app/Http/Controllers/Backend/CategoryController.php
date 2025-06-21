<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Backend\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::orderbydesc('id')->paginate(5);
        return view('backend.category.index',compact('categories'));
    }

    public function create(){
        return view('backend.category.create');
    }

    public function store(Request $request){

        $category = new Category();
        $category->name = request('name');
        $category->status = request('status');
        $category->order = request('order');
        if($category->save()){
            return redirect(route('category'))->with('success','Category added successfully');
        }
        return redirect()->back()->with('danger','Category not added');

        //
    }


}
