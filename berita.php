<?php
require_once __DIR__ . '/config.php';
$pageTitle = 'Berita Sekolah';
$currentPage = 'news';
include __DIR__ . '/header.php';
?>

<main class="container section">
    <header class="section-header" data-aos="fade-up">
        <p class="tag">Kabari Orang Tua</p>
        <h1>Berita dan Artikel Terbaru</h1>
        <p>Ikuti perkembangan kegiatan, pengumuman penting, dan prestasi siswa.</p>
    </header>

    <div class="news-list" data-aos="fade-up">
        <?php foreach ($newsPosts as $post) : ?>
            <article class="card news-card">
                <img src="<?php echo $post['thumbnail']; ?>" alt="<?php echo $post['title']; ?>">
                <div>
                    <small><?php echo $post['date']; ?></small>
                    <h3><?php echo $post['title']; ?></h3>
                    <p><?php echo $post['excerpt']; ?></p>
                    <a class="btn-link" href="berita-detail.php?id=<?php echo $post['id']; ?>">Baca selengkapnya →</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

    <p class="muted">
        <!-- TODO: Backend - SELECT * FROM berita ORDER BY created_at DESC LIMIT x OFFSET y (pagination) -->
        Data berita akan diambil dari tabel berita saat backend terhubung database.
    </p>
</main>

<?php include __DIR__ . '/footer.php'; ?>
