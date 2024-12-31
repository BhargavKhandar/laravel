@extends('layout')

@section('title')
    {{ $data['title'] }}
@endsection

@section('content')
    <p>
        {{ $data['body'] }}
        <h2>
            {{ $data['otp'] }}
        </h3>
        {{ $data['secure'] }}
    </p>
    <br>
    <p>
        Thank You
    </p>
@endsection