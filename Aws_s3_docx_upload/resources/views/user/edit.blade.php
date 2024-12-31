<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Edit</title>
</head>

<body>
    <h1>Edit User</h1>
    <a href="{{ route('user.index') }}">User List</a>
    @if ($errors->any())
        <div style="color: red;" id="msg">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Use PUT for updating resources -->

        <!-- User Name Field -->
        <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Name" required>

        <!-- User Email Field -->
        <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" required>

        <!-- Display Current Profile Image or PDF -->
        @if ($user->profile_img)
            <div>
                @if (in_array(pathinfo($user->profile_img, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                    <img src="{{ asset($user->profile_img) }}" alt="Profile Image"
                        style="width: 50px; height: 50px; border-radius: 50%;">
                @elseif (pathinfo($user->profile_img, PATHINFO_EXTENSION) === 'pdf')
                    <a href="{{ asset($user->profile_img) }}" target="_blank">View PDF</a>
                @endif
            </div>
        @else
            <span>No Image or PDF</span>
        @endif

        <!-- File Upload Field for Images or PDFs -->
        <div>
            <label for="profile_img">Change Profile Image or PDF:</label>
            <input type="file" name="profile_img" accept=".jpg, .jpeg, .png, .pdf">
        </div>

        <!-- Submit Button -->
        <input type="submit" value="Update User">
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
