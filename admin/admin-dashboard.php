<?php

/**
 * Admin Dashboard - SMP PGRI 3 Bogor
 * Backend-ready: Kelola Berita, Galeri, dan Kalender Acara
 * TODO: Tambahkan session check & redirect ke login jika belum auth
 */
include '../config.php';
$pageTitle = 'Dashboard Admin';
$isAdminPage = true;
$bodyClass = 'admin-body';
$additionalScripts = ['../assets/js/admin.js'];


?>
<?php
/**
 * MODULAR HEADER - Include di setiap halaman via include __DIR__ . '/header.php'
 * Variabel yang harus diset sebelum include: $pageTitle, $currentPage (opsional)
 * TODO: Backend - Session check untuk redirect jika auth required
 */
if (!isset($siteTitle)) {
    require_once __DIR__ . '/config.php';
}
$currentPage = $currentPage ?? '';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo isset($pageTitle) ? "{$pageTitle} | {$siteTitle}" : $siteTitle; ?></title>
    <meta name="description" content="Website resmi <?php echo $siteTitle; ?>.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<?php
$bodyClass = $bodyClass ?? '';
?>

<body class="<?php echo htmlspecialchars($bodyClass); ?>">
    <?php if (empty($isAdminPage)) : ?>
        <!-- MODULAR HEADER - Include via header.php -->
        <header class="site-header" id="site-header">
            <div class="container header-inner">
                <a class="brand" href="index.php">
                    <span class="brand-mark">SMP</span>
                    <div class="brand-text">
                        <strong><?php echo $siteTitle; ?></strong>
                        <small><?php echo $siteTagline; ?></small>
                    </div>
                </a>
                <button class="nav-toggle" id="nav-toggle" aria-label="Toggle menu" aria-expanded="false">
                    <i class='bx bx-menu'></i>
                    <i class='bx bx-x'></i>
                </button>
                <nav class="main-nav" aria-label="Navigasi Utama">
                    <ul class="nav-list">
                        <li><a href="index.php#beranda" class="<?php echo $currentPage === 'home' ? 'active' : ''; ?>">Beranda</a></li>
                        <li><a href="tentang.php" class="<?php echo $currentPage === 'about' ? 'active' : ''; ?>">Tentang Kami</a></li>
                        <li><a href="program.php" class="<?php echo $currentPage === 'program' ? 'active' : ''; ?>">Program</a></li>
                        <li><a href="galeri.php" class="<?php echo $currentPage === 'gallery' ? 'active' : ''; ?>">Galeri</a></li>
                        <li><a href="berita.php" class="<?php echo $currentPage === 'news' ? 'active' : ''; ?>">Berita</a></li>
                        <li><a href="kontak.php" class="<?php echo $currentPage === 'contact' ? 'active' : ''; ?>">Kontak</a></li>
                    </ul>
                </nav>
                <div class="header-cta">
                    <a href="login.php" class="btn btn-header">Portal Admin</a>
                </div>
            </div>
        </header>
    <?php endif; ?>


    <main class="admin-dashboard">
        <aside class="admin-sidebar">
            <div class="admin-sidebar-brand">
                <strong>Dashboard Admin</strong>
                <p class="muted"><?php echo $siteTitle; ?></p>
            </div>
            <ul>
                <li><a href="#" class="active" data-section="section-berita"><i class='bx bx-news'></i> Manage Berita</a></li>
                <li><a href="#" data-section="section-galeri"><i class='bx bx-images'></i> Manage Galeri</a></li>
                <li><a href="#" data-section="section-kalender"><i class='bx bx-calendar-event'></i> Kalender Acara</a></li>
                <li><a href="#" data-section="section-pesan"><i class='bx bx-message-detail'></i> Pesan Masuk</a></li>
            </ul>
            <div class="admin-sidebar-footer">
                <a href="index.php"><i class='bx bx-home'></i> Kembali ke Website</a>
            </div>
        </aside>

        <section class="admin-content">
            <div class="admin-header">
                <div>
                    <h1><?php echo $pageTitle; ?></h1>
                    <p class="muted">Manajemen informasi sekolah: berita, galeri, dan agenda kegiatan.</p>
                </div>
                <span class="status-badge"><i class='bx bx-shield'></i> Mode Aman</span>
            </div>

            <!-- ========== SECTION: MANAGE BERITA ========== -->
            <div id="section-berita" class="admin-section active">
                <div class="admin-section-header">
                    <h2>Manage Berita</h2>
                    <button type="button" class="btn btn-primary" id="btn-tambah-berita">
                        <i class='bx bx-plus'></i> Tambah Berita
                    </button>
                </div>

                <!-- TODO: Backend - Data di bawah diambil dari tabel `berita` via SELECT * FROM berita ORDER BY created_at DESC -->
                <div class="card admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Ringkasan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($newsPosts as $index => $post) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><strong><?php echo htmlspecialchars($post['title']); ?></strong></td>
                                    <td><?php echo $post['date']; ?></td>
                                    <td><?php echo htmlspecialchars(mb_substr($post['excerpt'], 0, 50)) . '...'; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-id="<?php echo $post['id']; ?>" title="Edit">Edit</button>
                                        <button type="button" class="btn btn-danger" data-id="<?php echo $post['id']; ?>" title="Hapus">Hapus</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Form Tambah/Edit Berita (tersembunyi by default) -->
                <div id="form-berita-wrapper" class="card" style="margin-top:1.5rem; display:none;">
                    <h3 id="form-berita-title">Tambah Berita Baru</h3>
                    <form id="formBerita">
                        <input type="hidden" name="berita_id" id="berita_id">
                        <label>Judul Berita
                            <input type="text" name="berita_judul" id="berita_judul" placeholder="Judul berita terbaru" required>
                        </label>
                        <label>Ringkasan
                            <textarea name="berita_ringkasan" id="berita_ringkasan" placeholder="Ringkasan singkat berita" rows="3"></textarea>
                        </label>
                        <label>Konten Lengkap</label>
                        <div class="rich-editor" contenteditable="true" id="berita_konten">
                            Tulis konten berita lengkap di sini...
                        </div>
                        <!-- TODO: Backend - Ganti rich-editor dengan WYSIWYG (TinyMCE/Quill) dan simpan ke kolom konten -->
                        <div class="admin-form-actions">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" id="btn-batal-berita">Batal</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ========== SECTION: MANAGE GALERI ========== -->
            <div id="section-galeri" class="admin-section">
                <div class="admin-section-header">
                    <h2>Manage Galeri</h2>
                    <button type="button" class="btn btn-primary" id="btn-tambah-galeri">
                        <i class='bx bx-plus'></i> Upload Foto
                    </button>
                </div>

                <!-- TODO: Backend - Data dari tabel `galeri` JOIN `album_galeri` -->
                <div class="card admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Foto</th>
                                <th>Album / Kategori</th>
                                <th>Preview</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($galleryItems as $index => $item) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                                    <td><?php echo $galleryFilters[$item['category']] ?? $item['category']; ?></td>
                                    <td><img src="<?php echo $item['image']; ?>" alt="" class="admin-thumb"></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" title="Edit">Edit</button>
                                        <button type="button" class="btn btn-danger" title="Hapus">Hapus</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Form Upload Foto (tersembunyi by default) -->
                <div id="form-galeri-wrapper" class="card" style="margin-top:1.5rem; display:none;">
                    <h3>Upload Foto Baru</h3>
                    <form id="formGaleri" class="grid grid-2">
                        <label>Judul Foto
                            <input type="text" name="gallery_title" placeholder="Contoh: Pameran STEAM" required>
                        </label>
                        <label>Kategori / Album
                            <select name="gallery_category">
                                <?php foreach ($galleryFilters as $value => $label) : ?>
                                    <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <label>URL Gambar
                            <input type="text" name="gallery_image" placeholder="https://">
                        </label>
                        <label>Atau Upload File
                            <input type="file" name="gallery_file" accept="image/*">
                        </label>
                        <!-- TODO: Backend - Handle file upload ke folder uploads/, simpan path ke database -->
                        <div class="admin-form-actions" style="grid-column: 1/-1;">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-danger " id="btn-batal-galeri">Batal</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ========== SECTION: KALENDER ACARA ========== -->
            <div id="section-kalender" class="admin-section">
                <h2>Kalender Acara</h2>
                <p class="muted">Kelola kegiatan dan agenda sekolah.</p>

                <div class="grid grid-2 admin-kalender-grid">
                    <!-- Daftar Agenda Terjadwal -->
                    <div class="card">
                        <h3>Agenda Terjadwal</h3>
                        <!-- TODO: Backend - SELECT * FROM kalender_acara ORDER BY tanggal, waktu -->
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Acara</th>
                                    <th>Tanggal</th>
                                    <th>Lokasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($events as $event) : ?>
                                    <tr>
                                        <td><strong><?php echo htmlspecialchars($event['title']); ?></strong></td>
                                        <td><?php echo $event['date']; ?> · <?php echo $event['time']; ?></td>
                                        <td><?php echo htmlspecialchars($event['location']); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary">Edit</button>
                                            <button type="button" class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Form Input Kegiatan Baru -->
                    <div class="card">
                        <h3>Tambah Kegiatan Sekolah</h3>
                        <form id="formKalender">
                            <label>Nama Acara
                                <input type="text" name="event_title" placeholder="Contoh: Rapat Orang Tua" required>
                            </label>
                            <label>Tanggal
                                <input type="date" name="event_date" required>
                            </label>
                            <label>Waktu
                                <input type="time" name="event_time" required>
                            </label>
                            <label>Lokasi
                                <input type="text" name="event_location" placeholder="Contoh: Aula Utama" required>
                            </label>
                            <label>Keterangan (opsional)
                                <textarea name="event_desc" rows="2" placeholder="Deskripsi singkat acara"></textarea>
                            </label>
                            <!-- TODO: Backend - INSERT INTO kalender_acara (judul, tanggal, waktu, lokasi, keterangan) -->
                            <button type="submit" class="btn btn-primary" style="width:100%; margin-top:0.5rem;">Tambahkan ke Kalender</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>

            <!-- ========== SECTION: PESAN MASUK ========== -->
            <div id="section-pesan" class="admin-section">
                <h2>Pesan Masuk</h2>
                <p class="muted">Daftar pesan dari form kontak website.</p>

                <div class="card admin-table-wrapper">
                    <!-- TODO: Backend - SELECT * FROM pesan ORDER BY created_at DESC -->
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pengirim</th>
                                <th>Subjek</th>
                                <th>Pesan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($messages as $index => $msg) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($msg['name']); ?></strong><br>
                                        <small class="muted"><?php echo htmlspecialchars($msg['email']); ?></small>
                                    </td>
                                    <td><?php echo htmlspecialchars($msg['subject']); ?></td>
                                    <td><?php echo htmlspecialchars($msg['message']); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-email="<?php echo $msg['email']; ?>" title="Balas"><i class='bx bx-reply'></i> Balas</button>
                                        <button type="button" class="btn btn-danger" data-id="<?php echo $msg['id']; ?>" title="Hapus">Hapus</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div
        </section>
    </main>

    <?php include 'footer.php'; ?>