<?php
/**
 * MODULAR FOOTER - Include di setiap halaman via include __DIR__ . '/footer.php'
 * Variabel opsional: $isAdminPage (hide CTA/footer untuk admin), $additionalScripts (array)
 */
if (!isset($siteTitle)) {
    include 'config.php';
}
?>
<?php if (empty($isAdminPage)) : ?>
    <section class="cta-subscribe" data-aos="fade-up">
        <div class="container">
            <h2>Tetap Terhubung dengan <?php echo $siteTitle; ?></h2>
            <p>Dapatkan informasi terbaru mengenai kegiatan dan prestasi siswa kami.</p>
            <form class="subscribe-form">
                <input type="email" placeholder="Masukkan email Anda" aria-label="Email untuk newsletter">
                <button type="submit" class="btn btn-primary">Berlangganan</button>
            </form>
        </div>
    </section>
    <footer class="site-footer">
        <div class="container footer-grid">
            <div>
                <h3><?php echo $siteTitle; ?></h3>
                <p><?php echo $siteTagline; ?></p>
            </div>
            <div>
                <h4>Kontak</h4>
                <ul>
                    <li><i class='bx bx-map'></i> <?php echo $contactInfo['address']; ?></li>
                    <li><i class='bx bx-phone'></i> <?php echo $contactInfo['phone']; ?></li>
                    <li><i class='bx bx-envelope'></i> <?php echo $contactInfo['email']; ?></li>
                </ul>
            </div>
            <div>
                <h4>Ikuti Kami</h4>
                <div class="social-links">
                    <a href="<?php echo $contactInfo['instagram']; ?>" target="_blank" rel="noreferrer" aria-label="Instagram">
                        <i class='bx bxl-instagram'></i>
                    </a>
                    <a href="<?php echo $contactInfo['facebook']; ?>" target="_blank" rel="noreferrer" aria-label="Facebook">
                        <i class='bx bxl-facebook'></i>
                    </a>
                    <a href="<?php echo $contactInfo['youtube']; ?>" target="_blank" rel="noreferrer" aria-label="YouTube">
                        <i class='bx bxl-youtube'></i>
                    </a>
                </div>
            </div>
        </div>
        <p class="copyright">© <?php echo date('Y'); ?> <?php echo $siteTitle; ?>. All rights reserved.</p>
    </footer>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<?php if (empty($isAdminPage)) : ?>
<script src="assets/js/main.js"></script>
<?php endif; ?>
<?php
if (!empty($additionalScripts)) {
    foreach ($additionalScripts as $script) {
        echo "<script src=\"{$script}\"></script>";
    }
}
?>
</body>
</html>
