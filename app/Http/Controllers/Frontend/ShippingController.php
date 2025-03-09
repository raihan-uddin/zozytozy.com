<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\USPSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShippingController extends Controller
{
    public function calculateEconomyCharge(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
                'zip_code' => 'required|numeric|digits_between:5,9|regex:/^\d{5}(?:[-\s]\d{4})?$/',
                'cart' => 'required|array',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid input',
                'errors' => $validator->errors(),
            ]);
        }

        $totalWeight = $this->calculateTotalWeight($request->cart);
        if ($totalWeight < 1) {
            $totalWeight = 1;
        }
        $packageDimension = $this->packageDimension($totalWeight);
        $length = $packageDimension['length'];
        $width = $packageDimension['width'];
        $height = $packageDimension['height'];

        $usps = new USPSService;
        $response = $usps->getBaseRateSearch(
            originZIPCode: config('app.zip_code'),
            destinationZIPCode: 75002, // State: Texas, City: Allen
            weight: $totalWeight,
            length: $length,
            width: $width,
            height: $height,
        );
        $totalPrice = 0;
        if ($response) {
            $basePrice = isset($response['totalBasePrice']) ? $response['totalBasePrice'] : 0;
            $totalPrice = round($basePrice + ($basePrice * config('app.handling_fee_percentage') / 100), 2);
            if ($totalPrice < 10) {
                $totalPrice = 10;
            }
        }

        if ($totalPrice == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to calculate economy charge',
                'charge' => 0,
                'Response' => $response,
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Economy charge calculated successfully',
                'charge' => $totalPrice,
            ]);
        }
    }

    // Calculate the total weight in pounds from cart
    private function calculateTotalWeight($cart)
    {
        $totalWeight = 0;
        foreach ($cart as $item) {
            $weight = $item['weight'] ?? 0;
            $weightUnit = $item['weight_unit'] ?? 'lb'; // Default to 'lb' if unit is not provided

            // if it has variant
            if (isset($item['variant'])) {
                $weight = $item['variant']['weight'] ?? 0;
                $weightUnit = $item['variant']['weight_unit'] ?? 'lb'; // Default to 'lb' if unit is not provided
            }

            if ($weight <= 0) {
                $weight = 1; // Default to 1 lb if weight is not provided
            }

            $totalWeight += $this->convertToPounds($weight, $weightUnit);
        }

        return $totalWeight;
    }

    // Convert the weight to pounds
    private function convertToPounds($weight, $weightUnit)
    {
        return match ($weightUnit) {
            'oz' => $weight / 16,
            'lb' => $weight,
            'g' => $weight / 453.592,
            'kg' => $weight / 0.453592,
            'mg' => $weight / 453592,
            'l' => $weight * 2.20462,
            'ml' => $weight * 0.00220462,
            'gal' => $weight * 8.345404,
            default => $weight,
        };
    }

    /**
     * Calculate the package dimension for usps
     *
     * @param  float  $totalWeight
     * @return array
     * @return array An associative array with 'length', 'width', and 'height' in inches
     */
    private function packageDimension($totalWeight)
    {
        // Define weight-to-dimension mapping (in pounds)
        $dimensionsMapping = [
            1 => ['length' => 6,  'width' => 6,  'height' => 4.5],
            2 => ['length' => 6, 'width' => 6,  'height' => 6.5],
            3 => ['length' => 10, 'width' => 8, 'height' => 6.5],
            4 => ['length' => 12, 'width' => 12, 'height' => 4.5],
            6 => ['length' => 12, 'width' => 12, 'height' => 6.5],
            7 => ['length' => 12, 'width' => 12, 'height' => 8.5],
            11 => ['length' => 12, 'width' => 12, 'height' => 12.5],
            14 => ['length' => 16, 'width' => 12, 'height' => 12.5],
            16 => ['length' => 18, 'width' => 12, 'height' => 12.5],
            17 => ['length' => 14, 'width' => 14, 'height' => 14.5],
            21 => ['length' => 24, 'width' => 12, 'height' => 12.5],
            25 => ['length' => 16, 'width' => 16, 'height' => 16.5],
            32 => ['length' => 18, 'width' => 18, 'height' => 16.5],
            36 => ['length' => 18, 'width' => 18, 'height' => 18.5],
            47 => ['length' => 24, 'width' => 18, 'height' => 18.5],
            49 => ['length' => 20, 'width' => 20, 'height' => 20.5],
            65 => ['length' => 22, 'width' => 22, 'height' => 22.5],
            84 => ['length' => 24, 'width' => 24, 'height' => 24.5],
        ];

        // Find the dimension based on the total weight
        foreach ($dimensionsMapping as $maxWeight => $dimensions) {
            if ($totalWeight <= $maxWeight) {
                return $dimensions;
            }
        }

        // Return the largest dimension if the total weight exceeds the maximum weight
        return end($dimensionsMapping);
    }
}
