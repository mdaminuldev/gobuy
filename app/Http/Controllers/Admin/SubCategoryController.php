<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::latest()->get();
        return view('admin.allsubcategory', compact('subcategories'));
    }

    public function addsubcategory()
    {
        $categories = Category::latest()->get();
        return view('admin.addsubcategory', compact('categories'));
    }

    public function StoreSubCategory(Request $request)
    {

        $request->validate([
            'subcategory_name' => 'required|unique:subcategories',
            'category_id' => 'required',
        ]);

        $category_id = $request->category_id;

        $category_name = Category::where('id', $category_id)->value('category_name');

        Subcategory::insert([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
            'category_id' => $category_id,
            'category_name' => $category_name
        ]);

        Category::where('id', $category_id)->increment('subcategory_count', 1);
        return redirect()->route('allsubcategory')->with('massage', 'Subcategory Added Successfully');
    }

    public function EditSubCategory($id)
    {

        $subcategory_info = Subcategory::findOrFail($id);
        return view('admin.editsubcategory', compact('subcategory_info'));

    }

    public function UpdateSubCat(Request $request){
        $subcat_id = $request->subcat_id;

        $request->validate([
            'subcategory_name' => 'required|unique:subcategories'
        ]);

        Subcategory::findOrFail($subcat_id)->update([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ', '-', $request->subcategory_name))
        ]);

        return redirect()->route('allsubcategory')->with('massage', 'Subcategory Updated Successfully');
    }

    public function DeleteSubCat($id){

        $cate_id=Subcategory::where('id', $id)->value('category_id');
        Subcategory::findOrFail($id)->delete();

        Category::where('id', $cate_id)->decrement('subcategory_count', 1);

        return redirect()->route('allsubcategory')->with('massage', 'Subcategory Deleted Successfully');
    }
}
