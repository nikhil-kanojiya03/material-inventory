<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    // Display: list all categories, newest first.
    public function index()
    {
        $categories = Category::orderByDesc('id')->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    // Add: create a new category master record.
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Update: rename an existing category.
    public function update(StoreCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete: only allowed when no material is using this category, to protect existing data.
    public function destroy(Category $category)
    {
        if ($category->materials()->exists()) {
            return redirect()->route('categories.index')
                ->with('error', 'Cannot delete a category that has materials assigned to it.');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
