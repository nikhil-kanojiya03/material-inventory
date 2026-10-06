@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
            <div class="page-header justify-content-center align-items-center text-center flex-column">
                <div>
                    <h1><i class="bi bi-plus-circle"></i> Add Category</h1>
                </div>
            </div>

            <div class="card card-app">
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Category name *</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required autofocus>
                        </div>
                        <button type="submit" class="btn btn-app-primary text-white btn-icon">
                            <i class="bi bi-check-lg"></i> Save
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-link">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
