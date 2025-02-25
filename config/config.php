<?php

function connectToDatabase() {
  $dbPath = __DIR__ . '/database/database.db'; // Use an absolute path

  if (!file_exists($dbPath)) {
      throw new Exception("Database file not found: $dbPath");
  }

  try {
      $pdo = new PDO('sqlite:' . $dbPath);
      return $pdo;
  } catch (PDOException $e) {
      throw new Exception("Unable to open database file: " . $e->getMessage());
  }
}

function closeConnection($db) {
    $db = null;
}