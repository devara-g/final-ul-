<?php
require_once __DIR__ . '/config.php';
$pageTitle = 'Program Sekolah';
$currentPage = 'program';
include __DIR__ . '/header.php';
?>

<main class="container section">
    <section class="program-hero" data-aos="fade-up">
        <p class="tag">Kurikulum</p>
        <h1>Kurikulum Adaptif dan Kolaboratif</h1>
        <p>
            Kurikulum <?php echo $siteTitle; ?> memadukan Kurikulum Nasional terbaru dengan pendekatan STEAM dan Project Based Learning.
            Setiap siswa mendapat akses ke modul digital, sesi mentoring, serta penilaian berbasis portofolio untuk memotret proses belajar.
        </p>
        <div class="grid grid-3" style="margin-top: 2rem;">
            <article class="card">
                <h3>Project Based Learning</h3>
                <p>Siswa mengerjakan proyek lintas mata pelajaran yang relevan dengan isu lokal dan global.</p>
            </article>
            <article class="card">
                <h3>Kelas Digital</h3>
                <p>Penggunaan Learning Management System dan perangkat tablet sekolah secara terintegrasi.</p>
            </article>
            <article class="card">
                <h3>Coaching & Mentoring</h3>
                <p>Setiap siswa memiliki coach yang memantau perkembangan akademik dan karakter.</p>
            </article>
        </div>
    </section>

    <section class="section" data-aos="fade-up">
        <div class="section-header">
            <p class="tag">Ekstrakurikuler</p>
            <h2>Kembangkan Potensi dan Minat</h2>
        </div>
        <div class="extracurricular-grid">
            <?php foreach ($extracurriculars as $item) : ?>
                <article class="card">
                    <h3><?php echo $item['name']; ?></h3>
                    <p>Pembina: <?php echo $item['coach']; ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section" data-aos="fade-up">
        <div class="section-header">
            <p class="tag">Program Unggulan</p>
            <h2>Fokus Pengembangan Siswa</h2>
        </div>
        <div class="grid grid-2">
            <article class="card">
                <h3>Program Literasi Digital</h3>
                <p>Pembelajaran literasi digital melalui projek video, coding dasar, hingga keamanan siber untuk remaja.</p>
            </article>
            <article class="card">
                <h3>Adiwiyata & Green School</h3>
                <p>Gerakan lingkungan dari bank sampah sekolah, urban farming, dan laboratorium hidroponik mini.</p>
            </article>
        </div>
    </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>
