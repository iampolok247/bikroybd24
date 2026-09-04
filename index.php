<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Handle static public assets seamlessly when hosted in root / public_html
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?? '');
$publicFile = __DIR__ . '/public' . $uri;

if ($uri !== '/' && !empty($uri) && file_exists($publicFile) && !is_dir($publicFile)) {
    $mimeType = mime_content_type($publicFile);
    if (str_ends_with($publicFile, '.css')) {
        $mimeType = 'text/css';
    } elseif (str_ends_with($publicFile, '.js')) {
        $mimeType = 'application/javascript';
    } elseif (str_ends_with($publicFile, '.svg')) {
        $mimeType = 'image/svg+xml';
    } elseif (str_ends_with($publicFile, '.png')) {
        $mimeType = 'image/png';
    } elseif (str_ends_with($publicFile, '.jpg') || str_ends_with($publicFile, '.jpeg')) {
        $mimeType = 'image/jpeg';
    }
    header("Content-Type: {$mimeType}");
    header("Cache-Control: public, max-age=31536000");
    readfile($publicFile);
    exit;
}

// Register the Composer autoloader...
require __DIR__.'/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/bootstrap/app.php')
    ->handleRequest(Request::capture());
