<?php

return [
    'openrouter' => [
        'base_url' => env('OPENROUTER_BASE_URL', 'https://openrouter.ai/api/v1'),
        'api_key' => env('OPENROUTER_API_KEY'),
        'model' => env('OPENROUTER_MODEL'),
        'timeout_seconds' => (int) env('OPENROUTER_TIMEOUT_SECONDS', 60),
    ],
    'pollinations' => [
        'base_url' => env('POLLINATIONS_URL', 'https://image.pollinations.ai/prompt/'),
    ],
];

