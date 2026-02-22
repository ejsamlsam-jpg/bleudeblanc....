<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure only admins can access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: bleuLogIn.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>
</head>

<frameset rows="20%,*,12%" border="0">

    <!-- HEADER -->
    <frame src="bleuHeader.php" noresize scrolling="no">

    <!-- MAIN AREA -->
    <frameset cols="30%,*">

        <!-- LEFT NAV -->
        <frame src="bleuAdminNav.php" name="nav_column" noresize scrolling="no">

        <!-- RIGHT OUTPUT -->
        <frame src="bleuAdminProduct.php" name="column">

    </frameset>

    <!-- FOOTER -->
    <frame src="bleuFooter.php" noresize scrolling="no">

</frameset>

