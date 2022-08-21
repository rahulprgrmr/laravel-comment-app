@extends('layout')

@section('title')
    Customer Login
@endsection

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="card w-50 p-4">
            <h1 class="text-center">Customer Login</h1>
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
                <form method="post" action="{{ url('/login') }}">
                    @csrf
                    <div class="form-group mt-3">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group mt-3">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-lg btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
