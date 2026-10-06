<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Models\Category;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    // Manage page (Step 3): every material with its current stock balance.
    public function index()
    {
        // withSum avoids an N+1 query: it totals inward_outwards.quantity per material in one query.
        $materials = Material::with('category')
            ->withSum('inwardOutwards', 'quantity')
            ->orderByDesc('id')
            ->get();

        return view('materials.index', compact('materials'));
    }

    // Step 1 form: add a new material under a category.
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('materials.create', compact('categories'));
    }

    public function store(StoreMaterialRequest $request)
    {
        Material::create($request->validated());

        return redirect()->route('materials.create')->with('success', 'Material saved successfully.');
    }

    // Edit only the material's basic details (category, name, opening balance) - not inward history.
    public function edit(Material $material)
    {
        $categories = Category::orderBy('name')->get();

        return view('materials.edit', compact('material', 'categories'));
    }

    public function update(UpdateMaterialRequest $request, Material $material)
    {
        $material->update($request->validated());

        return redirect()->route('materials.index')->with('success', 'Material updated successfully.');
    }

    // Soft delete: row is hidden from normal queries but kept in the database.
    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->route('materials.index')->with('success', 'Material deleted successfully.');
    }

    // AJAX endpoint used by the inward/outward form to populate the material dropdown
    // with only the materials that belong to the selected category.
    public function byCategory(Request $request)
    {
        $materials = Material::where('category_id', $request->query('category_id'))
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($materials);
    }
}
