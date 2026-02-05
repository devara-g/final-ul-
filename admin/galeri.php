<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../login.php");
    exit;
}

include '../config.php';
if (file_exists('conn.php')) {
    include 'conn.php';
} elseif (file_exists('../database/koneksi.php')) {
    include '../database/koneksi.php';
} else {
    $conn = mysqli_connect("localhost", "root", "", "p3");
}

$pageTitle = 'Manage Galeri';
$currentPage = 'galeri';
$isAdminPage = true;
$bodyClass = 'admin-body';

// --- BACKEND LOGIC ---
function redirectWithType($status, $msg)
{
    echo "<script>
        alert('$msg');
        window.location.href = 'galeri.php';
    </script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action_galeri'])) {
        $judul = mysqli_real_escape_string($conn, $_POST['gallery_title']);
        $kategori = mysqli_real_escape_string($conn, $_POST['gallery_category']);
        $imagePath = '';

        if (!empty($_FILES['gallery_file']['name'])) {
            $targetDir = "../uploads/galeri/";
            if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

            $fileName = time() . '_' . basename($_FILES['gallery_file']['name']);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES['gallery_file']['tmp_name'], $targetFile)) {
                $imagePath = 'uploads/galeri/' . $fileName;
            }
        }

        if (empty($imagePath) && !empty($_POST['gallery_image'])) {
            $imagePath = mysqli_real_escape_string($conn, $_POST['gallery_image']);
        }
        if (empty($imagePath)) {
            $imagePath = 'https://via.placeholder.com/500x350?text=No+Image';
        }

        if ($_POST['action_galeri'] === 'create') {
            $query = "INSERT INTO galeri (title, category, image, created_at) VALUES ('$judul', '$kategori', '$imagePath', NOW())";
            if (mysqli_query($conn, $query)) {
                redirectWithType('success', 'Foto berhasil ditambahkan!');
            }
        } elseif ($_POST['action_galeri'] === 'update') {
            $id = (int) $_POST['gallery_id'];
            if (empty($imagePath) && !empty($_POST['existing_image'])) {
                $imagePath = $_POST['existing_image'];
            }
            // Logic correction: if upload exists, imagePath is set. If not, check existing.
            // But above logic sets imagePath if upload/url provided.
            // Re-eval:
            // 1. Upload new -> imagePath set
            // 2. URL new -> imagePath set
            // 3. No new -> imagePath is placeholder
            // If it's update, we should retain old if no new provided.
            if ($_POST['action_galeri'] === 'update' && ($imagePath === 'https://via.placeholder.com/500x350?text=No+Image') && !empty($_POST['existing_image'])) {
                // Check if user really didn't provide input (file empty, url empty)
                if (empty($_FILES['gallery_file']['name']) && empty($_POST['gallery_image'])) {
                    $imagePath = $_POST['existing_image'];
                }
            }

            $query = "UPDATE galeri SET title='$judul', category='$kategori', image='$imagePath' WHERE id=$id";
            if (mysqli_query($conn, $query)) {
                redirectWithType('success', 'Foto berhasil diupdate!');
            }
        } elseif ($_POST['action_galeri'] === 'delete') {
            $id = (int) $_POST['id'];
            $query = "DELETE FROM galeri WHERE id=$id";
            if (mysqli_query($conn, $query)) {
                redirectWithType('success', 'Foto berhasil dihapus!');
            }
        }
    }
}

// FETCH DATA
$galleryItems = [];
$resultGaleri = mysqli_query($conn, "SELECT * FROM galeri ORDER BY created_at DESC");
if ($resultGaleri) {
    while ($row = mysqli_fetch_assoc($resultGaleri)) {
        $galleryItems[] = $row;
    }
}

include 'header.php';
?>

<main class="admin-dashboard">
    <?php include 'sidebar.php'; ?>

    <section class="admin-content">
        <div class="admin-header">
            <div>
                <h1><?php echo $pageTitle; ?></h1>
                <p class="muted">Kelola dokumentasi foto kegiatan sekolah.</p>
            </div>
            <a href="index.php" class="btn btn-secondary btn-sm">Kembali ke Dashboard</a>
        </div>

        <div class="admin-section active" style="display:block;">
            <div class="admin-section-header">
                <h2>Daftar Foto</h2>
                <button type="button" class="btn btn-primary" id="btn-tambah-galeri">
                    <i class='bx bx-plus'></i> Upload Foto
                </button>
            </div>

            <div class="card admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Foto</th>
                            <th>Kategori</th>
                            <th>Preview</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($galleryItems) > 0) : ?>
                            <?php foreach ($galleryItems as $index => $item) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                                    <td><?php echo $galleryFilters[$item['category']] ?? $item['category']; ?></td>
                                    <td>
                                        <?php
                                        $imgSrc = $item['image'];
                                        if (!filter_var($imgSrc, FILTER_VALIDATE_URL)) {
                                            $imgSrc = "../" . $imgSrc;
                                        }
                                        ?>
                                        <img src="<?php echo $imgSrc; ?>" alt="" class="admin-thumb">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-edit-galeri"
                                            data-id="<?php echo $item['id']; ?>"
                                            data-title="<?php echo htmlspecialchars($item['title']); ?>"
                                            data-category="<?php echo htmlspecialchars($item['category']); ?>"
                                            data-image="<?php echo htmlspecialchars($item['image']); ?>"
                                            title="Edit">Edit</button>

                                        <form method="POST" onsubmit="return confirm('Yakin hapus foto ini?');" style="display:inline;">
                                            <input type="hidden" name="action_galeri" value="delete">
                                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                            <button type="submit" class="btn btn-danger" title="Hapus">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" style="text-align:center;">Belum ada foto galeri.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Form Upload Foto -->
            <div id="form-galeri-wrapper" class="card" style="margin-top:1.5rem; display:none;">
                <h3 id="form-galeri-title">Upload Foto Baru</h3>
                <form id="formGaleri" method="POST" enctype="multipart/form-data" class="grid grid-2">
                    <input type="hidden" name="action_galeri" id="action_galeri" value="create">
                    <input type="hidden" name="gallery_id" id="gallery_id">
                    <input type="hidden" name="existing_image" id="existing_image">

                    <label>Judul Foto
                        <input type="text" name="gallery_title" id="gallery_title" placeholder="Contoh: Pameran STEAM" required>
                    </label>
                    <label>Kategori / Album
                        <select name="gallery_category" id="gallery_category">
                            <?php foreach ($galleryFilters as $value => $label) : ?>
                                <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label>URL Gambar (Opsional)
                        <input type="text" name="gallery_image" id="gallery_image" placeholder="https://...">
                    </label>
                    <label>Atau Upload File
                        <input type="file" name="gallery_file" id="gallery_file" accept="image/*">
                    </label>

                    <div class="admin-form-actions" style="grid-column: 1/-1;">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" id="btn-batal-galeri">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btnTambahGaleri = document.getElementById('btn-tambah-galeri');
        const formGaleriWrapper = document.getElementById('form-galeri-wrapper');
        const btnBatalGaleri = document.getElementById('btn-batal-galeri');
        const formGaleri = document.getElementById('formGaleri');

        btnTambahGaleri.addEventListener('click', () => {
            formGaleriWrapper.style.display = 'block';
            formGaleri.reset();
            document.getElementById('action_galeri').value = 'create';
            document.getElementById('form-galeri-title').textContent = 'Upload Foto Baru';
            formGaleriWrapper.scrollIntoView({
                behavior: 'smooth'
            });
        });

        btnBatalGaleri.addEventListener('click', () => {
            formGaleriWrapper.style.display = 'none';
        });

        document.querySelectorAll('.btn-edit-galeri').forEach(btn => {
            btn.addEventListener('click', () => {
                formGaleriWrapper.style.display = 'block';
                document.getElementById('action_galeri').value = 'update';
                document.getElementById('gallery_id').value = btn.dataset.id;
                document.getElementById('gallery_title').value = btn.dataset.title;
                document.getElementById('gallery_category').value = btn.dataset.category;
                document.getElementById('existing_image').value = btn.dataset.image;
                document.getElementById('form-galeri-title').textContent = 'Edit Foto Galeri';
                formGaleriWrapper.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });
</script>

<?php include 'footer.php'; ?>