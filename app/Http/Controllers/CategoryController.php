<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('tickets')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        Category::create($validated);
        return redirect()->route('admin.categories')->with('success', 'Category created successfully');
    }

    public function show(Category $category)
    {
        $tickets = $category->tickets()->with('user')->paginate(10);
        return view('categories.show', compact('category', 'tickets'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($validated);
        return redirect()->route('admin.categories')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        if($category->tickets()->exists()) {
            return redirect()->route('admin.categories')->with('error', 'Cannot delete category that has tickets');
        }
        
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully');
    }
}
