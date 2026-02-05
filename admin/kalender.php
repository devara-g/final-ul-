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

$pageTitle = 'Manage Kalender Acara';
$currentPage = 'kalender';
$isAdminPage = true;
$bodyClass = 'admin-body';

function redirectWithType($status, $msg)
{
    echo "<script>
        alert('$msg');
        window.location.href = 'kalender.php';
    </script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action_kalender'])) {
        $title = mysqli_real_escape_string($conn, $_POST['event_title']);
        $date = mysqli_real_escape_string($conn, $_POST['event_date']);
        $time = mysqli_real_escape_string($conn, $_POST['event_time']);
        $location = mysqli_real_escape_string($conn, $_POST['event_location']);
        $desc = mysqli_real_escape_string($conn, $_POST['event_desc']);

        if ($_POST['action_kalender'] === 'create') {
            $query = "INSERT INTO kalender_acara (title, event_date, event_time, location, description) VALUES ('$title', '$date', '$time', '$location', '$desc')";
            if (mysqli_query($conn, $query)) {
                redirectWithType('success', 'Agenda berhasil ditambahkan!');
            }
        } elseif ($_POST['action_kalender'] === 'update') {
            $id = (int) $_POST['event_id'];
            $query = "UPDATE kalender_acara SET title='$title', event_date='$date', event_time='$time', location='$location', description='$desc' WHERE id=$id";
            if (mysqli_query($conn, $query)) {
                redirectWithType('success', 'Agenda berhasil diperbarui!');
            }
        } elseif ($_POST['action_kalender'] === 'delete') {
            $id = (int) $_POST['id'];
            $query = "DELETE FROM kalender_acara WHERE id=$id";
            if (mysqli_query($conn, $query)) {
                redirectWithType('success', 'Agenda berhasil dihapus!');
            }
        }
    }
}

// FETCH DATA
$events = [];
$resultEvent = mysqli_query($conn, "SELECT * FROM kalender_acara ORDER BY event_date ASC, event_time ASC");
if ($resultEvent) {
    while ($row = mysqli_fetch_assoc($resultEvent)) {
        $events[] = $row;
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
                <p class="muted">Kelola agenda kegiatan sekolah.</p>
            </div>
            <a href="index.php" class="btn btn-secondary btn-sm">Kembali ke Dashboard</a>
        </div>

        <div class="admin-section active" style="display:block;">
            <div class="grid grid-2 admin-kalender-grid">
                <!-- Daftar Agenda Terjadwal -->
                <div class="card">
                    <h3>Agenda Terjadwal</h3>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Acara</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($events) > 0) : ?>
                                <?php foreach ($events as $event) : ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($event['title']); ?></strong><br>
                                            <small class="muted"><?php echo htmlspecialchars($event['location']); ?></small>
                                        </td>
                                        <td><?php echo $event['event_date']; ?> <br> <?php echo $event['event_time']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm btn-edit-kalender"
                                                data-id="<?php echo $event['id']; ?>"
                                                data-title="<?php echo htmlspecialchars($event['title']); ?>"
                                                data-date="<?php echo $event['event_date']; ?>"
                                                data-time="<?php echo $event['event_time']; ?>"
                                                data-location="<?php echo htmlspecialchars($event['location']); ?>"
                                                data-desc="<?php echo htmlspecialchars($event['description']); ?>"><i class='bx bx-edit'></i></button>

                                            <form method="POST" onsubmit="return confirm('Hapus agenda ini?');" style="display:inline;">
                                                <input type="hidden" name="action_kalender" value="delete">
                                                <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm"><i class='bx bx-trash'></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3">Tidak ada agenda mendatang.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Form Input Kegiatan Baru -->
                <div class="card">
                    <h3 id="form-kalender-title">Tambah Kegiatan</h3>
                    <form id="formKalender" method="POST">
                        <input type="hidden" name="action_kalender" id="action_kalender" value="create">
                        <input type="hidden" name="event_id" id="event_id">

                        <label>Nama Acara
                            <input type="text" name="event_title" id="event_title" placeholder="Contoh: Rapat Orang Tua" required>
                        </label>
                        <label>Tanggal
                            <input type="date" name="event_date" id="event_date" required>
                        </label>
                        <label>Waktu
                            <input type="time" name="event_time" id="event_time" required>
                        </label>
                        <label>Lokasi
                            <input type="text" name="event_location" id="event_location" placeholder="Contoh: Aula Utama" required>
                        </label>
                        <label>Keterangan
                            <textarea name="event_desc" id="event_desc" rows="2" placeholder="Deskripsi singkat"></textarea>
                        </label>

                        <button type="submit" class="btn btn-primary" style="width:100%; margin-top:0.5rem;">Simpan Agenda</button>
                        <button type="button" class="btn btn-secondary" id="btn-batal-kalender" style="width:100%; margin-top:0.5rem; display:none;">Batal Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const formKalender = document.getElementById('formKalender');
        const btnBatalKalender = document.getElementById('btn-batal-kalender');

        document.querySelectorAll('.btn-edit-kalender').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('action_kalender').value = 'update';
                document.getElementById('event_id').value = btn.dataset.id;

                document.getElementById('event_title').value = btn.dataset.title;
                document.getElementById('event_date').value = btn.dataset.date;
                document.getElementById('event_time').value = btn.dataset.time;
                document.getElementById('event_location').value = btn.dataset.location;
                document.getElementById('event_desc').value = btn.dataset.desc;

                document.getElementById('form-kalender-title').textContent = 'Edit Kegiatan';
                btnBatalKalender.style.display = 'block';
            });
        });

        btnBatalKalender.addEventListener('click', () => {
            formKalender.reset();
            document.getElementById('action_kalender').value = 'create';
            document.getElementById('form-kalender-title').textContent = 'Tambah Kegiatan';
            btnBatalKalender.style.display = 'none';
        });
    });
</script>

<?php include 'footer.php'; ?>