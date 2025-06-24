<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\category\StorePostRequest;
use App\Http\Requests\category\UpdateStorePostRequest;
use App\Models\Backend\Category;
use App\Models\Backend\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(){
        $subCategories=SubCategory::orderbydesc('id')->paginate(5);
        return view('backend.subcategory.index',compact('subCategories'));
    }
    public function create(){
        $categories = Category::orderByDesc('order')->where('status', 1)->get();
        return view('backend.subcategory.create', compact('categories'));
    }
    public function store(StorePostRequest $request){
        $subCategory = new SubCategory();
        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category;
        $subCategory->status = $request->status;
        $subCategory->order = $request->order;
        if($subCategory->save()){
            return redirect(route('sub-category'))->with('success','SubCategory added successfully');
        }
        return redirect()->back()->with('danger','SubCategory not added');
    }
    public function edit($id){
        $subCategory = SubCategory::find($id);
        $categories = Category::orderBy('order','asc')->where('status', 1)->get();
        return view('backend.subcategory.edit', compact('subCategory', 'categories'));
    
    
    }
    public function update(Request $request, $id){
        $subCategory = SubCategory::find($id);
        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category;
        $subCategory->status = $request->status;
        $subCategory->order = $request->order;
        if($subCategory->save()){
            return redirect(route('sub-category'))->with('success','SubCategory updated successfully');
        }
        return redirect()->back()->with('danger','SubCategory not updated');
    }
    public function destroy($id){
        $subCategory = SubCategory::destroy($id);
        if($subCategory){
            return redirect(route('sub-category'))->with('success','SubCategory deleted successfully');
        }
        return redirect()->back()->with('danger','SubCategory not deleted');
    }
}
