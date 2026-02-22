<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect if not logged in or not a client
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'client') {
    header("Location: bleuLogIn.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
</head>
<frameset rows="20%,*,12%" border=0>
    <!-- Header -->
    <frameset cols="*">
        <frame noresize src="bleuHeader.php" scrolling="NO">
    </frameset>

    <!-- Sidebar + Main content -->
    <frameset cols="30%,*">
        <frame noresize src="bleuClientNav.php" scrolling="NO" name="nav_column">
        <frame noresize src="bleuClientProduct.php" name="column">
    </frameset>

    <!-- Footer -->
    <frame noresize src="bleuFooter.php" scrolling="NO">
</frameset>
</html>
