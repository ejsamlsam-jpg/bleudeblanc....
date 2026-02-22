<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bleuStyle_1.css">
    <title>Bleu de Blanc - Client Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
        }
        
        body {
            margin: 0;
            padding: 0;
            font-family: "Georgia", serif;
            background: linear-gradient(135deg, #f8f4f0 0%, #e8e2d9 100%);
            color: #000;
            min-height: 100vh;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 1rem 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 700;
            color: #000000;
            letter-spacing: 1px;
        }
        
        .logo {
            height: 80px;
            width: auto;
            border-radius: 6px;
        }
        
        .brand-text {
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        
        .nav-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 1.5rem;
            align-items: center;
        }
        
        .nav-link {
            color: #000000;
            text-decoration: none;
            font-size: 1.1rem;
            letter-spacing: 1.5px;
            padding: 0.8rem 1.5rem;
            border: 1px solid transparent;
            border-radius: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: "Georgia", serif;
            position: relative;
            text-transform: uppercase;
            font-weight: 500;
        }
        
        .nav-link:hover,
        .nav-link.active {
            color: #000000;
            background: rgba(0, 0, 0, 0.15);
            border-color: rgba(0, 0, 0, 0.3);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }
        
        .logout-btn {
            background: #5e5a5a;
            color: #d8d8d8;
            border: 1px solid #000;
            padding: 0.9rem 2rem;
            border-radius: 8px;
            font-family: "Georgia", serif;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }
        
        .logout-btn:hover {
            background: #000;
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.4);
        }
        
        .main-content {
            min-height: 80vh;
            padding: 4rem 2rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 2rem;
        }
        
        .welcome-section {
            max-width: 800px;
            background: rgba(255, 255, 255, 0.9);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .welcome-section h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #000 0%, #333 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
            letter-spacing: 2px;
        }
        
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }
            
            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-brand {
                font-size: 1.3rem;
            }
            
            .logo {
                height: 35px;
            }
            
            .nav-menu {
                flex-wrap: wrap;
                gap: 1rem;
                justify-content: center;
            }
            
            .nav-link {
                padding: 0.7rem 1.2rem;
                font-size: 1rem;
            }
            
            .main-content {
                padding: 2rem 1rem;
            }
            
            .welcome-section {
                padding: 2rem 1.5rem;
                margin: 0 1rem;
            }
            
            .welcome-section h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar with Logo -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="nav-brand">
                <img src="logo.jpg" alt="Bleu de Blanc Logo" class="logo">
                <span class="brand-text">Bleu de Blanc</span>
            </a>
            
            <ul class="nav-menu" id="navMenu">
                <li><a href="bleuClientProduct.php" class="nav-link" data-page="product" target="column">Products</a></li>
                <li><a href="bleuClientViewOrders.php" class="nav-link" data-page="orders" target="column">Cart</a></li>
                <li><a href="bleuClientViewOrders.php" class="nav-link" data-page="checkout" target="column">Checkout</a></li>
                <li><a href="bleuClientViewOrders.php" class="nav-link" data-page="profile" target="column">Profile</a></li>
                <li><a href="bleuClientViewOrders.php" class="nav-link" data-page="about" target="column">About</a></li>
                <li><a href="bleuLogout.php" class="logout-btn" id="logoutLink" target="_parent">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Standard Website Content Area -->
    <main class="main-content">
        <div class="welcome-section">
            <h1>Welcome to Bleu de Blanc</h1>
            <p>Your luxury perfume dashboard. Explore our collections, manage your cart, and discover exquisite fragrances crafted for elegance.</p>
        </div>
    </main>

    <script>
document.getElementById("logoutLink").addEventListener("click", function (event) {
    if (!confirm("Are you sure you want to log out?")) {
        event.preventDefault();
    }
});
</script>
</body>
</html>
