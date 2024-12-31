@extends('layout')

@section('title')
    Update User Data
@endsection

@section('message')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection

@section('content')
    <form action="{{ route('user.update', $users->email) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <lable for="name" class="form-lable">User Name</lable>
            <input type="text" value="{{ $users->name }}" class="form-control @error('name') is-invalid @enderror" name="name">
            <span class="text-danger">
                @error('name')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mb-3">
            <lable for="email" class="form-lable">User Email</lable>
            <input type="email" value="{{ $users->email }}" class="form-control @error('email') is-invalid @enderror" name="email">
            <span class="text-danger">
                @error('email')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mb-3">
            <lable for="age" class="form-lable">User Age</lable>
            <input type="text" value="{{ $users->age }}" class="form-control @error('age') is-invalid @enderror" name="age">
            <span class="text-danger">
                @error('age')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mb-3">
            <lable for="city" class="form-lable">User City</lable>
            <input type="text" value="{{ $users->city }}" class="form-control @error('city') is-invalid @enderror" name="city">
            <span class="text-danger">
                @error('city')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mb-3">
            <a href="{{ route('user.index') }}" class="btn btn-danger">Back</a>
            <input type="submit" value="Update" class="btn btn-success">
        </div>
    </form>
@endsection