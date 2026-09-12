@extends('layouts.front')
@section('title', $page->title)
@section('content')
<div class="container mt-4" style="max-width: 820px;">
    <h4>{{ $page->title }}</h4>
    <div>{!! nl2br(e($page->content)) !!}</div>
</div>
@endsection
