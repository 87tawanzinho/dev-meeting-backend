<?php

return [

    /*
    |-------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |-------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'], // Permitir todos os métodos HTTP (GET, POST, PUT, DELETE, etc.)

    'allowed_origins' => [
        'http://localhost:3000', // URL do frontend em desenvolvimento
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Permitir todos os cabeçalhos

    'exposed_headers' => [],

    'max_age' => 3600, // Tempo em segundos que o navegador pode armazenar as permissões de CORS

    'supports_credentials' => true, // Necessário se você estiver utilizando cookies para autenticação
];