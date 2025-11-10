<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // ✅ Show Add Category Form
    public function add_category()
    {
        return view('admin.addcategory');
    }

    // ✅ Store Category
    public function store_category(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;

        // ✅ Handle Image Upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/categories'), $imageName);
            $category->image = 'uploads/categories/' . $imageName;
        }
        // dd($category);
        $category->is_active = true;
        $category->save();

        return redirect()->route('category.list')->with('success', 'Category added successfully!');
    }

    // ✅ Show Category List
    public function category_list()
    {
        $categories = Category::latest()->get();
        return view('admin.categorylist', compact('categories'));
    }

    // ✅ Edit Category
    public function edit_category($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categoryedit', compact('category'));
    }

    // ✅ Update Category
    public function update_category(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/categories'), $imageName);
            $category->image = 'uploads/categories/' . $imageName;
        }

        $category->save();

        return redirect()->route('category.list')->with('success', 'Category updated successfully!');
    }

    // ✅ Delete Category
    public function delete_category($id)
    {
        $category = Category::findOrFail($id);

        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }

        $category->delete();

        return redirect()->route('category.list')->with('success', 'Category deleted successfully!');
    }
}
