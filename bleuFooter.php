<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bleu De Blanc</title>

<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: "Georgia", serif;
    background: linear-gradient(135deg, #111, #000);
    color: white;
    min-height: 100vh;
    display: grid;
    grid-template-rows: 1fr auto;
}

.main {
    padding: 20px 15px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
}

h1 {
    font-size: clamp(1.5rem, 4vw, 2rem);
    margin-bottom: 15px;
}

.tagline {
    font-size: 0.9rem;
    color: #ccc;
    margin-bottom: 25px;
    opacity: 0.8;
}

.cta {
    background: rgba(255,255,255,0.1);
    color: white;
    padding: 8px 20px;
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 20px;
    text-decoration: none;
    font-size: 0.8rem;
    display: inline-block;
}

.footer {
    background: #000;
    padding: 15px;
    text-align: center;
    font-size: 0.75rem;
    color: #666;
    border-top: 1px solid #333;
}
</style>
</head>

<body>
    <main class="main">
        <h1>Bleu De Blanc</h1>
        <p class="tagline">bleudeblanc@gmail.com</p>
        <a href="#" class="cta">Shop</a>
    </main>

    <footer class="footer">© 2026 | info@bleudeblanc.com</footer>
</body>
</html>
