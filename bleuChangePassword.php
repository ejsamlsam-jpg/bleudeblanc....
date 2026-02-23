<?php
// bleuChangePassword.php - Dedicated change password page
session_start();
include "bleuConnection.php";

if (!isset($_SESSION['username'])) {
    header("Location: bleuLogin.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Sanitize inputs
    $current_password = trim($current_password);
    $new_password = trim($new_password);
    $confirm_password = trim($confirm_password);

    // Validation
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $error = 'All fields are required.';
    } elseif ($new_password !== $confirm_password) {
        $error = 'New passwords do not match.';
    } elseif (strlen($new_password) < 8) {
        $error = 'New password must be at least 8 characters.';
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/', $new_password)) {
        $error = 'Password must contain uppercase, lowercase, and number.';
    } else {
        // Verify current password
        $stmt = $bleuConn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($current_password, $user['password'])) {
            // Update password with bcrypt
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_stmt = $bleuConn->prepare("UPDATE users SET password = ? WHERE username = ?");
            $update_stmt->bind_param("ss", $hashed_password, $_SESSION['username']);
            
            if ($update_stmt->execute()) {
                $success = 'Password changed successfully! Please login again.';
                // Log user out for security
                session_destroy();
            } else {
                $error = 'Failed to update password. Please try again.';
            }
        } else {
            $error = 'Current password is incorrect.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password - Bleu de Blanc</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-gold: #D4AF37;
            --dark-gold: #B8962E;
            --black: #000000;
            --off-white: #F8F4F0;
            --light-gray: #E8E2D9;
            --white: #FFFFFF;
            --shadow-soft: 0 20px 60px rgba(0,0,0,0.15);
            --shadow-hover: 0 30px 80px rgba(0,0,0,0.25);
            --error-red: #E53E3E;
            --success-green: #38A169;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--off-white) 0%, var(--light-gray) 100%);
            min-height: 100vh;
            color: var(--black);
            overflow-x: hidden;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            z-index: 1000;
            padding: 1rem 5%;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--black);
            text-decoration: none;
            letter-spacing: 2px;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--black);
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--primary-gold);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-gold);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .main-container {
            margin-top: 100px;
            padding: 2rem 5%;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        .password-hero {
            text-align: center;
            margin-bottom: 4rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .password-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--black);
        }

        .password-subtitle {
            color: #666;
            font-size: 1.1rem;
        }

        .password-container {
            background: var(--white);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(212, 175, 55, 0.1);
            max-width: 500px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
        }

        .password-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-gold), var(--dark-gold));
        }

        .message {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .error-message {
            background: #fed7d7;
            color: var(--error-red);
            border: 1px solid #feb2b2;
            display: <?php echo $error ? 'flex' : 'none'; ?>;
        }

        .success-message {
            background: #c6f6d5;
            color: var(--success-green);
            border: 1px solid #9ae6b4;
            display: <?php echo $success ? 'flex' : 'none'; ?>;
        }

        .form-group {
            margin-bottom: 2rem;
            position: relative;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.75rem;
            color: var(--black);
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

        .form-group input {
            width: 100%;
            padding: 1.25rem 1.5rem;
            border: 2px solid #e5e5e5;
            border-radius: 12px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-gold);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1);
        }

        .password-requirements {
            font-size: 0.85rem;
            color: #888;
            margin-top: 0.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2.5rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            flex: 1;
            min-width: 180px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--black), #333);
            color: var(--white);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .btn-secondary {
            background: transparent;
            color: var(--black);
            border: 2px solid #e5e5e5;
        }

        .btn-secondary:hover {
            background: var(--black);
            color: var(--white);
            border-color: var(--black);
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            .main-container {
                padding: 1rem;
                margin-top: 80px;
            }
            .password-container {
                padding: 2rem 1.5rem;
            }
            .password-hero h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

    <div class="main-container">
        <section class="password-hero">
            <h1><i class="fas fa-lock"></i> Change Password</h1>
            <p class="password-subtitle">Securely update your account password</p>
        </section>

        <div class="password-container">
            <?php if ($error): ?>
                <div class="message error-message">
                    <i class="fas fa-exclamation-triangle"></i> 
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="message success-message">
                    <i class="fas fa-check-circle"></i> 
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <?php if (!$success): ?>
            <form method="POST" id="passwordForm">
                <div class="form-group">
                    <label for="current_password"><i class="fas fa-key"></i> Current Password</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>

                <div class="form-group">
                    <label for="new_password"><i class="fas fa-lock-open"></i> New Password</label>
                    <input type="password" id="new_password" name="new_password" required minlength="8">
                    <div class="password-requirements">
                        • At least 8 characters long
                        • Use uppercase, lowercase, numbers & symbols for strength
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm_password"><i class="fas fa-check-double"></i> Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sync-alt"></i> Update Password
                    </button>
                    <a href="bleuProfile.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Profile
                    </a>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Real-time password validation
        const newPassInput = document.getElementById('new_password');
        const confirmPassInput = document.getElementById('confirm_password');
        
        newPassInput.addEventListener('input', validatePassword);
        confirmPassInput.addEventListener('input', validatePassword);

        function validatePassword() {
            const newPass = newPassInput.value;
            const confirmPass = confirmPassInput.value;
            
            if (confirmPass && newPass !== confirmPass) {
                confirmPassInput.style.borderColor = '#E53E3E';
            } else {
                confirmPassInput.style.borderColor = '#e5e5e5';
            }
        }

        // Form submission validation
        document.getElementById('passwordForm').addEventListener('submit', function(e) {
            const newPass = newPassInput.value;
            const confirmPass = confirmPassInput.value;
            
            if (newPass !== confirmPass) {
                e.preventDefault();
                alert('New passwords do not match!');
                return false;
            }
            
            if (newPass.length < 8) {
                e.preventDefault();
                alert('Password must be at least 8 characters!');
                return false;
            }
        });
    </script>
</body>
</html>
