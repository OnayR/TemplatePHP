<?php
// Get the google Client ID from the config folder
$clientId = json_decode(file_get_contents(__DIR__ . '/../config/googleSSO.json'), true)['clientId'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login/Signup Form</title>
  <link rel="stylesheet" href="../public/css/login.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <div class="container">
    <div class="form-box login">
      <form action="/login" method="post">
        <h1>Login</h1>
        <div class="input-box">
          <input type="text" placeholder="Username / Email" name="username" required>
          <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
          <input type="password" placeholder="Password" name="password" required>
          <i class='bx bxs-lock-alt'></i>
        </div>
        <div class="forgot-link">
          <a href="#">Forgot Password?</a>
        </div>
        <button type="submit" class="btn">Login</button>
        <p>or login with social platforms</p>
        <div class="social-icons">
          <a
            href="https://accounts.google.com/o/oauth2/v2/auth?response_type=code&scope=profile email&client_id=<?= $clientId ?>&redirect_uri=http://localhost/googleLogin"><i
              class='bx bxl-google'></i></a>
          <a href=" #"><i class='bx bxl-facebook'></i></a>
          <a href="#"><i class='bx bxl-github'></i></a>
          <a href="#"><i class='bx bxl-linkedin'></i></a>
        </div>
      </form>
    </div>

    <div class="form-box register">
      <form action="/register" method="post">
        <h1>Registration</h1>
        <div class="input-box">
          <input type="text" placeholder="Username" name="username" required>
          <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
          <input type="email" placeholder="Email" name="email" required>
          <i class='bx bxs-envelope'></i>
        </div>
        <div class="input-box">
          <input type="password" placeholder="Password" name="password" required>
          <i class='bx bxs-lock-alt'></i>
        </div>
        <button type="submit" class="btn">Register</button>
        <p>or register with social platforms</p>
        <div class="social-icons">
          <a href="#"><i class='bx bxl-google'></i></a>
          <a href="#"><i class='bx bxl-facebook'></i></a>
          <a href="#"><i class='bx bxl-github'></i></a>
          <a href="#"><i class='bx bxl-linkedin'></i></a>
        </div>
      </form>
    </div>

    <div class="toggle-box">
      <div class="toggle-panel toggle-left">
        <h1>Hello, Welcome!</h1>
        <p>Don't have an account?</p>
        <button class="btn register-btn">Register</button>
      </div>

      <div class="toggle-panel toggle-right">
        <h1>Welcome Back!</h1>
        <p>Already have an account?</p>
        <button class="btn login-btn">Login</button>
      </div>
    </div>
  </div>

  <script src="../public/js/login.js"></script>
</body>

</html>