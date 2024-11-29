<?php

return [
    'paths' => ['api/*'], // Habilita CORS para las rutas de la API

    'allowed_methods' => ['*'], // Permite todos los métodos (GET, POST, PUT, DELETE)

    'allowed_origins' => ['*'], // Cambia a la URL de tu aplicación React

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Permite todos los encabezados

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];

