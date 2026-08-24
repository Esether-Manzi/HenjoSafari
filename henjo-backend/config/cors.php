<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Allowed Origins
    |--------------------------------------------------------------------------
    |
    | Local dev origins are always allowed. Additional origins (e.g. a Vercel
    | preview/demo URL, or the real production domain once it exists) can be
    | added without a code change via CORS_ALLOWED_ORIGINS — a comma-separated
    | list in .env, e.g. CORS_ALLOWED_ORIGINS=https://my-demo.vercel.app
    |
    */
    'allowed_origins' => array_values(array_filter(array_merge(
        [
            'http://localhost:3000',
            'http://127.0.0.1:3000',
        ],
        array_map('trim', explode(',', env('CORS_ALLOWED_ORIGINS', ''))),
    ))),

    /*
    | Vercel assigns an unpredictable *.vercel.app URL per project/preview,
    | so this pattern lets any Vercel-hosted demo deployment through without
    | needing to hardcode it. Tighten this to the real domain once deployed.
    */
    'allowed_origins_patterns' => [
        '#^https://.*\.vercel\.app$#',
    ],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];