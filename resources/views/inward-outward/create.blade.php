@extends('layouts.app')

@section('title', 'Inward / Outward Entry')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-7">
            <div class="page-header justify-content-center align-items-center text-center flex-column">
                <div>
                    <h1><i class="bi bi-arrow-left-right"></i> Inward / Outward Quantity Entry</h1>
                    <p class="page-subtitle">Record a stock movement for a material. Use a negative quantity for outward.</p>
                </div>
            </div>

            <div class="card card-app">
                <div class="card-body">
                    <form action="{{ route('inward-outward.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Material category *</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <option value="">-- Select category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Material name *</label>
                            <select name="material_id" id="material_id" class="form-select" required>
                                <option value="">-- Select category first --</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date *</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                                <input type="date" name="entry_date" value="{{ old('entry_date', date('Y-m-d')) }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Inward / outward quantity *</label>
                            <input type="number" step="0.01" name="quantity" value="{{ old('quantity') }}" class="form-control"
                                   placeholder="e.g. 10 for inward, -5 for outward" required>
                            <div class="form-text">Use a positive number for inward, negative for outward.</div>
                        </div>

                        <button type="submit" class="btn btn-app-primary text-white btn-icon">
                            <i class="bi bi-check-lg"></i> Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // When a category is selected, fetch its materials via AJAX and
        // repopulate the material dropdown with only those options.
        const categorySelect = document.getElementById('category_id');
        const materialSelect = document.getElementById('material_id');
        const oldMaterialId = '{{ old('material_id') }}';

        categorySelect.addEventListener('change', function () {
            const categoryId = this.value;

            if (!categoryId) {
                materialSelect.innerHTML = '<option value="">-- Select category first --</option>';
                return;
            }

            materialSelect.innerHTML = '<option value="">Loading...</option>';

            fetch(`{{ route('materials.by-category') }}?category_id=${categoryId}`)
                .then(response => response.json())
                .then(materials => {
                    if (materials.length === 0) {
                        materialSelect.innerHTML = '<option value="">-- No materials in this category --</option>';
                        return;
                    }

                    let options = '<option value="">-- Select material --</option>';
                    materials.forEach(material => {
                        const selected = String(material.id) === oldMaterialId ? 'selected' : '';
                        options += `<option value="${material.id}" ${selected}>${material.name}</option>`;
                    });
                    materialSelect.innerHTML = options;
                });
        });

        // Re-trigger the category change on page load if validation failed and old input exists.
        if (categorySelect.value) {
            categorySelect.dispatchEvent(new Event('change'));
        }
    </script>
@endsection
