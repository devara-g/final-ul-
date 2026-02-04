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
    <link rel="stylesheet" href="assets/css/style.css">
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
                <a href="admin/login.php" class="btn btn-header">Portal Admin</a>
            </div>
        </div>
    </header>
<?php endif; ?>
