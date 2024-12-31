<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if(isset($imagePath))
        <form action="{{ route('anlyz-img') }}" method="post" enctype="multipart/form-data">
            @csrf
            <img src="{{ asset('storage/images/' . $imagePath) }}" alt="Uploaded Image" width="500" height="500"><br>
            <input type="hidden" name="image" value="{{ asset('storage/images/' . $imagePath) }}">
            @error('image')
                {{ $message }}
            @enderror
            {{-- <input type="hidden" name="image" value="{{ $imagePath }}"> --}}
            <input type="text" name="prompt" placeholder="Enter prompt">
            @error('prompt')
                {{ $message }}
            @enderror
            <button type="submit">Analyze Image</button>
        </form>
    @else
        <p>No image available.</p>
    @endif
</body>
</html>
