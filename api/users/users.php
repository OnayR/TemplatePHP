<?php

function getUser($user) {
  
  $pdo = connectToDatabase();
  
  $sql = "SELECT * FROM users WHERE LOWER(username) = LOWER(:user) OR LOWER(email) = LOWER(:user)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['user' => $user]);
  
  closeConnection($pdo);

  return $stmt->fetch();
}

function checkUser() {

  $pdo = connectToDatabase();

  if (isset($_SESSION['user'])) {
    $user = getUser($_SESSION['user']['email']);
    if ($user) {
      return true;
    }
  }

  return false;
  
}