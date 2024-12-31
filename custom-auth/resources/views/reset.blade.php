@extends('layout')

@section('title')
    Forget Password
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

@section('content')
    <form action="{{ route('update') }}" method="POST">
        @csrf
        <h3 class="text-center">Set new Password</h3>

        <input type="hidden" name="token" value="{{ request()->token }}">
        <input type="hidden" name="email" value="{{ request()->email }}">

        <div class="mb-3">
            <lable for="password" class="form-lable">New  Password</lable>
            <input type="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" name="password">
            <span class="text-danger">
                @error('password')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mb-3">
            <lable for="password_confirmation" class="form-lable">Confirm Password</lable>
            <input type="password" value="{{ old('password_confirmation') }}" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
            <span class="text-danger">
                @error('password_confirmation')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mb-3 float-end">
            <input type="submit" value="Reset Password" class="btn btn-success">
        </div>
    </form>
@endsection