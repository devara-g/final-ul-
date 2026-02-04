<?php
require_once __DIR__ . '/config.php';
$pageTitle = 'Kontak';
$currentPage = 'contact';
include __DIR__ . '/header.php';
?>

<main class="container section">
    <header class="section-header" data-aos="fade-up">
        <p class="tag">Hubungi Kami</p>
        <h1>Terhubung dengan SMP PGRI 3 Bogor</h1>
        <p>Tim kami siap menjawab pertanyaan kerjasama, kunjungan sekolah, dan informasi lainnya.</p>
    </header>

    <div class="contact-wrapper">
        <form class="card contact-form" data-aos="fade-up">
            <div class="grid grid-2">
                <input type="text" placeholder="Nama Lengkap" required>
                <input type="email" placeholder="Email" required>
            </div>
            <input type="text" placeholder="Subjek Pesan" required>
            <textarea placeholder="Tulis pesan Anda" required></textarea>
            <!-- TODO: Submit form data to backend handler -->
            <button type="submit" class="btn btn-primary">Kirim Pesan</button>
        </form>

        <div class="card" data-aos="fade-up">
            <h3>Informasi Kontak</h3>
            <p><i class='bx bx-map'></i> <?php echo $contactInfo['address']; ?></p>
            <p><i class='bx bx-phone'></i> <?php echo $contactInfo['phone']; ?></p>
            <p><i class='bx bx-envelope'></i> <?php echo $contactInfo['email']; ?></p>
            <div class="social-links" style="margin-top:1rem;">
                <a href="<?php echo $contactInfo['instagram']; ?>" target="_blank" aria-label="Instagram">
                    <i class='bx bxl-instagram'></i>
                </a>
                <a href="<?php echo $contactInfo['facebook']; ?>" target="_blank" aria-label="Facebook">
                    <i class='bx bxl-facebook'></i>
                </a>
                <a href="<?php echo $contactInfo['youtube']; ?>" target="_blank" aria-label="YouTube">
                    <i class='bx bxl-youtube'></i>
                </a>
            </div>
        </div>
    </div>

    <section class="section map-embed" data-aos="fade-up">
        <iframe
            title="Lokasi SMP PGRI 3 Bogor"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.123456789!2d106.808!3d-6.597!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sBogor!5e0!3m2!1sid!2sid!4v1700000000000"
            height="360"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>
