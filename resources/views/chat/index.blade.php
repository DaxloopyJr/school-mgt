@extends('layouts.app')
@section('title', 'Chat Box')
@section('content')
<div class="row g-3">
    <div class="col-lg-4">
        @if ($pendingInvites->isNotEmpty())
            <div class="table-card p-3 mb-3">
                <h6 class="small text-uppercase text-muted">Chat Invitations</h6>
                @foreach ($pendingInvites as $inv)
                    <div class="d-flex justify-content-between align-items-center mb-2 small">
                        <span>{{ $inv->fromUser->name ?? '' }} <span class="badge bg-secondary">{{ $inv->fromUser->role ?? '' }}</span></span>
                        <form method="POST" action="{{ route('chat.invite.respond', $inv->id) }}" class="d-flex gap-1">@csrf
                            <button name="action" value="accept" class="btn btn-sm btn-success">Accept</button>
                            <button name="action" value="reject" class="btn btn-sm btn-outline-danger">Reject</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="table-card p-3">
            <h6 class="small text-uppercase text-muted">Contacts</h6>
            <div class="list-group list-group-flush">
                @forelse ($contacts as $c)
                    <a href="{{ route('chat.index', ['with' => $c->id]) }}" class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-2 {{ $active && $active->id === $c->id ? 'active' : '' }}">
                        <img src="{{ $c->avatarUrl() }}" class="rounded-circle" width="30" height="30" alt="">
                        <span class="small">{{ $c->name }} <span class="badge bg-light text-dark border">{{ $c->role }}</span></span>
                    </a>
                @empty
                    <div class="text-muted small py-2">No contacts available. Send an invitation first.</div>
                @endforelse
            </div>
            @if (auth()->user()->role !== 'admin')
                <hr>
                <form method="POST" action="{{ route('chat.invite') }}" class="d-flex gap-1">@csrf
                    <select name="user_id" class="form-select form-select-sm">
                        @foreach ($allUsers as $u)<option value="{{ $u->id }}">{{ $u->name }} ({{ $u->role }})</option>@endforeach
                    </select>
                    <button class="btn btn-sm btn-outline-primary">Invite</button>
                </form>
            @endif
            @if ($blockedUsers->isNotEmpty())
                <hr>
                <h6 class="small text-uppercase text-muted">Blocked Users</h6>
                @foreach ($blockedUsers as $b)
                    <div class="d-flex justify-content-between small mb-1">
                        <span>{{ $b->blockedUser->name ?? '' }}</span>
                        <form method="POST" action="{{ route('chat.unblock', $b->blocked_user_id) }}">@csrf
                            <button class="btn btn-sm btn-link p-0">Unblock</button></form>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-lg-8">
        @if ($active)
            <div class="table-card d-flex flex-column" style="height: 70vh;">
                <div class="p-2 border-bottom d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <img src="{{ $active->avatarUrl() }}" class="rounded-circle" width="34" height="34" alt="">
                        <strong>{{ $active->name }}</strong> <span class="badge bg-secondary">{{ $active->role }}</span>
                    </div>
                    <form method="POST" action="{{ route('chat.block') }}" onsubmit="return confirm('Block this user?')">@csrf
                        <input type="hidden" name="user_id" value="{{ $active->id }}">
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-slash-circle"></i></button>
                    </form>
                </div>
                <div class="flex-grow-1 overflow-auto p-3" id="chatBox" data-fetch="{{ route('chat.fetch', $active->id) }}" data-me="{{ auth()->id() }}"></div>
                <form method="POST" action="{{ route('chat.send') }}" enctype="multipart/form-data" class="p-2 border-top d-flex gap-2">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $active->id }}">
                    <input type="file" name="file" class="form-control form-control-sm" style="max-width: 180px;" title="Attachment (max 10MB)">
                    <input type="text" name="message" class="form-control form-control-sm" placeholder="Type a message..." autocomplete="off">
                    <button class="btn btn-sm btn-primary"><i class="bi bi-send"></i></button>
                </form>
            </div>
        @else
            <div class="table-card p-5 text-center text-muted">Select a contact to start chatting.</div>
        @endif
    </div>
</div>
@endsection
@if ($active)
@push('scripts')
<script>
(function () {
    const box = document.getElementById('chatBox');
    const url = box.dataset.fetch;
    const canPin = {{ in_array(auth()->user()->role, ['admin','teacher']) ? 'true' : 'false' }};
    function render(msgs) {
        let html = '';
        msgs.sort((a, b) => (b.pinned - a.pinned));
        msgs.forEach(m => {
            const align = m.mine ? 'text-end' : 'text-start';
            const bubble = m.mine ? 'bg-primary text-white' : 'bg-light border';
            let body = '';
            if (m.pinned) body += '<div class="small"><i class="bi bi-pin-angle-fill text-warning"></i> pinned</div>';
            if (m.message) body += '<div>' + $('<div>').text(m.message).html() + '</div>';
            if (m.file) body += '<div><a href="' + m.file + '" target="_blank" class="small">attachment</a></div>';
            body += '<div class="small opacity-75">' + m.time + (canPin ? ' <form method="POST" action="/chat/pin/' + m.id + '" class="d-inline"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button class="btn btn-link btn-sm p-0 text-warning"><i class="bi bi-pin-angle"></i></button></form>' : '') + '</div>';
            html += '<div class="' + align + ' mb-2"><div class="d-inline-block p-2 rounded ' + bubble + '" style="max-width:70%;">' + body + '</div></div>';
        });
        box.innerHTML = html || '<div class="text-muted text-center small mt-4">No messages yet. Say hello!</div>';
    }
    function poll() { $.getJSON(url, render); }
    poll();
    setInterval(poll, 4000);
})();
</script>
@endpush
@endif
