<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "bleuConnection.php";

$message = "";
$messageColor = "black"; // default

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname    = $_POST['fname'] ?? '';
    $lname    = $_POST['lname'] ?? '';
    $email    = $_POST['email'] ?? '';
    $username = $_POST['uname'] ?? '';
    $pass     = $_POST['pass'] ?? '';
    $cpass    = $_POST['cpass'] ?? '';

    if ($pass !== $cpass) {
        $message = "Passwords do not match.";
    } else {
        // Use password_hash() in production
        $hash = $pass;

        $stmt = $bleuConn->prepare(
            "INSERT INTO users (username, password, role, fname, lname, email, status)
             VALUES (?, ?, 'client', ?, ?, ?, 0)"
        );

        if ($stmt) {
            $stmt->bind_param("sssss", $username, $hash, $fname, $lname, $email);
            if ($stmt->execute()) {
                $message = "Registered successfully. Wait for admin approval.";
            } else {
                $message = "Username or email already exists.";
            }
            $stmt->close();
        } else {
            $message = "Database error.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: "Georgia", serif;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

/* ===== Background ===== */
body::before {
    content: "";
    position: fixed;
    inset: 0;
    background-image: url('background.JPG');
    background-size: cover;
    background-position: center;
    filter: grayscale(100%) blur(8px) brightness(0.6);
    z-index: -1;
}

/* ===== Form ===== */
form {
    background: rgba(255, 255, 255, 0.95);
    padding: 40px 50px;
    border-radius: 16px;
    width: 100%;
    max-width: 500px;
    text-align: center;
    box-shadow: 0 15px 40px rgba(0,0,0,0.4);
    animation: fadeIn 1s ease;
}

/* ===== Title ===== */
form h1 {
    font-size: 2.5rem;
    color: #000;
    margin-bottom: 25px;
    letter-spacing: 1px;
}

/* ===== Table ===== */
table {
    width: 100%;
}

td {
    padding: 8px 5px;
}

td h2 {
    font-size: 0.9em;
    color: #000;
}

/* ===== Inputs ===== */
input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px 15px;
    border: 1.5px solid #000;
    border-radius: 8px;
    font-size: 1em;
    background: #fff;
    color: #000;
}

input::placeholder {
    color: #555;
}

input:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(0,0,0,0.3);
}

/* ===== Button ===== */
button.bleuSignUp {
    width: 75%;
    padding: 12px 25px;
    margin-top: 15px;
    background: #000;
    color: #fff;
    border: 2px solid #000;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1em;
    font-weight: bold;
    transition: all 0.3s ease;
}

button.bleuSignUp:hover {
    background: #fff;
    color: #000;
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
}

/* ===== Message ===== */
#message {
    margin-top: 15px;
    font-weight: bold;
    font-size: 15px;
    color: #000;
}

/* ===== Links ===== */
.register-link {
    margin-top: 15px;
    font-size: 14px;
}

.register-link a {
    color: #000;
    text-decoration: underline;
}

/* ===== Animation ===== */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
</head>

<body>

<form action="bleuInsert.php" method="POST" autocomplete="off">
    <h1>Welcome to bleu de blanc</h1>

    <table>
        <tr>
            <td><h2>Full Name</h2></td>
            <td><input type="text" name="fname" placeholder="First Name" required></td>
            <td><input type="text" name="lname" placeholder="Last Name" required></td>
        </tr>
        <tr>
            <td><h2>Email</h2></td>
            <td colspan="2"><input type="text" name="email" placeholder="Email" required></td>
        </tr>
        <tr>
            <td><h2>Username</h2></td>
            <td colspan="2"><input type="text" name="uname" placeholder="Username" required></td>
        </tr>
        <tr>
            <td><h2>Password</h2></td>
            <td colspan="2"><input type="password" name="pass" placeholder="Password" required></td>
        </tr>
        <tr>
            <td><h2>Confirm</h2></td>
            <td colspan="2"><input type="password" name="cpass" placeholder="Confirm Password" required></td>
        </tr>
    </table>

    <button type="submit" class="bleuSignUp" name="bleuSignUp">Register</button>

    <p id="message"><?php echo htmlspecialchars($message); ?></p>

    <p class="register-link">
        Already have an account?
        <a href="bleuLogIn.php">Log In</a>
    </p>
</form>

<script>
function hideErrorMessage() {
    const msg = document.getElementById('message');
    if (msg && msg.innerText.trim() !== "") {
        setTimeout(() => msg.innerHTML = '', 5000);
    }
}
hideErrorMessage();
</script>

</body>
</html>
