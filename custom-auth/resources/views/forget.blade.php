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
    <form action="{{ route('email') }}" method="POST">
        @csrf
        <h3 class="text-center">Send Password reset link</h3>
        <div class="mb-3">
            <lable for="email" class="form-lable">User Email</lable>
            <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email">
            <span class="text-danger">
                @error('email')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mb-3 float-end">
            <input type="submit" value="Send" class="btn btn-success">
        </div>
    </form>

@endsection