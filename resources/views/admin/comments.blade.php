@extends('layout')

@section('title')
    Comments
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <h4>Hi {{ auth()->user()->name }}</h4>
        <div class="btn-group">
            <a href="{{ url('/admin/comments/add') }}" class="btn btn-primary">Add Comment</a>
            <a href="{{ url('/logout') }}" class="btn btn-primary">Logout</a>
        </div>
    </div>
    <h1 class="text-center">Comments</h1>
    @if(session()->has('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif
    <div>
        @foreach($comments as $comment)
            <div class="card p-2 m-2">
                <li>{{ $comment->body }}</li>
            </div>
        @endforeach
    </div>
</div>
@endsection
