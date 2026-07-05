#!/usr/bin/env php
<?php

/**
 * Sincroniza .env → Railway (producción).
 *
 * Uso:
 *   railway login && railway link
 *   php scripts/railway-sync-env.php https://tu-app.up.railway.app
 */

$root = dirname(__DIR__);
$envFile = $root.'/.env';
$railwayUrl = $argv[1] ?? '';
$skipDeploy = in_array('--skip-deploy', $argv, true);

if (! is_file($envFile)) {
    fwrite(STDERR, "No existe .env\n");
    exit(1);
}

exec('railway whoami 2>&1', $whoami, $code);
if ($code !== 0) {
    fwrite(STDERR, "Ejecuta primero: railway login\n");
    exit(1);
}

$vars = [];
foreach (file($envFile, FILE_IGNORE_NEW_LINES) as $line) {
    $line = trim($line);
    if ($line === '' || str_starts_with($line, '#')) {
        continue;
    }
    if (! str_contains($line, '=')) {
        continue;
    }
    [$key, $value] = explode('=', $line, 2);
    $key = trim($key);
    $value = trim($value, " \t\n\r\0\x0B\"'");
    $vars[$key] = $value;
}

$vars['APP_ENV'] = 'production';
$vars['APP_DEBUG'] = 'false';
$vars['DB_CONNECTION'] = 'pgsql';
$vars['TRUSTED_PROXIES'] = '*';
$vars['LOG_LEVEL'] = $vars['LOG_LEVEL'] ?? 'info';
$vars['AUTO_VERIFY_EMAIL'] = $vars['AUTO_VERIFY_EMAIL'] ?? 'false';

if ($railwayUrl !== '') {
    $vars['APP_URL'] = $railwayUrl;
}

if (empty($vars['APP_KEY'])) {
    fwrite(STDERR, "ERROR: APP_KEY vacía en .env\n");
    exit(1);
}

if (empty($vars['DB_HOST']) || empty($vars['DB_PASSWORD'])) {
    fwrite(STDERR, "ERROR: Faltan DB_HOST o DB_PASSWORD en .env\n");
    exit(1);
}

$keys = [
    'APP_NAME', 'APP_ENV', 'APP_KEY', 'APP_DEBUG', 'APP_URL',
    'LOG_CHANNEL', 'LOG_LEVEL',
    'DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD', 'DB_SSLMODE',
    'BROADCAST_DRIVER', 'CACHE_DRIVER', 'FILESYSTEM_DISK', 'QUEUE_CONNECTION',
    'SESSION_DRIVER', 'SESSION_LIFETIME',
    'MAIL_MAILER', 'MAIL_HOST', 'MAIL_PORT', 'MAIL_USERNAME', 'MAIL_PASSWORD', 'MAIL_ENCRYPTION',
    'MAIL_FROM_ADDRESS', 'MAIL_FROM_NAME',
    'PAYPAL_CLIENT_ID', 'PAYPAL_CLIENT_SECRET', 'PAYPAL_MODE',
    'OPENWEATHER_API_KEY',
    'TRUSTED_PROXIES', 'AUTO_VERIFY_EMAIL',
];

$skipFlag = $skipDeploy ? ' --skip-deploys' : '';

echo "→ Subiendo variables a Railway…\n";

foreach ($keys as $key) {
    if (! isset($vars[$key]) || $vars[$key] === '') {
        echo "  · {$key} (omitida, vacía)\n";
        continue;
    }

    $value = $vars[$key];
    $escaped = str_replace("'", "'\\''", $value);
    $cmd = "railway variable set {$key}='{$escaped}'{$skipFlag} 2>&1";
    exec($cmd, $output, $exit);

    if ($exit !== 0) {
        fwrite(STDERR, "Error al subir {$key}: ".implode("\n", $output)."\n");
        exit(1);
    }

    echo "  ✓ {$key}\n";
}

echo "\nListo. Comprueba con: railway variable list --kv | grep DB_CONNECTION\n";
