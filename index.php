<?php
// index.php

// Get the requested path
$requestUri = $_SERVER['REQUEST_URI'];

// Remove query string from the request URI
$requestUri = strtok($requestUri, '?');

// Detect environment (Vercel or XAMPP)
if (isset($_SERVER['VERCEL'])) {
    // Running on Vercel
    $baseDir = '';
} else {
    // Running on XAMPP or local server
    $baseDir = '/Practice/ecommerce_php';
}

// Remove the base directory from the request URI
$requestUri = substr($requestUri, strlen($baseDir));

// Define routes
$routes = [
    '/' => 'login.php',
    '/admin' => 'admin.php',
    '/buyer' => 'buyer.php',
    '/manageUsers' => 'manageUsers.php',
    '/register' => 'register.php',
    '/seller' => 'seller.php',
];

// Check if the requested route exists
if (array_key_exists($requestUri, $routes)) {
    include __DIR__ . '/' . $routes[$requestUri];
} else {
    // Handle 404 Not Found
    http_response_code(404);
    echo '404 - Page Not Found';
}
