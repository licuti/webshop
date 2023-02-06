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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '864575694541251',
        'client_secret' => '0858b98d63ccff8955cf594ce181277c',
        'redirect' => 'http://localhost:81/webshop/dang-nhap/callback'
    ],

    'google' => [
        'client_id' => '443200441871-2ofr7g76aaev5j9up4silrqkdb1kjvmq.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:81/webshop/dang-nhap/google/callback'
    ],


];
