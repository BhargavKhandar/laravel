@extends('layout')

@section('title')
    Register Data
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

{{-- {{ route('user.signup') }} --}}
@section('content')
    <form action="{{ route('signup') }}" method="POST">
        @csrf
        <div class="mb-3">
            <lable for="name" class="form-lable">User Name</lable>
            <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name">
            <span class="text-danger">
                @error('name')
                    {{ $message }}
                @enderror
            </span>
        </div>

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
            <lable for="password_confirmation" class="form-lable">User Confirm Password</lable>
            <input type="password" value="{{ old('password_confirmation') }}" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
            <span class="text-danger">
                @error('password_confirmation')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mb-3 float-end">
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <input type="submit" value="Signup" class="btn btn-success">
        </div>
    </form>
@endsection