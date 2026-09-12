@extends('layouts.app')
@section('title', 'Backup')
@section('content')
<div class="table-card p-4" style="max-width: 640px;">
    <h6><i class="bi bi-hdd me-1"></i>Database Backup</h6>
    <p class="small text-muted">Download a full MySQL dump of the school database. Keep backups in a safe place.</p>
    <a href="{{ route('settings.backup.download') }}" class="btn btn-primary"><i class="bi bi-download me-1"></i>Download Backup (.sql)</a>
    <hr>
    <p class="small text-muted mb-0">Manual alternative on the server:<br>
    <code>mysqldump -u root -p school_mgt > backup.sql</code></p>
</div>
@endsection
