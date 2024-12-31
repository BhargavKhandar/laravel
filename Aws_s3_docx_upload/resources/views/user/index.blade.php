<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Index</title>
</head>

<body>
    <h1>User Index</h1>
    <a href="{{ route('user.create') }}">Create User</a>
    @if (session('success'))
        <div style="color: green" role="alert" id="msg">
            {{ session('success') }}
        </div>
    @endif
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {{-- show default document --}}
                        {{-- @if ($user->profile_img)
                            @php
                                // Extract the file extension to differentiate between images and PDFs
                                $fileExtension = pathinfo($user->profile_img, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                <!-- Display the image -->
                                <img src="{{ asset($user->profile_img) }}" alt="Profile Image"
                                    style="width: 50px; height: 50px; border-radius: 50%;">
                            @elseif ($fileExtension == 'pdf')
                                <!-- Display link to view/download the PDF -->
                                <a href="{{ asset($user->profile_img) }}" target="_blank">View PDF</a>
                            @endif
                        @else
                            <span>No Image or PDF</span>
                        @endif --}}

                        {{-- show Amazone Aws s3 document --}}
                        @if ($user->profile_img)
                            @php
                                // Extract the file extension to differentiate between images and PDFs
                                $fileExtension = pathinfo($user->profile_img, PATHINFO_EXTENSION);
                                // Generate the URL for the file stored in AWS S3
                                $fileUrl = Storage::disk('s3')->url($user->profile_img);
                            @endphp
                            @if (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                                <!-- Display the image -->
                                <img src="{{ $fileUrl }}" alt="Profile Image"
                                    style="width: 50px; height: 50px; border-radius: 50%;">
                            @elseif ($fileExtension == 'pdf')
                                <!-- Display link to view/download the PDF -->
                                <a href="{{ $fileUrl }}" target="_blank">View PDF</a>
                            @endif
                        @else
                            <span>No Image or PDF</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('user.edit', $user->id) }}">Edit</a> |
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                            onsubmit="return confirmDelete()">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

        <script>
            function confirmDelete() {
                return confirm('Are you sure you want to delete this record?');
            }

            // Display success message
            var msg = document.getElementById('msg');
            if (msg) {
                setTimeout(function() {
                    msg.style.display = 'none';
                }, 5000);
            }
        </script>
</body>

</html>
