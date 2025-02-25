<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!checkUser()) {
    header('Location: /login-register');
    exit();
}

?>

<body>
  <h1>Dashboard</h1>
  <p>Welcome to the dashboard, you are logged in!</p>
  <a href="/logout">Logout</a>
</body>