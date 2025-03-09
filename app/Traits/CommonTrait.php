<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait CommonTrait
{
    /**
     * Verify Google reCAPTCHA response.
     */
    public function verifyRecaptcha(string $recaptchaResponse, string $ipAddress): array
    {
        $googleUrl = 'https://www.google.com/recaptcha/api/siteverify';

        $response = Http::asForm()->post($googleUrl, [
            'secret' => config('services.google.recaptcha.secret'),
            'response' => $recaptchaResponse,
            'remoteip' => $ipAddress,
        ]);

        return $response->json();
    }
}
