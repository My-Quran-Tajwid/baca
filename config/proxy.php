<?php

return [
    /*
    | Enable trusted proxy configuration. Useful when running the app behind
    | a reverse proxy, for example. Default to false.
    */
    'enabled' => env('ENABLE_TRUSTED_PROXY_CONFIG', false),

    /*
    | Configure trusted proxies IP. Default to trust all proxies.
    */
    'trusted_proxies' => env('TRUSTED_PROXIES', '*'),
];
