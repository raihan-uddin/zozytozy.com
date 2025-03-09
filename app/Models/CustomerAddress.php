<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    

    public function verifyAddressByPostalCode($address)
    {
        // Get USPS credentials from the configuration
        $username = config('services.usps.username');
        $password = config('services.usps.password');

        $url = 'http://production.shippingapis.com/ShippingAPI.dll';

        

    }
}
