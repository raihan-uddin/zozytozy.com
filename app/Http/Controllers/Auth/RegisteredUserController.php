<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'g-recaptcha-response' => 'required',
            'email' => ['required',
                'string',
                'lowercase',
                'email:rfc,dns,spoof',
                'max:255',
                'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $recaptchaResponse = $request->input('g-recaptcha-response');
        $ipAddress = $request->ip();

        $recaptchaResult = $this->verifyRecaptcha($recaptchaResponse, $ipAddress);

        if (! $recaptchaResult['success'] || $recaptchaResult['score'] < 0.5) {
            return response()->json(['error' => 'reCAPTCHA validation failed. Please try again.'], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        if (Auth::user()->is_admin) {
            return redirect(route('dashboard', absolute: false));
        } else {
            return redirect()->route('verification.notice');
        }
    }

    /**
     * Verify Google reCAPTCHA v3 response
     *
     * @param  string  $recaptchaResponse  The response token from the frontend
     * @param  string  $ipAddress  The user's IP address
     * @return array The verification result from Google
     */
    public function verifyRecaptcha(string $recaptchaResponse, string $ipAddress): array
    {
        $googleUrl = 'https://www.google.com/recaptcha/api/siteverify';

        $response = Http::asForm()->post($googleUrl, [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $recaptchaResponse,
            'remoteip' => $ipAddress,
        ]);

        return $response->json();
    }
}
