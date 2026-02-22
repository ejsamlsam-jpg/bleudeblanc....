<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Bleu de Blanc</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: "Georgia", serif;
            background: linear-gradient(135deg, #f8f4f0 0%, #e8e2d9 100%);
            color: #000;
            line-height: 1.7;
            overflow-x: hidden;
        }

        /* Scrollable Main Container */
        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            height: 100vh;
            overflow-y: auto;
            scroll-behavior: smooth;
            scrollbar-width: thin;
            scrollbar-color: rgba(0,0,0,0.3) transparent;
        }

        /* Custom Scrollbar for Webkit */
        .about-container::-webkit-scrollbar {
            width: 8px;
        }

        .about-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .about-container::-webkit-scrollbar-thumb {
            background: rgba(0,0,0,0.3);
            border-radius: 4px;
        }

        /* Hero Section */
        .about-hero {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.4));
            background-size: cover;
            background-position: center;
            padding: 4rem 2rem;
            text-align: center;
            color: white;
            border-radius: 20px;
            margin-bottom: 3rem;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            letter-spacing: 3px;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            opacity: 0.95;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Content Sections */
        .section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            margin-bottom: 5rem;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease forwards;
        }
        
        .section:nth-child(odd) {
            animation-delay: 0.1s;
        }
        
        .section:nth-child(even) {
            grid-template-columns: 1fr 1fr;
            text-align: right;
        }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-content h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #000 0%, #333 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
            letter-spacing: 1px;
        }
        
        .section-content p {
            font-size: 1.2rem;
            color: #333;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .logo-display {
            width: 100%;
            max-width: 400px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }

        /* Stats Grid */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
            margin: 4rem 0;
        }
        
        .stat-item {
            text-align: center;
            padding: 2.5rem 1.5rem;
            background: rgba(255,255,255,0.9);
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.5);
            transition: transform 0.3s ease;
        }
        
        .stat-item:hover {
            transform: translateY(-10px);
        }
        
        .stat-number {
            font-size: 3.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #000 0%, #333 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .cta-section {
            text-align: center;
            padding: 4rem 2rem;
            background: rgba(0,0,0,0.05);
            border-radius: 20px;
            margin-top: 3rem;
        }

        .cta-button {
            display: inline-block;
            background: #000;
            color: #fff;
            padding: 1.2rem 3rem;
            border-radius: 50px;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: 500;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .cta-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        @media (max-width: 768px) {
            .about-container {
                padding: 1rem;
                height: 100vh;
            }
            
            .hero-title {
                font-size: 2.2rem;
            }
            
            .section {
                grid-template-columns: 1fr;
                gap: 2rem;
                text-align: center;
            }
            
            .section:nth-child(even) {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .about-hero {
                padding: 3rem 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="about-container">
        <!-- Hero -->
        <section class="about-hero">
            <h1 class="hero-title">Our Story</h1>
            <p class="hero-subtitle">Crafting affordable luxury fragrances from the heart of the Philippines</p>
        </section>

        <!-- Story Sections -->
        <section class="section">
            <div class="section-content">
                <h2>Born from Passion</h2>
                <p>Bleu de Blanc was founded in Apalit, Central Luzon, with a simple mission: to bring the elegance of high-end perfumes to everyone. We believe luxury shouldn't come with an exorbitant price tag.</p>
                <p>Using premium imported materials and expert blending techniques, we create long-lasting impressions that rival designer fragrances – at prices that make luxury accessible.</p>
            </div>
            <img src="pic2.jpg" alt="Bleu de Blanc Crafting" class="logo-display">
        </section>

        <!-- Stats -->
        <section class="section">
            <div class="section-content">
                <h2>Our Craftsmanship</h2>
                <div class="stats">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <p>Authentic Ingredients</p>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">24+</div>
                        <p>Fragrances</p>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">1000+</div>
                        <p>Happy Customers</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission -->
        <section class="section">
            <div class="section-content">
                <h2>Why Bleu de Blanc?</h2>
                <p>Every bottle tells a story of craftsmanship, quality, and accessibility. From our family workshop in Apalit to your collection, we pour passion into every spritz.</p>
                <p>We're more than a perfume brand – we're your partner in unforgettable impressions. Discover fragrances that speak to your soul.</p>
            </div>
            <img src="pic1.jpg" alt="Bleu de Blanc Bottle" class="logo-display">
        </section>

        <!-- CTA -->
        <section class="cta-section">
            <h2>Experience Bleu de Blanc</h2>
            <p>Discover our collection of exquisite fragrances</p>
            <a href="bleuClientProduct.php" class="cta-button" target="column">Shop Now</a>
        </section>
    </div>
</body>
</html>
