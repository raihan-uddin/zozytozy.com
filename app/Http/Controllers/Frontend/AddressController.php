<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;


class AddressController extends Controller
{
    public function verifyAddressByPostalCode($address)
    {
        // Get USPS credentials from the configuration
        $username = config('services.usps.username');
        $password = config('services.usps.password');

    }




}
