@extends('layout')

@section('title')
    Login
@endsection

@section('message')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@endsection

{{-- {{ route('user.login') }} --}}
@section('content')
    <form action="{{ route('signin') }}" method="POST">
        @csrf

        <div class="mb-3">
            <lable for="email" class="form-lable">User Email</lable>
            <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email">
            <span class="text-danger">
                @error('email')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mb-3">
            <lable for="password" class="form-lable">User Password</lable>
            <input type="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" name="password">
            <span class="text-danger">
                @error('password')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mb-3">
            <a href="{{ route('forgetpassword') }}" class="text-primary">forget password?</a>
        </div>

        <div class="mb-3 float-end">
            <a href="{{ route('registers') }}" class="btn btn-primary">Sign Up</a>
            <input type="submit" value="Login" class="btn btn-success">
        </div>
    </form>
@endsection