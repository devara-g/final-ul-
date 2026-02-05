<?php
// Shared Sidebar Component
// Active state determined by $currentPage variable set in parent file
?>
<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <strong>Dashboard</strong>
        <p class="muted">Menu Utama</p>
    </div>
    <ul>
        <li><a href="index.php" class="<?php echo ($currentPage === 'dashboard') ? 'active' : ''; ?>"><i class='bx bxs-dashboard'></i> Overview</a></li>
        <li><a href="berita.php" class="<?php echo ($currentPage === 'berita') ? 'active' : ''; ?>"><i class='bx bx-news'></i> Manage Berita</a></li>
        <li><a href="galeri.php" class="<?php echo ($currentPage === 'galeri') ? 'active' : ''; ?>"><i class='bx bx-images'></i> Manage Galeri</a></li>
        <li><a href="kalender.php" class="<?php echo ($currentPage === 'kalender') ? 'active' : ''; ?>"><i class='bx bx-calendar-event'></i> Kalender Acara</a></li>
        <li><a href="pesan.php" class="<?php echo ($currentPage === 'pesan') ? 'active' : ''; ?>"><i class='bx bx-message-detail'></i> Pesan Masuk</a></li>
    </ul>
</aside>