<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ImageGeneratorController extends Controller
{
    public function index()
    {
        return view('image-generator');
    }

    public function generateImage(Request $request)
    {
        $prompt = $request->input('prompt'); // or $request->prompt;
        // return $prompt;

        if (empty($prompt)) {
            // Optionally, return an error or redirect back if the prompt is empty
            return back()->with('error', 'The prompt cannot be empty.');
        }

        $client = new Client();
        $response = $client->request('POST', 'https://api.openai.com/v1/images/generations', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'prompt' => $prompt,
                // Add any additional parameters here
            ],
        ]);

        // The rest of your method...
        $body = json_decode($response->getBody(), true);
        $imageUrl = $body['data'][0]['url']; // Make sure to adjust this based on the actual response structure

        return view('image-show', compact('imageUrl'));
    }
}
