<?php
require_once __DIR__ . '/config.php';
// Include connection specifically if config didn't catch it seamlessly (redundancy check)
if (!isset($conn)) {
    if (file_exists(__DIR__ . '/database/koneksi.php')) include __DIR__ . '/database/koneksi.php';
    else $conn = mysqli_connect("localhost", "root", "", "p3");
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }
}

$pageTitle = 'Kontak';
$currentPage = 'contact';

$statusMsg = '';
$statusType = '';

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $query = "INSERT INTO pesan (name, email, subject, message, created_at) VALUES ('$name', '$email', '$subject', '$message', NOW())";

    if (mysqli_query($conn, $query)) {
        $statusMsg = "Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.";
        $statusType = "success";
    } else {
        $statusMsg = "Maaf, terjadi kesalahan saat mengirim pesan. Silakan coba lagi.";
        $statusType = "error";
    }
}

include __DIR__ . '/header.php';
?>

<main class="container section">
    <header class="section-header" data-aos="fade-up">
        <p class="tag">Hubungi Kami</p>
        <h1>Terhubung dengan SMP PGRI 3 Bogor</h1>
        <p>Tim kami siap menjawab pertanyaan kerjasama, kunjungan sekolah, dan informasi lainnya.</p>
    </header>

    <div class="contact-wrapper">
        <div class="card contact-form" data-aos="fade-up">
            <?php if (!empty($statusMsg)) : ?>
                <div class="alert alert-<?php echo $statusType === 'success' ? 'success' : 'danger'; ?>"
                    style="padding:1rem; margin-bottom:1rem; border-radius:8px; 
                            background-color: <?php echo $statusType === 'success' ? '#d1e7dd' : '#f8d7da'; ?>; 
                            color: <?php echo $statusType === 'success' ? '#0f5132' : '#842029'; ?>;">
                    <?php echo $statusMsg; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="contact-form-inner">
                <div class="form-group grid grid-2">
                    <label class="form-control-wrapper">
                        <span>Nama Lengkap*</span>
                        <input type="text" name="name" placeholder="John Doe" required>
                    </label>
                    <label class="form-control-wrapper">
                        <span>Email*</span>
                        <input type="email" name="email" placeholder="email@contoh.com" required>
                    </label>
                </div>
                <label class="form-control-wrapper">
                    <span>Subjek Pesan*</span>
                    <input type="text" name="subject" placeholder="Perihal kerjasama/pertanyaan" required>
                </label>
                <label class="form-control-wrapper">
                    <span>Isi Pesan*</span>
                    <textarea name="message" placeholder="Tuliskan pesan Anda secara detail..." rows="6" required></textarea>
                </label>
                <button type="submit" class="btn btn-primary btn-block">Kirim Pesan</button>
            </form>
        </div>

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