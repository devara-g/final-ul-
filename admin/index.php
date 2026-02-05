<?php
session_start();
// Cek sesi login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../login.php");
    exit;
}

include '../config.php';
if (file_exists('conn.php')) {
    include 'conn.php';
} elseif (file_exists('../database/koneksi.php')) {
    include '../database/koneksi.php';
} else {
    $conn = mysqli_connect("localhost", "root", "", "p3");
}

$pageTitle = 'Dashboard Overview';
$currentPage = 'dashboard';
$isAdminPage = true;
$bodyClass = 'admin-body';

// --- FETCH SUMMARY STATS ---
$stats = [
    'berita' => 0,
    'galeri' => 0,
    'kalender' => 0,
    'pesan' => 0
];

if (isset($conn)) {
    $q1 = mysqli_query($conn, "SELECT COUNT(*) as count FROM berita");
    if ($q1) $stats['berita'] = mysqli_fetch_assoc($q1)['count'];

    $q2 = mysqli_query($conn, "SELECT COUNT(*) as count FROM galeri");
    if ($q2) $stats['galeri'] = mysqli_fetch_assoc($q2)['count'];

    $q3 = mysqli_query($conn, "SELECT COUNT(*) as count FROM kalender_acara");
    if ($q3) $stats['kalender'] = mysqli_fetch_assoc($q3)['count'];

    $q4 = mysqli_query($conn, "SELECT COUNT(*) as count FROM pesan");
    if ($q4) $stats['pesan'] = mysqli_fetch_assoc($q4)['count'];
}

include 'header.php';
?>

<main class="admin-dashboard">
    <?php include 'sidebar.php'; ?>

    <section class="admin-content">
        <div class="admin-header">
            <div>
                <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['admin_name'] ?? 'Admin'); ?>!</h1>
                <p class="muted">Ringkasan aktivitas website Anda.</p>
            </div>
            <span class="status-badge"><i class='bx bx-check-circle'></i> Sistem Aktif</span>
        </div>

        <div class="grid grid-2" style="grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem;">
            <!-- Stat Card: Berita -->
            <div class="card" style="display:flex; align-items:center; gap:1rem;">
                <div style="background:#e8f0fe; padding:15px; border-radius:50%; color:#1a73e8;">
                    <i class='bx bx-news' style="font-size:2rem;"></i>
                </div>
                <div>
                    <h3 style="margin:0; font-size:2rem;"><?php echo $stats['berita']; ?></h3>
                    <p class="muted" style="margin:0;">Artikel Berita</p>
                    <a href="berita.php" style="font-size:0.85rem; text-decoration:none;">Kelola &rarr;</a>
                </div>
            </div>

            <!-- Stat Card: Galeri -->
            <div class="card" style="display:flex; align-items:center; gap:1rem;">
                <div style="background:#e6f4ea; padding:15px; border-radius:50%; color:#1e8e3e;">
                    <i class='bx bx-images' style="font-size:2rem;"></i>
                </div>
                <div>
                    <h3 style="margin:0; font-size:2rem;"><?php echo $stats['galeri']; ?></h3>
                    <p class="muted" style="margin:0;">Foto Galeri</p>
                    <a href="galeri.php" style="font-size:0.85rem; text-decoration:none;">Kelola &rarr;</a>
                </div>
            </div>

            <!-- Stat Card: Agenda -->
            <div class="card" style="display:flex; align-items:center; gap:1rem;">
                <div style="background:#fce8e6; padding:15px; border-radius:50%; color:#d93025;">
                    <i class='bx bx-calendar-event' style="font-size:2rem;"></i>
                </div>
                <div>
                    <h3 style="margin:0; font-size:2rem;"><?php echo $stats['kalender']; ?></h3>
                    <p class="muted" style="margin:0;">Agenda Kegiatan</p>
                    <a href="kalender.php" style="font-size:0.85rem; text-decoration:none;">Kelola &rarr;</a>
                </div>
            </div>

            <!-- Stat Card: Pesan -->
            <div class="card" style="display:flex; align-items:center; gap:1rem;">
                <div style="background:#fff7e0; padding:15px; border-radius:50%; color:#f9ab00;">
                    <i class='bx bx-message-detail' style="font-size:2rem;"></i>
                </div>
                <div>
                    <h3 style="margin:0; font-size:2rem;"><?php echo $stats['pesan']; ?></h3>
                    <p class="muted" style="margin:0;">Pesan Masuk</p>
                    <a href="pesan.php" style="font-size:0.85rem; text-decoration:none;">Lihat pesan &rarr;</a>
                </div>
            </div>
        </div>

        <div class="card" style="margin-top:2rem;">
            <h3>Quick Links</h3>
            <div style="display:flex; gap:1rem; flex-wrap:wrap;">
                <a href="../index.php" target="_blank" class="btn btn-secondary"><i class='bx bx-link-external'></i> Lihat Website Utama</a>
                <a href="../logout.php" class="btn btn-danger"><i class='bx bx-log-out'></i> Logout</a>
            </div>
        </div>

    </section>
</main>

<?php include 'footer.php'; ?>