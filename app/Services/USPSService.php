<?php

namespace App\Services;

class USPSService
{
    protected $access_token;

    public function __construct()
    {
        $this->generateOAuthToken();
    }

    // Generate OAuth tokens.
    public function generateOAuthToken()
    {

        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, 'https://api.usps.com/oauth2/v3/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
        ]);

        // Define the POST data
        $data = http_build_query([
            'grant_type' => 'client_credentials',
            'client_id' => 'DWSvYLhC5YTos3V6ojgtmoKiNtGBWFES',
            'client_secret' => 'ZAmrkAjiIzldGVJP',
            'scope' => 'addresses international-prices subscriptions payments pickup tracking labels scan-forms companies service-delivery-standards locations international-labels prices',
        ]);

        // Attach POST data to cURL
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // Execute the request and store the response
        $response = curl_exec($ch);
        // Check for errors
        if (curl_errno($ch)) {
            $this->access_token = null;
        } else {
            $response = json_decode($response, true);
            $this->access_token = $response['access_token'];
        }
        // Close the cURL session
        curl_close($ch);
    }

    /*
     * Get the base rate for a specific service.
     * @param string $originZIPCode
     * @param string $destinationZIPCode
     * @param float $weight (in pounds)
     * @param int $length (in inches)
     * @param int $width (in inches)
     * @param int $height (in inches)
     * @param string $mailClass
     * @param string $processingCategory
     * @param string $rateIndicator
     * @param string $destinationEntryFacilityType
     * @url: https://api.usps.com/prices/v3/base-rates/search
     */
    public function getBaseRateSearch(
        string $originZIPCode,
        string $destinationZIPCode,
        float $weight,
        int $length,
        int $width,
        int $height,
        string $mailClass = 'USPS_GROUND_ADVANTAGE',
        string $processingCategory = 'MACHINABLE',
        string $rateIndicator = 'SP',
        string $destinationEntryFacilityType = 'NONE',
        string $priceType = 'COMMERCIAL'
    ) {
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, 'https://api.usps.com/prices/v3/base-rates/search');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->access_token,
        ]);

        // Define the POST data
        $data = json_encode([
            'originZIPCode' => $originZIPCode,
            'destinationZIPCode' => $destinationZIPCode,
            'weight' => $weight,
            'length' => $length,
            'width' => $width,
            'height' => $height,
            'mailClass' => $mailClass,
            'processingCategory' => $processingCategory,
            'rateIndicator' => $rateIndicator,
            'destinationEntryFacilityType' => $destinationEntryFacilityType,
            'priceType' => $priceType,
        ]);

        // Attach POST data to cURL
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // Execute the request and store the response
        $response = curl_exec($ch);
        // Close the cURL session
        curl_close($ch);
        // Check for errors
        if (curl_errno($ch)) {
            return null;
        } else {
            return json_decode($response, true);
        }
    }
}
