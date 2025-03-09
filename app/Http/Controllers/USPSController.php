<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\USPSApiService;

class USPSController extends Controller
{
    protected $uspsApiService;

    public function __construct(USPSApiService $uspsApiService)
    {
        $this->uspsApiService = $uspsApiService;
    }

    public function getShippingRates(Request $request)
    {
        // Validate request parameters
        $request->validate([
            'service_type' => 'required|string',
            'weight' => 'required|numeric',
            'origin_zip' => 'required|string|size:5',
            'destination_zip' => 'required|string|size:5',
        ]);

        // Get the shipping rates from USPS API
        $serviceType = $request->input('service_type');
        $weight = $request->input('weight');
        $originZip = $request->input('origin_zip');
        $destinationZip = $request->input('destination_zip');

        $response = $this->uspsApiService->getDomesticPrices($serviceType, $weight, $originZip, $destinationZip);

        // Return the response
        return response()->json($response);
    }
}