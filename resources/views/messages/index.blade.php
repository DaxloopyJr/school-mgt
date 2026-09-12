@extends('layouts.app')
@section('title', 'Messages')
@section('content')
<div class="row g-3">
    <div class="col-lg-4">
        <div class="table-card p-3">
            <h6><i class="bi bi-pencil-square me-1"></i>Compose</h6>
            <form method="POST" action="{{ route('messages.store') }}">@csrf
                <div class="mb-2"><label class="form-label small">To</label>
                    <select name="receiver_id" class="form-select form-select-sm" required>
                        @foreach ($users as $id => $name)<option value="{{ $id }}">{{ $name }}</option>@endforeach
                    </select></div>
                <div class="mb-2"><label class="form-label small">Subject</label>
                    <input type="text" name="subject" class="form-control form-control-sm" required></div>
                <div class="mb-2"><label class="form-label small">Message</label>
                    <textarea name="message" rows="4" class="form-control form-control-sm" required></textarea></div>
                <button class="btn btn-sm btn-primary w-100"><i class="bi bi-send me-1"></i>Send Message</button>
            </form>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="table-card p-3 mb-3">
            <h6><i class="bi bi-inbox me-1"></i>Inbox</h6>
            <div class="list-group list-group-flush small">
                @forelse ($inbox as $m)
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $m->subject }}</strong>
                            <span class="text-muted">{{ $m->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="text-muted">From: {{ $m->sender->name ?? '-' }}</div>
                        <div>{{ $m->message }}</div>
                    </div>
                @empty
                    <div class="list-group-item text-muted">Inbox is empty.</div>
                @endforelse
            </div>
            {{ $inbox->links() }}
        </div>
        <div class="table-card p-3">
            <h6><i class="bi bi-send me-1"></i>Sent</h6>
            <div class="list-group list-group-flush small">
                @forelse ($sent as $m)
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between"><strong>{{ $m->subject }}</strong>
                            <span class="text-muted">{{ $m->created_at->format('d M Y H:i') }}</span></div>
                        <div class="text-muted">To: {{ $m->receiver->name ?? '-' }}</div>
                    </div>
                @empty
                    <div class="list-group-item text-muted">No sent messages.</div>
                @endforelse
            </div>
            {{ $sent->links() }}
        </div>
    </div>
</div>
@endsection
