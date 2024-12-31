@extends('layout')

@section('title')
    {{ $data['title'] }}
@endsection

@section('content')
    <p>Hello,</p>
    <p>{{ $data['body'] }}</p>
    <a href="{{ route('showResetForm', ['token' => $data['token'], 'email' => $data['email']]) }}">Reset Password</a>
    <p>If you did not request a password reset, please ignore this email.</p>
@endsection