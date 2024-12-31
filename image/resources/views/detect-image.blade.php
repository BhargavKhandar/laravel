{{-- <!DOCTYPE html>
<html>
<head>
    <title>Object Detection</title>
</head>
<body>

<h2>Object Detection</h2>

<form method="post" action="" enctype="multipart/form-data">
    Enter your prompt:
    <textarea name="prompt" rows="4" cols="50"></textarea><br><br>
    Select image to upload:
    <input type="file" name="image" id="image">
    <input type="submit" value="Detect Objects" name="submit">
</form>

<?php

    // if(isset($_POST['submit']))
    // {
    //     $apikey = env('OPENAI_API_KEY');
    //     $prompt = $_POST['prompt'];
    //     $image = $_FILES['image']['tmp_name'];

    //     // Check if both prompt and image file are provided
    //     if ($prompt && $image)
    //     {
    //         $url = 'https://api.openai.com/v1/engines/davinci/completions';
    //         $data = array(
    //             'prompt' => $prompt,
    //             'max_tokens' => 50,
    //             'temperature' => 0.5,
    //             'top_p' => 1,
    //             'n' => 1,
    //             'stream' => false,
    //             'logprobs' => null,
    //             'stop' => '</textarea>'
    //         );

    //         $image_data = base64_encode(file_get_contents($image));
    //         $data['prompt'] .= "Image: $image_data";

    //         $ch = curl_init();
    //         curl_setopt($ch, CURLOPT_URL, $url);
    //         curl_setopt($ch, CURLOPT_POST, 1);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //             "Content-Type: application/json",
    //             "Authorization: Bearer $apikey"
    //         ));
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //         $response = curl_exec($ch);
    //         curl_close($ch);

    //         $result = json_decode($response, true);

    //         if (isset($result['choices'][0]['text']))
    //         {
    //             echo "<h3>Objects Detected:</h3>";
    //             echo "<ul>";
    //             $detected_objects = explode(',', $result['choices'][0]['text']);
    //             foreach ($detected_objects as $object) {
    //                 echo "<li>$object</li>";
    //             }
    //             echo "</ul>";
    //         }
    //         {
    //             echo "<p>No objects detected.</p>";
    //         }
    //     }
    //     {
    //         echo "<p>Please enter a prompt and select an image.</p>";
    //     }
    // }
?>

</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Object Detection</title>
</head>
<body>
    <h1>Object Detection</h1>

    <form action="{{ route('object') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="image">Upload Image:</label>
        <input type="file" name="image" accept="image/*" required>
        <input type="text" name="prompt">
        <button type="submit">Detect Objects</button>
    </form>

    @isset($description)
        <h2>Object Description:</h2>
        <p>{{ $description }}</p>
    @endisset

    @isset($error)
        <h2>Error:</h2>
        <p>{{ $error }}</p>
    @endisset
</body>
</html>
