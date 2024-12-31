<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Image Analysis Result</title>
</head>
<body>
    @if(isset($croppedImage))
        <img src="{{ $croppedImage }}" alt="Generated Image">
    @else
        <p>Sorry, no image could be generated based on the provided prompt.</p>
    @endif
</body>
</html>
