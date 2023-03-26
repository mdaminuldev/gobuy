<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $productlist = Product::latest()->get();
        return view('admin.allproduct', compact('productlist'));


    }

    public function addproduct()
    {
        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();

        return view('admin.addproduct', compact('categories', 'subcategories'));
    }

    public function storeproduct(Request $request)
    {

        $request->validate([
            'product_name' => 'required|unique:products',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
            'price' => 'required',
            'product_category_id' => 'required',
            'product_subcategory_id' => 'required',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required',
        ]);

        $image = $request->file('product_img');
        $image_nam = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'), $image_nam);
        $image_url = 'upload/' . $image_nam;

        $category_id = $request->product_category_id;
        $subcategory_id = $request->product_subcategory_id;

        $category_name = Category::where('id', $category_id)->value('category_name');
        $subcategory_name = Subcategory::where('id', $subcategory_id)->value('subcategory_name');

        Product::insert([
            'product_name' => $request->product_name,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'product_category_id' => $request->product_category_id,
            'product_category_name' => $category_name,
            'product_subcategory_id' => $request->product_subcategory_id,
            'product_subcategory_name' => $subcategory_name,
            'product_img' => $image_url,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace(' ', '-', $request->product_name)),

        ]);


        Category::where('id', $category_id)->increment('product_count', 1);
        Subcategory::where('id', $subcategory_id)->increment('product_count', 1);

        return redirect()->route('allproduct')->with('massage', 'Product Added Successfully');
    }

    public function EditProduct($id)
    {
        $product_info = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.editproduct', compact('product_info', 'categories', 'subcategories'));
    }

    public function UpdateProduct(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);

        $request->validate([
            'product_name' => 'required|unique:products',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
            'price' => 'required',
            'product_category_id' => 'required',
            'product_subcategory_id' => 'required',
            'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required',
        ]);

        if ($request->hasFile('product_img')) {
            $image = $request->file('product_img');
            $image_nam = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $request->product_img->move(public_path('upload'), $image_nam);
            $image_url = 'upload/' . $image_nam;

            dd($request->hasFile('product_img')); // Debugging line

            // ...
        } else {
            $image_url = $product->product_img; //Store the Previous Image URL
        }


        $category_id = $request->product_category_id;
        $subcategory_id = $request->product_subcategory_id;

        $category_name = Category::where('id', $category_id)->value('category_name');
        $subcategory_name = Subcategory::where('id', $subcategory_id)->value('subcategory_name');

        //Update The Product Info
        Product::findOrFail($product_id)->update([
            'product_name' => $request->product_name,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'product_category_id' => $request->product_category_id,
            'product_category_name' => $category_name,
            'product_subcategory_id' => $request->product_subcategory_id,
            'product_subcategory_name' => $subcategory_name,
            'product_img' => $image_url,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace(' ', '-', $request->product_name)),

        ]);

        // Decrement old category's product_count
        Category::where('id', $product->product_category_id)->decrement('product_count', 1);
        Subcategory::where('id', $product->product_subcategory_id)->decrement('product_count', 1);

        // Increment new category's product_count
        Category::where('id', $category_id)->increment('product_count', 1);
        Subcategory::where('id', $subcategory_id)->increment('product_count', 1);

        return redirect()->route('allproduct')->with('massage', 'Product Updated Successfully');
    }

    public function DeleteProduct($id)
    {


        Product::findOrFail($id)->delete();
        $cat_id = Product::where('id', $id)->value('product_category_id');
        $subcat_id = Product::where('id', $id)->value('product_subcategory_id');

        Category::where('id', $cat_id)->decrement('product_count', 1);
        Subcategory::where('id', $subcat_id)->decrement('product_count', 1);


        return redirect()->route('allproduct')->with('massage', 'Product Deleted Successfully');
    }
}