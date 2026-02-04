<?php
require_once __DIR__ . '/config.php';
$pageTitle = 'Beranda';
$currentPage = 'home';
$heroSlides = [
    [
        'image' => 'https://picsum.photos/seed/pgri-hero1/1600/900',
        'title' => 'Sekolah Ramah Prestasi',
        'subtitle' => 'Mempersiapkan generasi unggul yang adaptif dan berkarakter.'
    ],
    [
        'image' => 'https://picsum.photos/seed/pgri-hero2/1600/900',
        'title' => 'Pembelajaran STEAM',
        'subtitle' => 'Laboratorium STEAM kami mendukung eksplorasi teknologi siswa.'
    ],
    [
        'image' => 'https://picsum.photos/seed/pgri-hero3/1600/900',
        'title' => 'Lingkungan Hijau',
        'subtitle' => 'Budaya sekolah peduli lingkungan dengan program Adiwiyata.'
    ]
];
include __DIR__ . '/header.php';
?>

<main id="beranda">
    <section class="container hero" data-aos="fade-up">
        <div class="hero-slider">
            <?php foreach ($heroSlides as $index => $slide) : ?>
                <div class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>"
                     style="background-image: url('<?php echo $slide['image']; ?>')">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="hero-content">
            <div class="hero-overlay">
                <p class="tag">Selamat datang di</p>
                <h1><?php echo $siteTitle; ?></h1>
                <p><?php echo $siteTagline; ?></p>
                <div class="hero-actions">
                    <a href="program.php" class="btn btn-primary">Lihat Program</a>
                    <a href="kontak.php" class="btn btn-outline">Kunjungi Kami</a>
                </div>
            </div>
        </div>
    </section>

    <section class="container section principal-welcome" data-aos="fade-up">
        <div class="principal-photo">
            <img src="https://picsum.photos/seed/pgri-headmaster/700/800" alt="Kepala Sekolah SMP PGRI 3 Bogor">
        </div>
        <div>
            <p class="tag">Sambutan Kepala Sekolah</p>
            <h2>Menumbuhkan Semangat Belajar dan Kreativitas</h2>
            <p>
                Selamat datang di portal resmi <?php echo $siteTitle; ?>. Kami percaya bahwa setiap siswa memiliki potensi besar.
                Melalui pembelajaran kontekstual, teknologi digital, dan pendampingan karakter, kami membimbing siswa menjadi pribadi
                yang tangguh, peduli lingkungan, dan siap menghadapi tantangan masa depan.
            </p>
            <p class="muted">- Dra. Lestari Kencana, M.Pd</p>
        </div>
    </section>

    <section class="section container" id="berita-terbaru" data-aos="fade-up">
        <div class="section-header">
            <p class="tag">Update Sekolah</p>
            <h2>Berita Terbaru</h2>
        </div>
        <div class="news-list">
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
    </section>

    <section class="section container" data-aos="fade-up">
        <div class="section-header">
            <p class="tag">Program Unggulan</p>
            <h2>Belajar menyenangkan, prestasi membanggakan</h2>
        </div>
        <div class="program-summary">
            <?php foreach ($programHighlights as $index => $program) : ?>
                <article class="card">
                    <span class="tag">
                        <i class='bx <?php echo ['bxs-bulb', 'bxs-graduation', 'bxs-leaf'][$index] ?? 'bxs-star'; ?>'></i>
                        Fokus
                    </span>
                    <h3><?php echo $program['title']; ?></h3>
                    <p><?php echo $program['description']; ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section container" data-aos="fade-up">
        <div class="section-header">
            <p class="tag">Program Inti</p>
            <h2>Rangkuman Kurikulum & Ekstrakurikuler</h2>
        </div>
        <div class="grid grid-3">
            <article class="card">
                <h3>Kurikulum Adaptif</h3>
                <p>Kombinasi Kurikulum Nasional dengan Project Based Learning yang memicu kreativitas dan kolaborasi siswa.</p>
            </article>
            <article class="card">
                <h3>Pendampingan Karakter</h3>
                <p>Program mentoring dan konseling rutin untuk membangun literasi emosional dan karakter yang kuat.</p>
            </article>
            <article class="card">
                <h3>Ekstrakurikuler</h3>
                <p>Lebih dari 15 ekskul aktif mulai dari olahraga, seni, sains, hingga kepemimpinan.</p>
                <a href="program.php" class="btn btn-primary" style="margin-top:1rem;">Detail Program</a>
            </article>
        </div>
    </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>
