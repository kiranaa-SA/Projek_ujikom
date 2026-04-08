<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // 🔥 Gunakan origin spesifik atau * kalau tidak pakai credentials
    'allowed_origins' => ['http://127.0.0.1:8000', 'http://localhost:8000', '*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    // Jika pakai Bearer token, expose Authorization
    'exposed_headers' => ['Authorization'],

    'max_age' => 0,

    // Kalau pakai Bearer token, set false. Kalau pakai cookie session, set true
    'supports_credentials' => false,
];