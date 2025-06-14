<?php
function base_url($path = '') {
    // Dapatkan protocol: http atau https
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';

    // Hostname, contoh: localhost
    $host = $_SERVER['HTTP_HOST'];

    // Path folder aplikasi, contoh: /proyekmu
    $scriptName = dirname($_SERVER['SCRIPT_NAME']);
    $scriptName = rtrim($scriptName, '/\\');

    // Gabungkan semuanya
    $url = $protocol . '://' . $host . $scriptName;

    // Tambahkan path tambahan jika ada
    if ($path) {
        $url .= '/' . ltrim($path, '/');
    }

    return $url;
}
