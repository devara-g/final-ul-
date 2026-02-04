<?php
/**
 * Halaman Detail Berita
 * TODO: Backend - SELECT * FROM berita WHERE id = ? (ganti array $newsPosts dengan query)
 */
require_once __DIR__ . '/config.php';
$pageTitle = 'Detail Berita';
$currentPage = 'news';
$articleId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$article = $newsPosts[0];
foreach ($newsPosts as $post) {
    if ($post['id'] === $articleId) {
        $article = $post;
        break;
    }
}
include __DIR__ . '/header.php';
?>

<main class="container section news-detail">
    <header data-aos="fade-up">
        <p class="tag">Berita Sekolah</p>
        <h1><?php echo $article['title']; ?></h1>
        <p class="muted"><?php echo $article['date']; ?> · Redaksi SMP PGRI 3 Bogor</p>
    </header>

    <img src="<?php echo $article['thumbnail']; ?>" alt="<?php echo $article['title']; ?>" data-aos="fade-up">

    <article class="card" data-aos="fade-up">
        <p>
            <!-- TODO: Replace static content with content fetched from database -->
            <?php echo $article['excerpt']; ?> Artikel lengkap akan dimuat dari konten rich text yang disimpan di database.
            Bagian ini bisa terdiri dari beberapa paragraf, kutipan, serta dokumentasi tambahan terkait kegiatan.
        </p>
        <p>
            Integrasikan modul ini dengan editor WYSIWYG pada dashboard admin agar tim humas dapat mengunggah berita dalam format yang rapi.
        </p>
    </article>

    <section class="section" data-aos="fade-up">
        <div class="section-header">
            <p class="tag">Berita Lainnya</p>
            <h3>Artikel yang mungkin Anda lewatkan</h3>
        </div>
        <div class="grid grid-3">
            <?php foreach ($newsPosts as $post) : ?>
                <article class="card">
                    <small><?php echo $post['date']; ?></small>
                    <h4><?php echo $post['title']; ?></h4>
                    <a href="berita-detail.php?id=<?php echo $post['id']; ?>" class="btn-link">Baca</a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>
