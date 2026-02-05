<?php

/**
 * Config - SMP PGRI 3 Bogor
 * Database-driven Configuration
 */

// 1. DATABASE CONNECTION
// Cek file koneksi ada di mana (relatif terhadap file yang meng-include config.php)
// Karena config.php ada di root, dan biasanya di-include dari root, kita cek direkturnya.
if (file_exists(__DIR__ . '/database/koneksi.php')) {
    include_once __DIR__ . '/database/koneksi.php';
} elseif (file_exists(__DIR__ . '/../database/koneksi.php')) {
    include_once __DIR__ . '/../database/koneksi.php';
} else {
    // Fallback jika tidak ketemu, buat koneksi manual (safety net)
    global $conn;
    if (!isset($conn)) {
        $conn = mysqli_connect("localhost", "root", "", "p3");
    }
}

$siteTitle = 'SMP PGRI 3 Bogor';
$siteTagline = 'Berkarakter, Berprestasi, dan Religius';
$contactInfo = [
    'phone' => '(0251) 1234 567',
    'email' => 'info@smppgri3bogor.sch.id',
    'address' => 'Jl. Raya Pajajaran No. 45, Bogor',
    'instagram' => 'https://instagram.com/smppgri3bogor',
    'facebook' => 'https://facebook.com/smppgri3bogor',
    'youtube' => 'https://youtube.com/@smppgri3bogor'
];

// --- STATIC DATA (Keep these static for now, or move to DB if requested) ---

$programHighlights = [
    [
        'title' => 'Kurikulum Merdeka Belajar',
        'description' => 'Pendekatan pembelajaran yang adaptif dan berpusat pada siswa dengan proyek nyata.'
    ],
    [
        'title' => 'Kelas Digital',
        'description' => 'Pemanfaatan perangkat tablet dan LMS sekolah untuk memperkaya pengalaman belajar.'
    ],
    [
        'title' => 'Pembinaan Karakter',
        'description' => 'Program rutin yang menanamkan karakter religius, disiplin, dan peduli lingkungan.'
    ]
];

$extracurriculars = [
    ['name' => 'Pramuka', 'coach' => 'Kak Rudi'],
    ['name' => 'Paskibra', 'coach' => 'Pak Fajar'],
    ['name' => 'English Club', 'coach' => 'Bu Anita'],
    ['name' => 'Basket', 'coach' => 'Coach Dani'],
    ['name' => 'Karate', 'coach' => 'Sensei Bimo'],
    ['name' => 'Modern Dance', 'coach' => 'Miss Lala']
];

$galleryFilters = [
    'semua' => 'Semua',
    'kegiatan' => 'Kegiatan',
    'fasilitas' => 'Fasilitas',
    'prestasi' => 'Prestasi'
];

// --- DYNAMIC DATA FROM DATABASE ---

// 1. News Posts
$newsPosts = [];
if (isset($conn) && $conn) {
    $newsQuery = mysqli_query($conn, "SELECT * FROM berita ORDER BY created_at DESC");
    if ($newsQuery) {
        while ($row = mysqli_fetch_assoc($newsQuery)) {
            // Tambahkan format tanggal
            $dateObj = date_create($row['created_at']);
            $row['date'] = date_format($dateObj, "d M Y"); // Format untuk frontend: 05 Feb 2026
            $newsPosts[] = $row;
        }
    }
} else {
    // Fallback empty array or static default if DB fails
    error_log("Database connection failed in config.php");
}

// 2. Gallery Items
$galleryItems = [];
if (isset($conn) && $conn) {
    $galQuery = mysqli_query($conn, "SELECT * FROM galeri ORDER BY created_at DESC");
    if ($galQuery) {
        while ($row = mysqli_fetch_assoc($galQuery)) {
            $galleryItems[] = $row;
        }
    }
}

// 3. Events (Kalender Acara)
$events = [];
if (isset($conn) && $conn) {
    // Ambil event yang belum lewat (atau semua update logic sesuai kebutuhan)
    // Disini ambil semua diurutkan tanggal
    $eventQuery = mysqli_query($conn, "SELECT * FROM kalender_acara ORDER BY event_date ASC, event_time ASC");
    if ($eventQuery) {
        while ($row = mysqli_fetch_assoc($eventQuery)) {
            // Mapping field names to frontend expected keys if different
            // Database: title, event_date, event_time, location
            // Config array expects: title, date, time, location
            $dateObj = date_create($row['event_date']);
            $timeObj = date_create($row['event_time']);

            $frontendEvent = [
                'id' => $row['id'],
                'title' => $row['title'],
                'date' => date_format($dateObj, "d M Y"),
                'time' => date_format($timeObj, "H.i") . ' WIB',
                'location' => $row['location'],
                'description' => $row['description'] ?? ''
            ];
            $events[] = $frontendEvent;
        }
    }
}

// 4. Messages (Admin Only - usually fetched in admin panel, but defined here for completeness if needed)
$messages = [];
// Tidak perlu di-fetch global untuk public frontend demi keamanan/performance.
