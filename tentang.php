<?php
require_once __DIR__ . '/config.php';
$pageTitle = 'Tentang Kami';
$currentPage = 'about';
include __DIR__ . '/header.php';
?>

<main class="container section">
    <section data-aos="fade-up">
        <p class="tag">Profil Sekolah</p>
        <h1>Sejarah Singkat SMP PGRI 3 Bogor</h1>
        <div class="card">
            <p>
                Berdiri sejak tahun 1987, <?php echo $siteTitle; ?> terus berkembang sebagai sekolah rujukan di Kota Bogor.
                Kami memulai perjalanan dari sebuah sekolah dengan fasilitas sederhana dan kini berevolusi menjadi sekolah modern
                dengan laboratorium STEAM, perpustakaan digital, dan ruang kelas berbasis teknologi.
            </p>
            <p>
                Budaya kolaborasi antara guru, siswa, orang tua, dan alumni menjadikan sekolah ini konsisten melahirkan berbagai prestasi
                akademik maupun non-akademik di tingkat kota hingga nasional.
            </p>
        </div>
    </section>

    <section class="section" data-aos="fade-up">
        <div class="section-header">
            <p class="tag">Arah Sekolah</p>
            <h2>Visi & Misi</h2>
        </div>
        <div class="vision-mission">
            <article class="card">
                <h3>Visi</h3>
                <p>
                    Menjadi sekolah unggul berwawasan global yang berlandaskan pada iman, ilmu, dan kepedulian lingkungan
                    untuk mencetak generasi kreatif, cerdas, dan berkarakter.
                </p>
            </article>
            <article class="card">
                <h3>Misi</h3>
                <ul>
                    <li>Menyelenggarakan pembelajaran inovatif dan menyenangkan.</li>
                    <li>Mengintegrasikan teknologi digital dalam proses belajar.</li>
                    <li>Mengembangkan potensi akademik dan non-akademik siswa.</li>
                    <li>Membangun budaya literasi, disiplin, dan kepedulian sosial.</li>
                    <li>Menciptakan lingkungan sekolah hijau dan sehat.</li>
                </ul>
            </article>
        </div>
    </section>

    <section class="section" data-aos="fade-up">
        <div class="section-header">
            <p class="tag">Struktur Organisasi</p>
            <h2>Kolaborasi Tim yang Solid</h2>
        </div>
        <div class="org-structure">
            <?php
            $structures = [
                ['title' => 'Kepala Sekolah', 'name' => 'Dra. Lestari Kencana, M.Pd'],
                ['title' => 'Wakil Kepala Sekolah', 'name' => 'Eko Prasetyo, S.Pd'],
                ['title' => 'Kurikulum', 'name' => 'Rania Pratiwi, S.Pd'],
                ['title' => 'Kesiswaan', 'name' => 'Teguh Wijaya, S.Pd'],
                ['title' => 'Sarpras', 'name' => 'Arga Nanda, S.T'],
                ['title' => 'Humas', 'name' => 'Maya Kusuma, S.Pd']
            ];
            foreach ($structures as $role) :
                ?>
                <article class="org-card">
                    <small class="muted"><?php echo $role['title']; ?></small>
                    <strong><?php echo $role['name']; ?></strong>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php include __DIR__ . '/footer.php'; ?>
