@extends('layout')

@section('title')
    Verify your email address
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
    <form action="{{ route('verifyOtp') }}" method="POST">
        @csrf

        <div class="mb-3">
            <input type="hidden" value="{{ $email }}" class="form-control" name="email">
        </div>

        <div class="mb-3">
            <lable for="otp" class="form-lable">User OTP</lable>
            <input type="number" value="{{ old('otp') }}" class="form-control @error('otp') is-invalid @enderror" name="otp">
            <span class="text-danger">
                @error('otp')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mb-3 float-end">
            <input type="submit" value="Verify" class="btn btn-success">
        </div>
    </form>

    <form action="{{ route('resendOtp') }}" method="POST">
        @csrf
        <input type="hidden" value="{{ $email }}" class="form-control" name="email">

        <div id="timer">Resend OTP time :- </div>

        <input type="submit" value="Resend OTP" class="btn btn-primary">
    </form>

    <script>
        
        let timeLeft = 90;

        const timerId = setInterval(function()
        {
            const minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;

            seconds = seconds < 10 ? '0' + seconds : seconds;

            document.getElementById('timer').textContent = `${minutes}:${seconds}`;

            timeLeft--;
            if (timeLeft < 0) {
                clearInterval(timerId);
                document.getElementById('timer').textContent = "";
            }
        }, 1000);

    </script>
@endsection