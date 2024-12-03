<?php

return [
    'paths' => ['api/*'], // Habilita CORS para las rutas de la API

    'allowed_methods' => ['*'], 

    'allowed_origins' => ['*'], 

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];



