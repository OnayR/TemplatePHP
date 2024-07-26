<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Parse the URI to route the request appropriately
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dayl.ink</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<?php

// A simple routing mechanism
switch ($requestUri) {
    case '/':
      include __DIR__ . '/../pages/dashboard.php';
      break;
    }

?>

</html>