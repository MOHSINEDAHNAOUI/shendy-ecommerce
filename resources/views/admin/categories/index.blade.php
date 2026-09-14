@extends('layouts.admin')

@section('title', 'Manage Categories | MarketHub')

@section('admin-content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h1 class="display-5 fw-800 mb-2">Categories</h1>
        <p class="text-muted">Manage your product classifications and groupings.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary px-4 py-2 fw-bold" style="border-radius: 12px;">
        <i class="bi bi-plus-lg me-1"></i> New Category
    </a>
</div>

<div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px;">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 border-0 text-uppercase fw-bold text-muted" style="font-size: 0.75rem;">ID</th>
                    <th class="py-3 border-0 text-uppercase fw-bold text-muted" style="font-size: 0.75rem;">Name</th>
                    <th class="py-3 border-0 text-uppercase fw-bold text-muted" style="font-size: 0.75rem;">Description</th>
                    <th class="py-3 border-0 text-uppercase fw-bold text-muted text-center" style="font-size: 0.75rem;">Products</th>
                    <th class="pe-4 py-3 border-0 text-uppercase fw-bold text-muted text-end" style="font-size: 0.75rem;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td class="ps-4">
                            <span class="badge bg-light text-dark border fw-bold">#{{ $category->id }}</span>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $category->name }}</div>
                        </td>
                        <td>
                            <div class="text-muted small text-truncate" style="max-width: 300px;">
                                {{ $category->description ?? 'No description provided' }}
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge rounded-pill bg-info text-white px-3">{{ $category->products->count() }}</span>
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-light border" title="Edit">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border" title="Delete" onclick="return confirm('Are you sure? This will delete all products in this category!')">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-5 text-center text-muted">
                            <i class="bi bi-folder2-open display-4 d-block mb-3 opacity-25"></i>
                            No categories found yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection