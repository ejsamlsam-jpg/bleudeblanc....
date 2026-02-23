
<?php
// Add this right after <h2 class="form-title">Account Details</h2>
$message_type = $_GET['message_type'] ?? '';
$message_text = urldecode($_GET['message_text'] ?? '');
?>

<?php if ($message_type): ?>
<div class="message <?php echo $message_type; ?>-message" style="display: flex;">
    <?php if ($message_type === 'success'): ?>
        <i class="fas fa-check-circle"></i>
    <?php else: ?>
        <i class="fas fa-exclamation-triangle"></i>
    <?php endif; ?>
    <?php echo htmlspecialchars($message_text); ?>
</div>
<?php endif; ?>


<?php
session_start();
include "bleuConnection.php";

if (!isset($_SESSION['username'])) {
    header("Location: bleuLogin.php");
    exit();
}

$username = $_SESSION['username'];

$stmt = $bleuConn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Profile - Bleu de Blanc</title>
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

        .profile-hero {
            text-align: center;
            margin-bottom: 4rem;
            position: relative;
        }

        .profile-hero::before {
            content: '';
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, var(--primary-gold) 0%, transparent 70%);
            z-index: -1;
            border-radius: 50%;
            opacity: 0.1;
        }

        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold));
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--white);
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
        }

        .avatar:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-hover);
        }

        .profile-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--black), var(--primary-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .welcome-text {
            font-size: 1.2rem;
            color: #666;
            font-weight: 400;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 4rem;
            margin-bottom: 3rem;
        }

        .account-stats {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(212, 175, 55, 0.1);
            transition: all 0.3s ease;
        }

        .account-stats:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .stats-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            margin-bottom: 2rem;
            color: var(--black);
            text-align: center;
        }

        .stat-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: rgba(212, 175, 55, 0.05);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            background: rgba(212, 175, 55, 0.1);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.2rem;
            margin-right: 1rem;
        }

        .stat-text h3 {
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }

        .stat-text p {
            color: #888;
            font-size: 0.95rem;
        }

        .profile-form-container {
            background: var(--white);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: var(--shadow-soft);
            border: 1px solid rgba(212, 175, 55, 0.1);
            position: relative;
            overflow: hidden;
        }

        .profile-form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-gold), var(--dark-gold));
        }

        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: var(--black);
            text-align: center;
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

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .save-section {
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

        .orders-section {
            margin-top: 3rem;
        }

        .orders-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: var(--black);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #888;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .profile-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
            }

            .main-container {
                padding: 1rem;
                margin-top: 80px;
            }

            .profile-hero h1 {
                font-size: 2rem;
            }
        }

        .success-message {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            border: 1px solid #c3e6cb;
            display: none;
        }
    </style>
</head>
<body>

    <div class="main-container">
        <!-- Profile Hero Section -->
        <section class="profile-hero">
            <div class="avatar">
                <i class="fas fa-user"></i>
            </div>
            <h1>Welcome Back</h1>
            <p class="welcome-text">Manage your Bleu de Blanc account and preferences</p>
        </section>

        <div class="profile-grid">
            <!-- Account Stats Sidebar -->
            <aside class="account-stats">
                <h3 class="stats-title">Your Journey</h3>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="stat-text">
                        <h3>Member Since</h3>
                        <p><?php echo date('M Y', strtotime($user['created_at'] ?? 'now')); ?></p>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-spray-can"></i>
                    </div>
                    <div class="stat-text">
                        <h3>Perfumes Saved</h3>
                        <p>Explore our collection</p>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <div class="stat-text">
                        <h3>Next Day Delivery</h3>
                        <p>Free on orders ₱5,000+</p>
                    </div>
                </div>
            </aside>

            <!-- Profile Form -->
            <div class="profile-form-container">
                <h2 class="form-title">Account Details</h2>
                
                <?php if (isset($_GET['success'])): ?>
                <div class="success-message" style="display: block;">
                    <i class="fas fa-check-circle"></i> Profile updated successfully!
                </div>
                <?php endif; ?>

                <form method="POST" action="bleuUpdateProfile.php">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="username"><i class="fas fa-user"></i> Username</label>
                            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact"><i class="fas fa-phone"></i> Contact Number</label>
                            <input type="tel" id="contact" name="contact" value="<?php echo htmlspecialchars($user['contact'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="birthday"><i class="fas fa-birthday-cake"></i> Birthday (Optional)</label>
                            <input type="date" id="birthday" name="birthday" value="<?php echo htmlspecialchars($user['birthday'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address"><i class="fas fa-map-marker-alt"></i> Delivery Address</label>
                        <input type="text" id="address" name="address" placeholder="House number, Street, Barangay, City, Province" value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>" style="height: 120px; resize: vertical;">
                    </div>

                    <div class="save-section">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                        <a href="bleuChangePassword.php" class="btn btn-secondary">
                            <i class="fas fa-lock"></i>
                            Change Password
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Recent Orders Section -->
        <section class="orders-section">
            <h2 class="orders-title">Recent Orders</h2>
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <h3>No orders yet</h3>
                <p>Discover our luxury collection and make your first purchase</p>
                <a href="products.php" class="btn btn-primary" style="margin-top: 1rem;">Shop Collection</a>
            </div>
        </section>
    </div>
</body>
</html>
