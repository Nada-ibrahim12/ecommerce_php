<?php
// index.php

// Get the requested path
$requestUri = $_SERVER['REQUEST_URI'];

$baseDir = '/Practice/ecommerce_php';
$requestUri = substr($requestUri, strlen($baseDir));

// Define routes
$routes = [
    '/' => './login.php',
    '/admin' => 'admin.php',
    '/buyer' => 'buyer.php',
    '/manageUsers' => 'manageUsers.php',
    '/register' => 'register.php',
    '/seller' => 'seller.php',
    // '/db' => 'db.php',

];

// Check if the requested route exists
if (array_key_exists($requestUri, $routes)) {
    include __DIR__ . '/' . $routes[$requestUri];
} else {
    // Handle 404 Not Found
    http_response_code(404);
    echo '404 - Page Not Found';
}
