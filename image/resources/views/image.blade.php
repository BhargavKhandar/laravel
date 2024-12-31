<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Images</title>
</head>
<body>
    <h1>Prompt: {{ $prompt }}</h1>
    <div>
        <h3>Generated Image</h3>
        <img src="{{ $image1 }}" alt="Generated Image 1">
        <img src="{{ $image2 }}" alt="Generated Image 2">
    </div>

    <form action="{{ route('processForm') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3>Enter Prompt to Analyze the Image</h3>
        <input type="hidden" name="image" value="{{ $image1 }}">
        <img src="{{ $image1 }}" alt="Generated Image 1" ><br>
        <input type="text" name="prompt" placeholder="Enter your prompt">
        <button type="submit">Analyze Image</button>
    </form>

</body>
</html>

{{-- 
return redirect()->route('anaylyze-image', [
            'image' => $imageUrl,
            'prompt' => $prompt,
            'image1Analysis' => $image1Analysis,
        ]); --}}