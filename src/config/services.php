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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'line' => [
        'login_app_url' => env('LINE_LOGIN_APP_URL'),
        'login_app_key' => env('LINE_LOGIN_APP_KEY'),
        'login_redirect_uri' => env('LINE_LOGIN_APP_REDIRECT_URL'),
        'login_app_secret' => env('LINE_LOGIN_APP_SECRET'),
        'login_authorize_uri' => env('LINE_LOGIN_APP_AUTHORIZE_URI'),
    ],

];
