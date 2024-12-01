<style>
    /* Footer Container */
    footer {
        background-color: #202020;
        color: white;
        padding: 20px 10px;
        text-align: center;
    }

    /* Footer Content Styling */
    .footer-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Footer Links Section */
    .footer-links ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        gap: 20px;
    }

    .footer-links ul li {
        display: inline;
    }

    .footer-links ul li a {
        color: white;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s ease;
    }

    .footer-links ul li a:hover {
        color: #ff0000;
    }

    /* Footer Social Section */
    .footer-social {
        display: flex;
        gap: 15px;
    }

    .footer-social a {
        display: inline-block;
        width: 30px;
        height: 30px;
    }

    .footer-social img {
        width: 100%;
        height: auto;
        filter: brightness(0) invert(1);
        transition: transform 0.3s ease, filter 0.3s ease;
    }

    .footer-social img:hover {
        transform: scale(1.1);
        filter: brightness(0.8) invert(1);
    }

    /* Footer Bottom Section */
    .footer-bottom {
        margin-top: 20px;
        font-size: 12px;
        color: #ccc;
    }

    .footer-bottom p {
        margin: 0;
    }
</style>

<footer>
    <div class="footer-content">
        <div class="footer-links">
            <ul>
                <li><a href="about.php">About</a></li>
                <li><a href="terms.php">Terms of Service</a></li>
                <li><a href="privacy.php">Privacy Policy</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="footer-social">
            <a href="https://facebook.com" target="_blank" title="Facebook">
                <img src="images/facebook-icon.png" alt="Facebook">
            </a>
            <a href="https://twitter.com" target="_blank" title="Twitter">
                <img src="images/twitter-icon.png" alt="Twitter">
            </a>
            <a href="https://instagram.com" target="_blank" title="Instagram">
                <img src="images/instagram-icon.png" alt="Instagram">
            </a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> Share Vision. All rights reserved.</p>
    </div>
</footer>

<!-- Optional JavaScript -->
<script src="js/main.js"></script>
