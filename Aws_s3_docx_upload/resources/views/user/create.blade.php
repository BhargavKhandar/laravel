<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create user</title>
</head>

<body>
    <h1>Create User</h1>
    <a href="{{ route('user.index') }}">User List</a>
    @if ($errors->any())
        <div style="color: red;" id="msg">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" required>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <input type="file" name="profile_img" accept=".jpg, .jpeg, .png, .pdf">
        <input type="submit" value="Create User">
    </form>

    <script>
        var msg = document.getElementById('msg');
        if (msg) {
            setTimeout(function() {
                msg.style.display = 'none';
            }, 5000);
        }
    </script>
</body>

</html>
