<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "bleuConnection.php";

if (isset($_POST['uname'], $_POST['pass'])) {
    $username = trim($_POST['uname']);
    $pass = trim($_POST['pass']);

    $stmt = $bleuConn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($pass === $row['password']) { // Use password_verify if using hashed passwords!
            if ($row['status'] == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $row['role'];
                if ($row['role'] === "admin") {
                    echo "<script>
                        alert('Login successful: Welcome Admin!');
                        window.location.href = 'bleuAdminMainPage.php';
                    </script>";
                    exit();
                } else {
                    echo "<script>
                        alert('Login successful: Welcome Client!');
                        window.location.href = 'bleuClientMainPage.php';
                    </script>";
                    exit();
                }
            } else {
                header("Location: bleuLogin.php?message=Your account is awaiting admin approval.");
                exit();
            }
        } else {
            header("Location: bleuLogin.php?message=Login error: Incorrect password.");
            exit();
        }
    } else {
        header("Location: bleuLogin.php?message=Login error: Account does not exist.");
        exit();
    }
} else {
    header("Location: bleuLogin.php?message=Please enter credentials.");
    exit();
}
?>
