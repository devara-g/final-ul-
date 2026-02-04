<?php
require_once __DIR__ . '/config.php';
$pageTitle = 'Galeri';
$currentPage = 'gallery';
include __DIR__ . '/header.php';
?>

<main class="container section">
    <div class="section-header" data-aos="fade-up">
        <p class="tag">Memori Sekolah</p>
        <h1>Galeri Kegiatan dan Fasilitas</h1>
        <p>Dokumentasi kegiatan terbaru dan fasilitas unggulan <?php echo $siteTitle; ?>.</p>
    </div>

    <div class="gallery-filters" data-aos="fade-up">
        <?php foreach ($galleryFilters as $key => $label) : ?>
            <button class="filter-btn <?php echo $key === 'semua' ? 'active' : ''; ?>"
                    data-filter="<?php echo $key; ?>">
                <?php echo $label; ?>
            </button>
        <?php endforeach; ?>
    </div>

    <div class="gallery-grid" data-aos="fade-up">
        <?php foreach ($galleryItems as $item) : ?>
            <figure class="gallery-item" data-category="<?php echo $item['category']; ?>">
                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                <span><?php echo $galleryFilters[$item['category']] ?? 'Kegiatan'; ?></span>
            </figure>
        <?php endforeach; ?>
    </div>

    <p class="muted" style="margin-top:1.5rem;">
        <!-- TODO: Backend - SELECT * FROM galeri JOIN album WHERE ... ORDER BY created_at -->
        Konten galeri akan otomatis memperbarui saat terhubung dengan database.
    </p>
</main>

<?php include __DIR__ . '/footer.php'; ?>
