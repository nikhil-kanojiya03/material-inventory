@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div class="page-header">
        <div>
            <h1><i class="bi bi-tags"></i> Categories</h1>
            <p class="page-subtitle">Master list of material categories.</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-app-primary text-white btn-icon">
            <i class="bi bi-plus-lg"></i> Add Category
        </a>
    </div>

    <div class="table-app-wrap">
        <div class="table-responsive">
            <table class="table table-app align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td class="text-muted">#{{ $category->id }}</td>
                            <td class="fw-semibold">{{ $category->name }}</td>
                            <td class="text-end">
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-secondary btn-icon">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger btn-icon">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                <div class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    No categories yet.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
