<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'usps' => [
        'username' => env('USPS_USERNAME'),
        'password' => env('USPS_PASSWORD'),
        'consumer_secret' => env('USPS_CONSUMER_SECRET'),
        'consumer_key' => env('USPS_CONSUMER_KEY'),
        'test_mode' => env('USPS_TEST_MODE', false),
    ],
    'google' => [
        'recaptcha' => [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'sitekey' => env('RECAPTCHA_SITE_KEY'),
        ],
    ],
];
