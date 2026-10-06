<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInwardOutwardRequest;
use App\Models\Category;
use App\Models\InwardOutward;

class InwardOutwardController extends Controller
{
    // Step 2 form: record an inward/outward quantity movement for a material.
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('inward-outward.create', compact('categories'));
    }

    public function store(StoreInwardOutwardRequest $request)
    {
        $data = $request->validated();

        InwardOutward::create([
            'material_id' => $data['material_id'],
            'entry_date' => $data['entry_date'],
            'quantity' => $data['quantity'],
        ]);

        return redirect()->route('inward-outward.create')->with('success', 'Inward/outward quantity saved successfully.');
    }
}
