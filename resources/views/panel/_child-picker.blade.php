@if ($children->isNotEmpty())
<div class="table-card p-2 mb-3 d-flex align-items-center gap-2 flex-wrap">
    <span class="small text-muted ms-1">Child:</span>
    @foreach ($children as $c)
        <a href="{{ request()->url() }}?student={{ $c->id }}" class="btn btn-sm {{ $student && $student->id === $c->id ? 'btn-primary' : 'btn-outline-primary' }}">{{ $c->fullName() }}</a>
    @endforeach
</div>
@endif
