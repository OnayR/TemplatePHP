<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . '/../api/users/users.php';
include __DIR__ . '/../config/config.php';

// Parse the URI to route the request appropriately
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// A simple routing mechanism
switch ($requestUri) {
    case '/':
    case '/dashboard':
      include __DIR__ . '/../pages/dashboard.php';
      break;
    case '/login-register':
      include __DIR__ . '/../pages/login.php';
      break;
    case '/login':
      include __DIR__ . '/../api/users/auth.php';
      login($_POST);
      break;
    case '/register':
      include __DIR__ . '/../api/users/auth.php';
      register($_POST);
      break;
    case '/logout':
      session_destroy();
      header('Location: /login-register');
      break;
    case '/googleLogin':
      include __DIR__ . '/../api/users/auth.php';
      googleLogin($_GET);
      break;
    default:
      http_response_code(404);
      echo '404 Not Found';
      break;
    }