<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

   //local
    'facebook' => [
    'client_id' => '1361360707308056',
    'client_secret' => '0d2dda56f37756784caf4f83e311bd24',
    'redirect' => 'http://localhost:8000/callback',
     ],

    //server
     // 'facebook' => [
     // 'client_id' => '1827442653951223',
     // 'client_secret' => '93b81e5c044aa2a6727846affef44414',
     // 'redirect' => 'http://snaplockandroid.com/fbapps/callback',
     //  ],

];
