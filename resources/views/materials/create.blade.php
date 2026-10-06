@extends('layouts.app')

@section('title', 'Add Material')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-7">
            <div class="page-header justify-content-center align-items-center text-center flex-column">
                <div>
                    <h1><i class="bi bi-plus-circle"></i> Add Material</h1>
                    <p class="page-subtitle">Create a new material under a category with its opening balance.</p>
                </div>
            </div>

            <div class="card card-app">
                <div class="card-body">
                    <form action="{{ route('materials.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Category *</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">-- Select category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Material name *</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="e.g. Steel Rod 10mm" required>
                            <div class="form-text">Alpha-numeric value only.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Opening balance *</label>
                            <input type="number" step="0.01" min="0" name="opening_balance" value="{{ old('opening_balance') }}" class="form-control" required>
                            <div class="form-text">Floating point value, max 2 digits after the decimal point.</div>
                        </div>

                        <button type="submit" class="btn btn-app-primary text-white btn-icon">
                            <i class="bi bi-check-lg"></i> Save
                        </button>
                    </form>
                </div>
            </div>

            <p class="text-muted text-center mt-3">
                <i class="bi bi-info-circle"></i> Need a new category first?
                <a href="{{ route('categories.create') }}">Add one here</a>.
            </p>
        </div>
    </div>
@endsection
