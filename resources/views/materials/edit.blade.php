@extends('layouts.app')

@section('title', 'Edit Material')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-7">
            <div class="page-header justify-content-center align-items-center text-center flex-column">
                <div>
                    <h1><i class="bi bi-pencil-square"></i> Edit Material</h1>
                    <p class="page-subtitle">Only basic details can be changed here. Inward/outward history is not affected.</p>
                </div>
            </div>

            <div class="card card-app">
                <div class="card-body">
                    <form action="{{ route('materials.update', $material) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Category *</label>
                            <select name="category_id" class="form-select" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $material->category_id) == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Material name *</label>
                            <input type="text" name="name" value="{{ old('name', $material->name) }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Opening balance *</label>
                            <input type="number" step="0.01" min="0" name="opening_balance" value="{{ old('opening_balance', $material->opening_balance) }}" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-app-primary text-white btn-icon">
                            <i class="bi bi-check-lg"></i> Update
                        </button>
                        <a href="{{ route('materials.index') }}" class="btn btn-link">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
