<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Backend\Upload;
use App\Models\Backend\Product;
use App\Models\Backend\Category;
use Illuminate\Support\Facades\DB;
use App\Models\Backend\SubCategory;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::orderbydesc('id')->paginate(5);
        return view('backend.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderbydesc('id')->where('status', '1')->get();
        return view('backend.product.create', compact('categories'));
    }

    public function store(Request $request)
    {


        DB::beginTransaction();

        try {
            $row = new Product();
            $row->name = $request->name;
            $row->short_description = $request->short_description;
            $row->description = $request->description;
            $row->product_details = $request->product_details;
            $row->quantity = $request->quantity;
            $row->price = $request->price;
            $row->discount = $request->discount;
            $row->delivery_policy = $request->delivery_policy;
            $row->return_policy = $request->return_policy;
            $row->category_id = $request->category_id;
            $row->sub_category_id = $request->sub_category_id;

            $row->status = $request->status;
            $row->order = $request->order;
            $row->save();

            $images = $request->file('image');
            $arr = [];

            if ($request->hasFile('image')) {
                foreach ($images as $item) {
                    $var = date_create();
                    $time = date_format($var, 'YmdHis');
                    $imageName = $time . '-' . $item->getClientOriginalName();
                    $item->move(public_path() . '/uploads/file/', $imageName);
                    $arr[] = $imageName;

                    $upload = new Upload();


                    $upload->file_path = '/uploads/file/' . $imageName;
                    $upload->product_id = $row->id; // Associate with the product
                    // $upload->type = 'product'; // Specify the type if needed
                    $upload->save();
                }
            }


            $category = new Category();
            $category->name = request('name');
            $category->status = request('status');
            $category->order = request('order');

            DB::commit();

            return redirect(route('product'))->with('success', 'product added successfully');
        } catch (\Exception $e) {


            DB::rollback();

            return redirect()->back()->with('danger', 'product not added');
        }


        //
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $subcategories = SubCategory::orderbydesc('id')->where('status', '1')->get();

        return view('backend.product.edit', compact('product', 'categories', 'subcategories'));
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
