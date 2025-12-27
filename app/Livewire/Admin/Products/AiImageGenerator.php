<?php

namespace App\Livewire\Admin\Products;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class AiImageGenerator extends Component
{



    #[Validate('required')]
    public $prompt;

    public $res;
    public function generateContent()
    {

        $this->validate();
        $apiKey = config('services.gemini.api_key'); // Store in config/services.php
        $modelId = 'gemini-2.5-flash-image-preview';
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$modelId}:streamGenerateContent?key={$apiKey}";

        $inputText = $this->prompt;

        $payload = [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        [
                            'text' => $inputText
                        ]
                    ]
                ]
            ],
            'generationConfig' => [
                'responseModalities' => ['IMAGE', 'TEXT']
            ]
        ];
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post($url, $payload);
dd($response->body());
            if ($response->failed()) {
                return response()->json([
                    'error' => 'API request failed',
                    'status' => $response->status(),
                    'message' => $response->body()
                ], $response->status());
            }

            return  $this->res = response()->json($response->json());
//            return response()->json($response->json());

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Request failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.ai-image-generator');
    }
}
