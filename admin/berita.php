<?php
session_start();
// Cek sesi login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../login.php");
    exit;
}

include '../config.php';
// Database Connection
if (file_exists('conn.php')) {
    include 'conn.php';
} elseif (file_exists('../database/koneksi.php')) {
    include '../database/koneksi.php';
} else {
    $conn = mysqli_connect("localhost", "root", "", "p3");
}

$pageTitle = 'Manage Berita';
$currentPage = 'berita'; // For sidebar active state
$isAdminPage = true;
$bodyClass = 'admin-body';

// --- BACKEND LOGIC: CRUD BERITA ---

// Helper function untuk redirect dengan pesan status
function redirectWithType($status, $msg)
{
    echo "<script>
        alert('$msg');
        window.location.href = 'berita.php';
    </script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['action_berita'])) {
        $judul = mysqli_real_escape_string($conn, $_POST['berita_judul']);
        $ringkasan = mysqli_real_escape_string($conn, $_POST['berita_ringkasan']);
        $konten = mysqli_real_escape_string($conn, $_POST['berita_konten']);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $judul)));
        $thumbnailPath = '';

        // Handle File Upload
        if (!empty($_FILES['berita_thumbnail']['name'])) {
            $targetDir = "../uploads/berita/";
            if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

            $fileName = time() . '_' . basename($_FILES['berita_thumbnail']['name']);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES['berita_thumbnail']['tmp_name'], $targetFile)) {
                $thumbnailPath = 'uploads/berita/' . $fileName;
            }
        }

        if ($_POST['action_berita'] === 'create') {
            if (empty($thumbnailPath)) {
                $thumbnailPath = 'https://via.placeholder.com/600x400?text=News';
            }
            $query = "INSERT INTO berita (title, slug, excerpt, content, thumbnail, created_at) VALUES ('$judul', '$slug', '$ringkasan', '$konten', '$thumbnailPath', NOW())";
            if (mysqli_query($conn, $query)) {
                redirectWithType('success', 'Berita berhasil ditambahkan!');
            } else {
                redirectWithType('error', 'Gagal menambah berita: ' . mysqli_error($conn));
            }
        } elseif ($_POST['action_berita'] === 'update') {
            $id = (int) $_POST['berita_id'];
            if (!empty($thumbnailPath)) {
                $query = "UPDATE berita SET title='$judul', slug='$slug', excerpt='$ringkasan', content='$konten', thumbnail='$thumbnailPath' WHERE id=$id";
            } else {
                $query = "UPDATE berita SET title='$judul', slug='$slug', excerpt='$ringkasan', content='$konten' WHERE id=$id";
            }

            if (mysqli_query($conn, $query)) {
                redirectWithType('success', 'Berita berhasil diperbarui!');
            } else {
                redirectWithType('error', 'Gagal update berita: ' . mysqli_error($conn));
            }
        } elseif ($_POST['action_berita'] === 'delete') {
            $id = (int) $_POST['id'];
            $query = "DELETE FROM berita WHERE id=$id";
            if (mysqli_query($conn, $query)) {
                redirectWithType('success', 'Berita berhasil dihapus!');
            } else {
                redirectWithType('error', 'Gagal hapus berita: ' . mysqli_error($conn));
            }
        }
    }
}

// FETCH DATA
$newsPosts = [];
$resultBerita = mysqli_query($conn, "SELECT * FROM berita ORDER BY created_at DESC");
if ($resultBerita) {
    while ($row = mysqli_fetch_assoc($resultBerita)) {
        $date = date_create($row['created_at']);
        $row['date_formatted'] = date_format($date, "d M Y");
        $newsPosts[] = $row;
    }
}

include 'header.php';
?>

<main class="admin-dashboard">
    <?php include 'sidebar.php'; // Include Sidebar separately 
    ?>

    <section class="admin-content">
        <div class="admin-header">
            <div>
                <h1><?php echo $pageTitle; ?></h1>
                <p class="muted">Kelola berita sekolah dan artikel.</p>
            </div>
            <a href="index.php" class="btn btn-secondary btn-sm">Kembali ke Dashboard</a>
        </div>

        <div class="admin-section active" style="display:block;">
            <div class="admin-section-header">
                <h2>Daftar Berita</h2>
                <button type="button" class="btn btn-primary" id="btn-tambah-berita">
                    <i class='bx bx-plus'></i> Tambah Berita
                </button>
            </div>

            <div class="card admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul & Thumbnail</th>
                            <th>Tanggal</th>
                            <th>Ringkasan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($newsPosts) > 0) : ?>
                            <?php foreach ($newsPosts as $index => $post) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td>
                                        <div style="display:flex; align-items:center; gap:10px;">
                                            <?php
                                            // Handling thumbnail viewing
                                            $thumb = $post['thumbnail'] ? $post['thumbnail'] : 'https://via.placeholder.com/100x70?text=No+Img';
                                            if (!filter_var($thumb, FILTER_VALIDATE_URL)) $thumb = "../" . $thumb;
                                            ?>
                                            <img src="<?php echo $thumb; ?>" alt="Thumb" style="width:60px; height:45px; object-fit:cover; border-radius:4px;">
                                            <strong><?php echo htmlspecialchars($post['title']); ?></strong>
                                        </div>
                                    </td>
                                    <td><?php echo $post['date_formatted']; ?></td>
                                    <td><?php echo htmlspecialchars(mb_substr($post['excerpt'], 0, 50)) . '...'; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm btn-edit-berita"
                                            data-id="<?php echo $post['id']; ?>"
                                            data-title="<?php echo htmlspecialchars($post['title']); ?>"
                                            data-excerpt="<?php echo htmlspecialchars($post['excerpt']); ?>"
                                            data-content="<?php echo htmlspecialchars($post['content']); ?>"
                                            data-thumbnail="<?php echo htmlspecialchars($post['thumbnail']); ?>"
                                            title="Edit"><i class='bx bx-edit'></i></button>

                                        <form method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');" style="display:inline;">
                                            <input type="hidden" name="action_berita" value="delete">
                                            <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" style="text-align:center;">Belum ada berita.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Form Tambah/Edit Berita (tersembunyi by default) -->
            <div id="form-berita-wrapper" class="card" style="margin-top:1.5rem; display:none;">
                <h3 id="form-berita-title">Tambah Berita Baru</h3>
                <form id="formBerita" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action_berita" id="action_berita" value="create">
                    <input type="hidden" name="berita_id" id="berita_id">
                    <input type="hidden" name="existing_thumbnail" id="existing_thumbnail">

                    <label>Judul Berita
                        <input type="text" name="berita_judul" id="berita_judul" placeholder="Judul berita terbaru" required>
                    </label>
                    <label>Thumbnail / Gambar Sampul
                        <small class="muted" id="current_thumbnail_info" style="display:none; margin-bottom:0.5rem; display:block;">File saat ini: <span id="current_thumbnail_name">-</span></small>
                        <input type="file" name="berita_thumbnail" id="berita_thumbnail" accept="image/*">
                    </label>
                    <label>Ringkasan
                        <textarea name="berita_ringkasan" id="berita_ringkasan" placeholder="Ringkasan singkat berita" rows="2" required></textarea>
                    </label>
                    <label>Konten Lengkap</label>
                    <textarea name="berita_konten" id="berita_konten" rows="5" placeholder="Tulis konten berita lengkap di sini..." required style="width:100%; padding:0.8rem; border:1px solid #ddd; border-radius:8px; font-family:inherit;"></textarea>

                    <div class="admin-form-actions">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" id="btn-batal-berita">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btnTambahBerita = document.getElementById('btn-tambah-berita');
        const formBeritaWrapper = document.getElementById('form-berita-wrapper');
        const btnBatalBerita = document.getElementById('btn-batal-berita');
        const formBerita = document.getElementById('formBerita');

        btnTambahBerita.addEventListener('click', () => {
            formBeritaWrapper.style.display = 'block';
            formBerita.reset();
            document.getElementById('action_berita').value = 'create';
            document.getElementById('form-berita-title').textContent = 'Tambah Berita Baru';
            document.getElementById('current_thumbnail_info').style.display = 'none';
            formBeritaWrapper.scrollIntoView({
                behavior: 'smooth'
            });
        });

        btnBatalBerita.addEventListener('click', () => {
            formBeritaWrapper.style.display = 'none';
        });

        document.querySelectorAll('.btn-edit-berita').forEach(btn => {
            btn.addEventListener('click', () => {
                formBeritaWrapper.style.display = 'block';
                document.getElementById('action_berita').value = 'update';
                document.getElementById('berita_id').value = btn.dataset.id;
                document.getElementById('berita_judul').value = btn.dataset.title;
                document.getElementById('berita_ringkasan').value = btn.dataset.excerpt;
                document.getElementById('berita_konten').value = btn.dataset.content;

                const existingThumb = btn.dataset.thumbnail;
                document.getElementById('existing_thumbnail').value = existingThumb;
                if (existingThumb) {
                    document.getElementById('current_thumbnail_info').style.display = 'block';
                    document.getElementById('current_thumbnail_name').textContent = existingThumb;
                } else {
                    document.getElementById('current_thumbnail_info').style.display = 'none';
                }

                document.getElementById('form-berita-title').textContent = 'Edit Berita';
                formBeritaWrapper.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });
</script>

<?php include 'footer.php'; ?>