<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get(); // get data from database
        return view('admin.allcategory', compact('categories'));
    }

    public function addcategory()
    {
        return view('admin.addcategory');
    }

    public function StoreCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories',

        ]);
        Category::insert([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ', '-', $request->category_name))
        ]);
        return redirect()->route('allcategory')->with('massage', 'Category Added Successfully');
    }

    public function editcategory($id)
    {
        $category_info = Category::findOrFail($id);
        return view('admin.editcategory', compact('category_info'));
    }

    public function UpdateCategory(Request $request)
    {
        $category_id = $request->category_id;

        $request->validate([
            'category_name' => 'required|unique:categories',

        ]);

        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ', '-', $request->category_name))
        ]);

        return redirect()->route('allcategory')->with('massage', 'Category Updated Successfully');
    }

    public function DeleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('allcategory')->with('massage', 'Category Deleted Successfully');

    }
}