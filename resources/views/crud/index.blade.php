@extends('layouts.app')
@section('title', $title)
@section('content')
<div class="table-card p-3">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h5 class="mb-0">{{ $title }}</h5>
        <div class="d-flex gap-2">
            <form method="GET" class="d-flex">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Search...">
                <button class="btn btn-sm btn-outline-primary ms-1"><i class="bi bi-search"></i></button>
            </form>
            @if (Route::has($route . '.create'))
                <a href="{{ route($route . '.create') }}" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg me-1"></i>Add New</a>
            @endif
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle small">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    @foreach ($fields as $f)
                        @if ($f['list'] ?? true)<th>{{ $f['label'] }}</th>@endif
                    @endforeach
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($items->currentPage() - 1) * $items->perPage() }}</td>
                        @foreach ($fields as $f)
                            @if ($f['list'] ?? true)
                                <td>
                                    @if (($f['type'] ?? '') === 'file' && $item->{$f['name']})
                                        @php $ext = strtolower(pathinfo($item->{$f['name']}, PATHINFO_EXTENSION)); @endphp
                                        @if (in_array($ext, ['jpg','jpeg','png']))
                                            <a href="{{ asset('storage/' . $item->{$f['name']}) }}" target="_blank"><img src="{{ asset('storage/' . $item->{$f['name']}) }}" width="42" height="42" class="rounded object-fit-cover" alt=""></a>
                                        @elseif (in_array($ext, ['mp4']))
                                            <a href="{{ asset('storage/' . $item->{$f['name']}) }}" target="_blank" class="badge bg-danger text-decoration-none"><i class="bi bi-camera-video"></i> Video</a>
                                        @elseif (in_array($ext, ['mp3']))
                                            <a href="{{ asset('storage/' . $item->{$f['name']}) }}" target="_blank" class="badge bg-warning text-dark text-decoration-none"><i class="bi bi-music-note"></i> Audio</a>
                                        @else
                                            <a href="{{ asset('storage/' . $item->{$f['name']}) }}" target="_blank" class="badge bg-secondary text-decoration-none"><i class="bi bi-file-earmark"></i> {{ strtoupper($ext) }}</a>
                                        @endif
                                    @elseif (($f['type'] ?? '') === 'checkbox')
                                        <span class="badge bg-{{ $item->{$f['name']} ? 'success' : 'secondary' }}">{{ $item->{$f['name']} ? 'Yes' : 'No' }}</span>
                                    @elseif (isset($f['relation']))
                                        {{ data_get($item, $f['relation'], '-') }}
                                    @else
                                        {{ \Illuminate\Support\Str::limit($item->{$f['name']}, 60) }}
                                    @endif
                                </td>
                            @endif
                        @endforeach
                        <td class="text-end text-nowrap">
                            @yield('row-actions')
                            @if (Route::has($route . '.edit'))
                                <a href="{{ route($route . '.edit', $item->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            @endif
                            @if (Route::has($route . '.destroy'))
                                <form method="POST" action="{{ route($route . '.destroy', $item->id) }}" class="d-inline" onsubmit="return confirm('Delete this record?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="20" class="text-center text-muted py-4">No records found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $items->links() }}
</div>
@endsection
