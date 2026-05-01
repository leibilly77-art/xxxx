<?php

declare(strict_types=1);

return [
    'host' => getenv('XPAY_DB_HOST') ?: '127.0.0.1',
    'port' => getenv('XPAY_DB_PORT') ?: '3306',
    'database' => getenv('XPAY_DB_DATABASE') ?: 'xpay',
    'username' => getenv('XPAY_DB_USERNAME') ?: 'root',
    'password' => getenv('XPAY_DB_PASSWORD') ?: '',
    'charset' => getenv('XPAY_DB_CHARSET') ?: 'utf8mb4',
];
