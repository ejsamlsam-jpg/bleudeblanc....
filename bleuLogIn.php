<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<style>
/* ===== Page Base ===== */
body {
    font-family: "Georgia", serif;
    margin: 0;
    padding: 0;
    position: relative;
    min-height: 100vh;
    overflow: hidden;

    display: flex;
    justify-content: center;
    align-items: center;
}

/* ===== Background ===== */
body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('background.JPG');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    filter: grayscale(100%) blur(8px) brightness(0.6);
    z-index: -1;
}

/* ===== Form Card ===== */
form {
    background-color: rgba(255, 255, 255, 0.95);
    padding: 40px 30px;
    border-radius: 15px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.4);
    width: 100%;
    max-width: 400px;
    text-align: center;
    backdrop-filter: blur(6px);
    animation: fadeIn 1s ease;
}

/* ===== Title ===== */
form h1 {
    color: #000;
    font-size: 2.4rem;
    margin-bottom: 25px;
    letter-spacing: 1px;
}

/* ===== Inputs ===== */
input[type="text"],
input[type="password"] {
    width: 75%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #000;
    border-radius: 8px;
    font-size: 16px;
    box-sizing: border-box;
    background: #fff;
    color: #000;
}

input::placeholder {
    color: #555;
}

/* ===== Button ===== */
button.bleuLogIn {
    background: #000;
    width: 75%;
    padding: 10px 15px;
    margin: 8px 0;
    font-size: 16px;
    font-weight: bold;
    border: 2px solid #000;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #fff;
}

button.bleuLogIn:hover {
    background: #fff;
    color: #000;
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 8px 20px rgba(0,0,0,0.4);
}

/* ===== Messages ===== */
#message {
    margin-top: 15px;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    color: #000;
}

.register-link {
    margin-top: 15px;
    font-size: 14px;
}

.register-link a {
    color: #000;
    text-decoration: underline;
}

.register-link a:hover {
    opacity: 0.7;
}

/* ===== Animations ===== */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
</head>

<body>

<form action="bleuVerifyUser.php" method="POST" autocomplete="off">
    <h1>Welcome to Bleu De Blanc</h1>

    <input type="text" name="uname" id="username" placeholder="Enter Username" required>
    <input type="password" name="pass" id="password" placeholder="Enter Password" required>

    <button type="submit" class="bleuLogIn" name="bleuLogIn">Log In</button>

    <p id="message">
        <?php if (!empty($error)) echo htmlspecialchars($error); ?>
    </p>

    <p class="register-link">
        Don't have an account?
        <a href="bleuRegister.php">Register</a>
    </p>
</form>

<script>
function hideErrorMessage() {
    const errorMessage = document.getElementById('message');
    if (errorMessage && errorMessage.innerText.trim() !== "") {
        setTimeout(() => {
            errorMessage.innerHTML = '';
        }, 5000);
    }
}
hideErrorMessage();
</script>

</body>
</html>

