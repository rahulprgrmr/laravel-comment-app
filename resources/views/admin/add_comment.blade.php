@extends('layout')

@section('title')
    Add Comment
@endsection

@section('content')
    <h1 class="text-center mt-2"><a href="{{ url('/admin/comments') }}">Comment App</a></h1>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="card w-50 p-4">
            <h1 class="text-center">Add Comment</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mt-3">
                <form method="post" action="{{ url('admin/comments') }}">
                    @csrf
                    <div class="form-group mt-3">
                        <label class="form-label" for="body">Comment</label>
                        <textarea class="form-control" name="body" required></textarea>
                    </div>
                    <div class="form-group mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Create comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
