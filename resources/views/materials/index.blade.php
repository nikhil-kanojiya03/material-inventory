@extends('layouts.app')

@section('title', 'Manage Materials')

@section('content')
    <div class="page-header">
        <div>
            <h1><i class="bi bi-clipboard-data"></i> Manage Materials</h1>
            <p class="page-subtitle">All materials with their opening and current stock balance.</p>
        </div>
        <a href="{{ route('materials.create') }}" class="btn btn-app-primary text-white btn-icon">
            <i class="bi bi-plus-lg"></i> Add Material
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="stat-tile">
                <div class="stat-icon stat-icon-indigo"><i class="bi bi-box-seam"></i></div>
                <div>
                    <div class="stat-value">{{ $materials->count() }}</div>
                    <div class="stat-label">Total materials</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="stat-tile">
                <div class="stat-icon stat-icon-green"><i class="bi bi-arrow-down-circle"></i></div>
                <div>
                    <div class="stat-value">{{ number_format($materials->sum('opening_balance'), 2) }}</div>
                    <div class="stat-label">Total opening balance</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="stat-tile">
                <div class="stat-icon stat-icon-amber"><i class="bi bi-stack"></i></div>
                <div>
                    <div class="stat-value">{{ number_format($materials->sum('current_balance'), 2) }}</div>
                    <div class="stat-label">Total current balance</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="stat-tile">
                <div class="stat-icon stat-icon-red"><i class="bi bi-exclamation-triangle"></i></div>
                <div>
                    <div class="stat-value">{{ $materials->where('current_balance', '<', 0)->count() }}</div>
                    <div class="stat-label">Negative balance</div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-app-wrap">
        <div class="table-responsive">
            <table class="table table-app align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Material</th>
                        <th class="text-end">Opening balance</th>
                        <th class="text-end">Current balance</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($materials as $material)
                        <tr>
                            <td class="text-muted">#{{ $material->id }}</td>
                            <td><span class="badge-category">{{ $material->category->name }}</span></td>
                            <td class="fw-semibold">{{ $material->name }}</td>
                            <td class="text-end">{{ number_format($material->opening_balance, 2) }}</td>
                            <td class="text-end {{ $material->current_balance < 0 ? 'balance-negative' : 'balance-positive' }}">
                                {{ number_format($material->current_balance, 2) }}
                            </td>
                            <td class="text-end">
                                <a href="{{ route('materials.edit', $material) }}" class="btn btn-sm btn-outline-secondary btn-icon">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('materials.destroy', $material) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this material?');">
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
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    No materials yet. <a href="{{ route('materials.create') }}">Add your first material</a>.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
