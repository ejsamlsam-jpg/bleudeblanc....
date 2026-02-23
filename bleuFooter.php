<footer class="footer">
  <div class="footer-container">
    <div class="footer-brand">
      <h2>Bleu De Blanc</h2>
      <p>Crafting affordable luxury fragrances from the heart of the Philippines</p>
    </div>
    <div class="footer-contact">
      <h3>Contact</h3>
      <p>Email: <a href="mailto:bleudeblanc@gmail.com">bleudeblanc@gmail.com</a></p>
      <p>Number: <a href="mailto:bleudeblanc@gmail.com"></a>09123456789</p>
  </div>
  <div class="footer-bottom">
    <p>© 2026 Bleu De Blanc. All rights reserved.</p>
  </div>
</footer>

<style>

.footer {
    font-family: "Georgia", serif;
    background: linear-gradient(135deg, #ffffff 0%, #e8e2d9 100%);
    color: #333;
    padding: auto;
    margin-top: auto;
}

.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 40px;
    max-width: 1200px;
    margin: 0 auto 30px;
}

.footer h2 {
    font-size: 1.8rem;
    margin: 0 0 10px 0;
    color: #000;
}

.footer h3 {
    margin: 0 0 15px 0;
    font-size: 1.1rem;
    color: #000;
    font-weight: 600;
}

.footer p, .footer a {
    font-size: 0.95rem;
    line-height: 1.5;
    color: #333;
    text-decoration: none;
}

.footer p a:hover {
    text-decoration: underline;
}
.footer-contact p {
    margin: 0 0 10px 0;
}

.social-icons {
    display: flex;
    gap: 12px;
}

.social-icons a img {
    width: 28px;
    height: 28px;
    transition: transform 0.2s ease;
}

.social-icons a:hover img {
    transform: scale(1.1);
}

.footer-bottom {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid #ddd;
    font-size: 0.85rem;
    color: #666;
    margin-top: 20px;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        gap: 30px;
        text-align: center;
    }
    
    .footer h2 {
        font-size: 1.5rem;
    }
    
    .social-icons {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .footer {
        padding: 30px 15px 15px;
    }
    
    .footer-container {
        gap: 25px;
    }
}
</style>
