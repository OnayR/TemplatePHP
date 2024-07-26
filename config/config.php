<?php

function connectToDatabase() {
    $db = new PDO('sqlite:/database/database.db');
    return $db;
}

function closeConnection($db) {
    $db = null;
}