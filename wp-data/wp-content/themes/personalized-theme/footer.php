<?php
/** Footer template */
?>
<footer class="site-footer">
    <div class="footer-wrapper">
        <!-- Bloc 1 : Logo -->
        <div class="footer-col logo-col">
            <span class="footer-logo">ESGI<span class="dot">.</span></span>
        </div>
        <!-- Bloc 2 : Manager & CEO -->
        <div class="footer-col contacts-col">
            <div class="contact-box">
                <h4>Manager</h4>
                <p>+33 1 53 31 25 23</p>
                <p><a href="mailto:info@esgi.com">info@esgi.com</a></p>
            </div>
            <div class="contact-box">
                <h4>CEO</h4>
                <p>+33 1 53 31 25 25</p>
                <p><a href="mailto:ceo@company.com">ceo@company.com</a></p>
            </div>
        </div>
        <!-- Bloc 3 : Réseaux sociaux -->
        <div class="footer-col socials-col">
            <div class="social-icon">
                <a href="https://linkedin.com" target="_blank" aria-label="LinkedIn">
                    <?php echo tp_getIcon('linkedin'); ?>
                </a>
            </div>
            <div class="social-icon">
                <a href="https://facebook.com" target="_blank" aria-label="Facebook">
                    <?php echo tp_getIcon('facebook'); ?>
                </a>
            </div>
        </div>
    </div>
    <!-- Mention -->
    <div class="footer-bottom">
        <p>2022 Figma Template by ESGI</p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>