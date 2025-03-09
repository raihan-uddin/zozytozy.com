<?php

namespace App\Services;

class BeautyProductDimensions
{
    // Define weight-to-dimension mappings (in pounds and inches)
    private $weightToDimensions = [
        0.1 => [4, 2, 1], // Light items like small makeup products
        0.5 => [5, 3, 2], // Medium weight like skincare bottles
        1.0 => [6, 4, 2], // Heavier items like larger jars
        2.0 => [8, 5, 3], // Bulkier items or multi-product packages
        3.0 => [10, 6, 4], // Large items or multi-product packages
        4.0 => [12, 8, 6], // Very large items or multi-product packages
        5.0 => [14, 10, 8], // Very large items or multi-product packages
        6.0 => [16, 12, 10], // Very large items or multi-product packages
        7.0 => [18, 14, 12], // Very large items or multi-product packages
        8.0 => [20, 16, 14], // Very large items or multi-product packages
        9.0 => [22, 18, 16], // Very large items or multi-product packages
        10.0 => [24, 20, 18], // Very large items or multi-product packages
        11.0 => [26, 22, 20], // Very large items or multi-product packages
        12.0 => [28, 24, 22], // Very large items or multi-product packages
        13.0 => [30, 26, 24], // Very large items or multi-product packages
        14.0 => [32, 28, 26], // Very large items or multi-product packages
        15.0 => [34, 30, 28], // Very large items or multi-product packages
        16.0 => [36, 32, 30], // Very large items or multi-product packages
        17.0 => [38, 34, 32], // Very large items or multi-product packages
        18.0 => [40, 36, 34], // Very large items or multi-product packages
        19.0 => [42, 38, 36], // Very large items or multi-product packages
        20.0 => [44, 40, 38], // Very large items or multi-product packages
        21.0 => [46, 42, 40], // Very large items or multi-product packages
        22.0 => [48, 44, 42], // Very large items or multi-product packages
        23.0 => [50, 46, 44], // Very large items or multi-product packages
        24.0 => [52, 48, 46], // Very large items or multi-product packages
        25.0 => [54, 50, 48], // Very large items or multi-product packages
        26.0 => [56, 52, 50], // Very large items or multi-product packages
        27.0 => [58, 54, 52], // Very large items or multi-product packages
        28.0 => [60, 56, 54], // Very large items or multi-product packages
        29.0 => [62, 58, 56], // Very large items or multi-product packages
        30.0 => [64, 60, 58], // Very large items or multi-product packages
    ];

    /**
     * Get estimated package dimensions based on weight.
     *
     * @param  float  $weight  The weight of the product in pounds.
     * @return array The estimated dimensions [length, width, height].
     */
    public function getDimensionsByWeight(float $weight): array
    {
        // Sort the mapping by weight in ascending order
        ksort($this->weightToDimensions);

        // Find the closest matching weight or use the heaviest available
        foreach ($this->weightToDimensions as $weightRange => $dimensions) {
            if ($weight <= $weightRange) {
                return $dimensions;
            }
        }

        // If the weight exceeds all specified ranges, scale the dimensions
        $largestDimensions = end($this->weightToDimensions);
        $scalingFactor = $weight / array_key_last($this->weightToDimensions);

        return array_map(function ($dimension) use ($scalingFactor) {
            return (int) round($dimension * $scalingFactor);
        }, $largestDimensions);
    }

    /**
     * Get the weight-to-dimension mappings.
     *
     * @return array The weight-to-dimension mappings.
     */
    public function getWeightToDimensions(): array
    {
        return $this->weightToDimensions;
    }
}

// Example usage
//$service = new \App\Services\BeautyProductDimensions();
//$productWeight = 0.75; // Example weight in pounds
//$dimensions = $service->getDimensionsByWeight($productWeight);
//
//print_r($dimensions); // Output estimated dimensions
