<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Http;

// use OpenAI\Api\OpenAI;

// use Orhanerday\OpenAi\OpenAi;

class ImageController extends Controller
{
    // show image form
    public function showForm()
    {
        return view('image-generator');
    }

    // generate image
    public function generate(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:100',
            'size' => Rule::in(['sm', 'md', 'lg']),
        ]);

        $prompt = $request->prompt;

        switch ($request->size) {
            case 'lg':
                $size = '1024x1024';
                break;

            case 'md':
                $size = '512x512';
                break;

            default:
                $size = '256x256';
        }

        $complete = OpenAI::images()->create([
            'prompt' => $prompt,
            'n' => 2,
            'size' => $size,
            'response_format' => 'url',
        ]);

        // dd($complete);

        // $complete = strval($complete);
        // $var = json_decode($complete, true);
        $image1 = $complete['data'][0]['url'];
        $image2 = $complete['data'][1]['url'];
        return redirect()->route('image', compact('image1', 'image2', 'prompt'));
        // return redirect()->route('image')->with(['image1' => $image1, 'image2' => $image2, 'prompt' => $prompt]);
    }

    // first method to show generated image
    public function show(Request $request)
    {
        $image1 = $request->image1;
        $image2 = $request->image2;
        $prompt = $request->prompt;

        return view('image', compact('image1', 'image2', 'prompt'));
    }

    // second method to show generated image
    // the second method is the page will refresh and the is does not show in view file
    // public function show(Request $request)
    // {
    //     $image1 = session('image1');
    //     $image2 = session('image2');
    //     $prompt = session('prompt');

    //     return view('image', compact('image1', 'image2', 'prompt'));
    // }

    // add image form
    public function showImageForm()
    {
        return view('add-image');
    }

    // add image
    public function upload(Request $request)
    {
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);
        // return $request->nm;

        $url = $request->file('image')->store('images', 'public');
        // return basename($url);
        $imagePath = basename($url);

        return redirect()->route('show-image', compact('imagePath'));
    }

    // show the analyze form
    public function showImage($imagePath)
    {
        return view('show-image', compact('imagePath'));
    }

    // anaylize image
    public function processForm(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:100',
            'image' => 'required|url', // Ensure the image URL is provided
        ]);

        $prompt = strtolower($request->prompt); // Convert prompt to lowercase for case-insensitive comparison
        $imageUrl = $request->image;

        // Perform the analysis to check if the prompt is in the image URL
        $promptFoundInImage = stripos($imageUrl, $prompt) !== false;

        // Redirect to the result page with the analysis outcome
        return redirect()->route('showImage', compact('imageUrl', 'prompt', 'promptFoundInImage'));
    }

    // show analyze image
    public function analyzeimage(Request $request)
    {
        $imageUrl = $request->imageUrl;
        $prompt = $request->prompt;
        $promptFoundInImage = $request->promptFoundInImage;

        // Check if the prompt matches the image and set the new image URL accordingly
        $newImageUrl = $promptFoundInImage ? 'path_to_new_image.jpg' : null;
        // Replace 'path_to_new_image.jpg' with the actual path or URL

        return view('image-analysis', compact('imageUrl', 'prompt', 'promptFoundInImage', 'newImageUrl'));
    }

    // public function analyze(Request $request)
    // {
    //     $request->validate([
    //         'image' => 'required|string',
    //         'prompt' => 'required|string',
    //     ]);

    //     $imagePath = $request->input('image');
    //     $prompt = $request->input('prompt');

    //     // Use OpenAI's API to analyze the image and get the cropped part
    //     // $croppedImage = $this->analyzeImagecp($imagePath, $prompt);
    //     $openaiApiKey = env('OPENAI_API_KEY');
    //     $response = Http::withHeaders([
    //         'Authorization' => 'Bearer ' . $openaiApiKey,
    //     ])->post('https://api.openai.com/v1/engines/davinci/completions', [
    //                 'prompt' => $prompt,
    //                 'max_tokens' => 100,
    //                 'n' => 1,
    //                 'logit_bias' => ['image:' . asset('storage/' . $imagePath)],
    //             ]);
    //     return $response;

    //     return view('image-analysis', compact('croppedImage'));
    // }

    public function analyzeImageup(Request $request)
    {
        // Validate the form data
        $request->validate([
            'image' => 'required|url',
            'prompt' => 'required|string',
        ]);

        $prompt = $request->prompt;
        $imagePath = $request->image;
        // $base = asset('storage/' . $imagePath);

        // $openai = new OpenAI(env('OPENAI_API_KEY'));

        $response = OpenAI::images()->create([
            'prompt' => $prompt,
            'n' => 1,
            'size' => '1024x1024',
            'response_format' => 'url',
        ]);

        $imageUrl = $response['data'][0]['url'];

        // Check if the object mentioned in the prompt is present in the given image
        $objectDetected = $this->detectObject($imagePath, $prompt);

        if ($objectDetected) {
            // Generate a new image with the object
            $newImage = $this->generateNewImageWithObject($imagePath, $prompt);

            return view('result')->with([
                'uploadedImagePath' => $imagePath,
                'generatedImageUrl' => $newImage,
            ]);
        } else {
            return view('result')->with([
                'uploadedImagePath' => $imagePath,
                'errorMessage' => "The object '$prompt' was not found in the given image.",
            ]);
        }
    }

    private function detectObject($imagePath, $prompt)
    {
        // Implement object detection using the OpenAI API
        // $openai = new OpenAI(env('OPENAI_API_KEY'));

        $response = OpenAI::images()->create([
            'prompt' => "Is there a $prompt in the image?",
            'n' => 1,
        ]);

        dd($response);
        
        $output = $response['data'][0]['text'];

        if (str_contains($output, 'yes') || str_contains($output, 'Yes')) {
            return true;
        }

        return false;
    }

    private function generateNewImageWithObject($imagePath, $prompt)
    {
        // Generate a new image with the object using the OpenAI API
        // $openai = new OpenAI(env('OPENAI_API_KEY'));

        $response = OpenAI::images()->create([
            'prompt' => "Generate an image of a $prompt",
            'n' => 1,
        ]);

        dd($response);

        $newImageUrl = $response['data'][0]['url'];

        return $newImageUrl;
    }

    // public function detectObjects(Request $request)
    // {
    //     // Get the image URL from the request
    //     $imageUrl = $request->input('image_url');

    //     // Prepare the prompt
    //     $prompt = "A detailed description of everything in this image: $imageUrl";

    //     // Get the OpenAI API key from the environment configuration
    //     $apiKey = env('OPENAI_API_KEY');

    //     // Make a POST request to the OpenAI API
    //     $response = Http::withHeaders([
    //         'Authorization' => 'Bearer ' . $apiKey,
    //         'Content-Type' => 'application/json',
    //     ])->post('https://api.openai.com/v1/chat/completions', [
    //         'model' => 'gpt-4', // Specify the model you want to use
    //         'messages' => [
    //             ['role' => 'system', 'content' => 'You are a highly capable vision model.'],
    //             ['role' => 'user', 'content' => $prompt],
    //         ],
    //     ]);

    //     // Check if the API request was successful
    //     if ($response->successful()) {
    //         // Extract the description from the API response
    //         $description = $response->json()['choices'][0]['message']['content'];

    //         // Return the description as JSON response
    //         return response()->json(['description' => $description]);
    //     } else {
    //         // Return an error response if the API request failed
    //         return response()->json(['error' => 'Failed to process the image.'], $response->status());
    //     }
    // }

    public function detectObjects(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'image' => 'required|image|max:2048', // Ensure the uploaded file is an image and less than 2MB
        ]);

        $image = $request->file('image');
        $imagePath = $image->store('temp');
        $prompt = $request->prompt;

        $apiKey = env('OPENAI_API_KEY');

        // Make a POST request to the OpenAI API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4', // Specify the model you want to use
            'messages' => [
                ['role' => 'system', 'content' => 'You are a highly capable vision model.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);
        return $response;

        // Check if the API request was successful
        if ($response->successful()) {
            // Extract the description from the API response
            $description = $response->json()['choices'][0]['message']['content'];

            // Delete the temporary image file
            unlink(storage_path('app/' . $imagePath));

            // Return the description as JSON response
            return response()->json(['description' => $description]);
        } else {
            // Delete the temporary image file
            unlink(storage_path('app/' . $imagePath));

            // Return an error response if the API request failed
            return response()->json(['error' => 'Failed to process the image.'], $response->status());
        }
    }
}
