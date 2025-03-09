<?php

namespace App\Http\Controllers\Frontend;

use App\Events\DistributorRequestEvent;
use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    use CommonTrait;

    /**
     * store a new distributor
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns,spoof',
            'phone' => 'required|string|max:20',
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'time' => 'required|array',
            'g-recaptcha-response' => 'required',
        ], [
            'time.required' => 'Please select the best time to contact you.',
            'time.array' => 'Please select the best time to contact you.',
            'email.email' => 'Please enter a valid email address.',
            'company_name.required' => 'Please enter your company name.',
            'phone.required' => 'Please enter your phone number.',
            'g-recaptcha-response.required' => 'Recaptcha validation failed. Please try again.',
        ]);

        $recaptchaResponse = $request->input('g-recaptcha-response');
        $ipAddress = $request->ip();

        $recaptchaResult = $this->verifyRecaptcha($recaptchaResponse, $ipAddress);

        if (! $recaptchaResult['success'] || $recaptchaResult['score'] < 0.5) {
            return response()->json(['error' => 'reCAPTCHA validation failed. Please try again.'], 422);
        }

        $model = new ContactSubmission;
        $model->first_name = $request->first_name;
        $model->email = $request->email;
        $model->phone_code = $request->phone_code;
        $model->phone = $request->phone;
        $model->company_name = $request->company_name;
        $model->company_address = $request->company_address;
        $model->best_time = $request->time;
        if ($model->save()) {
            event(new DistributorRequestEvent($model));

            return response()->json([
                'status' => 'success',
                'message' => 'Your request has been submitted successfully.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to submit your request. Please try again.',
            ]);
        }
    }

    public function becomeDistributor()
    {
        $countries = getCountriesWithCodes();

        $pageTitle = 'Become a Wholesaler';
        $metaDescription = 'Become a wholesaler and get access to our exclusive products. We offer a wide range of products at wholesale prices. Sign up now!';
        $metaKeywords = 'wholesale, wholesaler, distributor, distributorship, wholesale products, wholesale prices';
        $metaImage = asset('assets/images/logo.png');

        return view('frontend.pages.become-distributor', compact(
            'countries',
            'pageTitle',
            'metaDescription',
            'metaKeywords',
            'metaImage'
        ));
    }
}
