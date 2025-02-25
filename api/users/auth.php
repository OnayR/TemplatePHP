<?php


function login($postData) {
    // Check if the user exists
    $user = getUser($postData['username']);
    if (!$user) {
        echo json_encode($postData);
        return;
    }

    if(strlen($postData['password']) == 0){
        echo 'Password is required';
        return;
    }

    // Check if the password is correct
    if (!password_verify($postData['password'], $user['password'])) {
        echo 'Invalid password';
        return;
    }

    // Set the session
    session_start();
    $_SESSION['user'] = $user;
    // Redirect to the dashboard
    header('Location: /');
}

function googleLogin() {
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }

  $pdo = connectToDatabase();
  $idToken = $_GET['code'];


  // Google OAuth 2.0 token verification endpoint
  $url = 'https://oauth2.googleapis.com/tokeninfo?id_token=' . $idToken;

  // Initialize cURL session
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);

  // Decode the JSON response
  $data = json_decode($response, true);

  // Check if the token is valid
  $clientId = json_decode(file_get_contents(__DIR__ . '/../../config/googleSSO.json'), true)['clientId'];

  echo json_encode($data);
  exit;
  if (isset($data['aud']) && $data['aud'] == $clientId) {
      // Token is valid, proceed with login
      $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
      $stmt->execute(['email' => $data['email']]);
      $user = $stmt->fetch();

      if (!$user) {
          // User does not exist, create a new user
          $stmt = $pdo->prepare('INSERT INTO users (email, username, picture) VALUES (:email, :username, :picture)');
          $stmt->execute([
              'email' => $data['email'],
              'username' => $data['given_name'] . ' ' . $data['family_name'],
              'picture' => $data['picture']
          ]);
          $data['id'] = $pdo->lastInsertId();
      } else {
          $stmt = $pdo->prepare('UPDATE users SET picture = :picture WHERE id = :id');
          $stmt->execute([
              'picture' => $data['picture'],
              'id' => $user['id']
          ]);
          $data['id'] = $user['id'];
      }

      closeConnection($pdo);
      $_SESSION['user'] = $data;
      header('Location: /');
  } else {
      echo 'Invalid token';
      closeConnection($pdo);
      header('Location: /login-register');
  }
}

function register($postData) {
    // Check if the user exists
    $user = getUser($postData['username']);
    if ($user) {
        echo 'User already exists';
        return;
    }
    $user = getUser($postData['email']);
    if ($user) {
        echo 'Email already exists';
        return;
    }
    // Hash the password
    $hashedPassword = password_hash($postData['password'], PASSWORD_DEFAULT);

    $pdo = connectToDatabase();
    
    // Create the user
    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'username' => $postData['username'],
        'email' => $postData['email'],
        'password' => $hashedPassword
    ]);
    
    closeConnection($pdo);
    // Set the session
    session_start();
    $_SESSION['user'] = $user;
    // Redirect to the dashboard
    header('Location: /');
}

function logout() {
    session_start();
    session_destroy();
    header('Location: /login-register');
}