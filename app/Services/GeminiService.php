<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $apiKey;
    protected $endpoint;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->endpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent';
    }

    public function translate(string $text, string $textLang, string $targetLang): ?string
    {
        $response = Http::post($this->endpoint . '?key=' . $this->apiKey, [
            'contents' => [[ 'parts' => [[ 'text' => "translate this $text from $textLang to $targetLang  only return the translation without more talking"  ]]]],
        ]);

        if ($response->successful()) {
            $result = $response->json('candidates.0.content.parts.0.text');
            return $result;
            // return $response->json('candidates.0.content.parts.0.text');
        }

        return null;
    }
}
