<?php
/**
 * Config - SMP PGRI 3 Bogor
 * TODO: Backend - Pindahkan ke database/config table untuk pengaturan dinamis
 */
$siteTitle = 'SMP PGRI 3 Bogor';
$siteTagline = 'Berkarakter, Berprestasi, dan Berwawasan Lingkungan';
$contactInfo = [
    'phone' => '(0251) 1234 567',
    'email' => 'info@smppgri3bogor.sch.id',
    'address' => 'Jl. Raya Pajajaran No. 45, Bogor',
    'instagram' => 'https://instagram.com/smppgri3bogor',
    'facebook' => 'https://facebook.com/smppgri3bogor',
    'youtube' => 'https://youtube.com/@smppgri3bogor'
];

// TODO: Replace with database query result for program unggulan.
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

// TODO: Replace with database query result for ekstrakurikuler.
$extracurriculars = [
    ['name' => 'Pramuka', 'coach' => 'Kak Rudi'],
    ['name' => 'Paskibra', 'coach' => 'Pak Fajar'],
    ['name' => 'English Club', 'coach' => 'Bu Anita'],
    ['name' => 'Basket', 'coach' => 'Coach Dani'],
    ['name' => 'Karate', 'coach' => 'Sensei Bimo'],
    ['name' => 'Modern Dance', 'coach' => 'Miss Lala']
];

// TODO: Replace with database-driven news feed.
$newsPosts = [
    [
        'id' => 1,
        'title' => 'Prestasi Gemilang di Olimpiade Sains',
        'excerpt' => 'Tim sains SMP PGRI 3 Bogor meraih juara umum pada ajang Olimpiade Sains Nasional tingkat kota.',
        'thumbnail' => 'https://picsum.photos/seed/pgri-news1/600/400',
        'date' => '25 Januari 2026'
    ],
    [
        'id' => 2,
        'title' => 'Peresmian Laboratorium STEAM',
        'excerpt' => 'Laboratorium baru dilengkapi peralatan robotik dan printer 3D untuk mendukung kurikulum STEAM.',
        'thumbnail' => 'https://picsum.photos/seed/pgri-news2/600/400',
        'date' => '18 Januari 2026'
    ],
    [
        'id' => 3,
        'title' => 'Program Adiwiyata Tingkat Nasional',
        'excerpt' => 'Sekolah siap mengikuti penilaian Adiwiyata Nasional dengan berbagai inovasi lingkungan.',
        'thumbnail' => 'https://picsum.photos/seed/pgri-news3/600/400',
        'date' => '10 Januari 2026'
    ]
];

$galleryFilters = [
    'semua' => 'Semua',
    'kegiatan' => 'Kegiatan',
    'fasilitas' => 'Fasilitas',
    'prestasi' => 'Prestasi'
];

// TODO: Replace with gallery table records.
$galleryItems = [
    [
        'category' => 'kegiatan',
        'image' => 'https://picsum.photos/seed/pgri-gal1/500/350',
        'title' => 'Upacara Pembukaan MPLS'
    ],
    [
        'category' => 'fasilitas',
        'image' => 'https://picsum.photos/seed/pgri-gal2/500/350',
        'title' => 'Laboratorium STEAM'
    ],
    [
        'category' => 'prestasi',
        'image' => 'https://picsum.photos/seed/pgri-gal3/500/350',
        'title' => 'Juara Paskibra'
    ],
    [
        'category' => 'kegiatan',
        'image' => 'https://picsum.photos/seed/pgri-gal4/500/350',
        'title' => 'Kunjungan Industri'
    ],
    [
        'category' => 'fasilitas',
        'image' => 'https://picsum.photos/seed/pgri-gal5/500/350',
        'title' => 'Smart Library'
    ],
    [
        'category' => 'prestasi',
        'image' => 'https://picsum.photos/seed/pgri-gal6/500/350',
        'title' => 'Medali Olimpiade Sains'
    ]
];

// TODO: Replace with agenda table records.
$events = [
    [
        'title' => 'Rapat Orang Tua & Guru',
        'date' => '10 Februari 2026',
        'time' => '08.00 WIB',
        'location' => 'Aula Utama'
    ],
    [
        'title' => 'Pameran Proyek STEAM',
        'date' => '21 Februari 2026',
        'time' => '09.00 WIB',
        'location' => 'Gedung Kreativitas'
    ],
    [
        'title' => 'Ujian Tengah Semester',
        'date' => '4 Maret 2026',
        'time' => '07.00 WIB',
        'location' => 'Seluruh Kelas'
    ]
];

// TODO: Replace with user management table records.
$users = [
    [
        'name' => 'Admin Utama',
        'role' => 'Administrator',
        'email' => 'admin@smppgri3bogor.sch.id'
    ],
    [
        'name' => 'Guru BK',
        'role' => 'Editor',
        'email' => 'bk@smppgri3bogor.sch.id'
    ],
    [
        'name' => 'Kesiswaan',
        'role' => 'Kontributor',
        'email' => 'kesiswaan@smppgri3bogor.sch.id'
    ]
];

// TODO: Replace with messages table records.
$messages = [
    [
        'id' => 1,
        'name' => 'Budi Santoso',
        'email' => 'budi.santoso@gmail.com',
        'subject' => 'Pertanyaan PPDB',
        'message' => 'Selamat siang, saya ingin bertanya mengenai jadwal pendaftaran siswa baru untuk tahun ajaran depan. Terima kasih.',
        'date' => '3 Feb 2026'
    ],
    [
        'id' => 2,
        'name' => 'Siti Aminah',
        'email' => 'siti.aminah@yahoo.com',
        'subject' => 'Undangan Kerjasama',
        'message' => 'Kami dari penerbit buku ingin menawarkan kerjasama pengadaan buku perpustakaan.',
        'date' => '2 Feb 2026'
    ],
    [
        'id' => 3,
        'name' => 'Rina Aulia',
        'email' => 'rina.aulia88@gmail.com',
        'subject' => 'Keluhan Fasilitas',
        'message' => 'Mohon diperbaiki AC di ruang kelas 8B yang sepertinya rusak/tidak dingin.',
        'date' => '1 Feb 2026'
    ]
];