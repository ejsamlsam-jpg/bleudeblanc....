<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$hasResult = isset($_SESSION['bleu']);
$wasSuccessful = $hasResult && $_SESSION['bleu'] == 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Result</title>
    <style>
body {
    font-family: "Georgia", serif;
    margin: 0;
    padding: 0;
    height: 100vh;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    overflow: hidden;
    background: none;
}
body::before {
    content: "";
    position: fixed;
    top: 0; left: 0; width: 100%; height: 100%;
    background-image: url('background.JPG');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    filter: blur(8px) brightness(0.7);
    z-index: -1;
}
.result-container {
    background: #f7f2e8;
    border-radius: 15px;
    padding: 40px 40px 30px 40px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
    width: 100%;
    max-width: 420px;
    text-align: center;
    margin: 0 auto;
    backdrop-filter: blur(5px);
    animation: fadeIn 1s ease;
}
h1 {
    color: black;
    font-size: 2.2rem;
    margin-bottom: 15px;
    letter-spacing: 1px;
    text-shadow: 2px 2px 3px gray;
}
h2 {
    margin: 15px 0 5px 0;
    font-size: 1.2em;
    color: #2d3436;
}
span {
    color: #b1342f;
}
button {
    background: #180f03bd;
    padding: 8px 25px;
    margin-top: 18px;
    font-size: 17px;
    font-weight: bold;
    border: 2px ;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    color: black;
}
button:hover {
    background: white;
    transform: translateY(-2px) scale(1.05);
    box-shadow: 2px 2px 6px rgba(0,0,0,0.15);
}
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(-20px);}
    to {opacity: 1; transform: translateY(0);}
}
    </style>
</head>
<body>
<div class="result-container">
<?php if ($hasResult && $wasSuccessful): ?>
    <h1>Registered successfully</h1>
    <h2>Hello, <span><?php echo isset($_SESSION['bleufname']) ? htmlspecialchars($_SESSION['roblesfname']) : "User"; ?></span>!<br>
    You are now registered. Please wait for admin approval.</h2>
<?php elseif ($hasResult): ?>
    <h1>Registration failed.</h1>
    <h2>Passwords should match or user already exists.<br>Please try again.</h2>
<?php else: ?>
    <h1>No registration data found.</h1>
<?php endif; ?>
    <?php session_destroy(); ?>
    <a href="bleuLogIn.php"><button>Return</button></a>
</div>
</body>
</html>
