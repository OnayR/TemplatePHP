<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Parse the URI to route the request appropriately
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// A simple routing mechanism
switch ($requestUri) {
    case '/':
      include __DIR__ . '/../pages/dashboard.php';
      break;
    }
