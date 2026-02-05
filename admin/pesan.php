<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../login.php");
    exit;
}

include '../config.php';
if (file_exists('conn.php')) {
    include 'conn.php';
    include '../database/koneksi.php';
} else {
    $conn = mysqli_connect("localhost", "root", "", "p3");
}

$pageTitle = 'Pesan Masuk';
$currentPage = 'pesan';
$isAdminPage = true;
$bodyClass = 'admin-body';

function redirectWithType($status, $msg)
{
    echo "<script>
        alert('$msg');
        window.location.href = 'pesan.php';
    </script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action_pesan']) && $_POST['action_pesan'] === 'delete') {
        $id = (int) $_POST['id'];
        $query = "DELETE FROM pesan WHERE id=$id";
        if (mysqli_query($conn, $query)) {
            redirectWithType('success', 'Pesan berhasil dihapus!');
        }
    }
}

// FETCH DATA
$messages = [];
$resultPesan = mysqli_query($conn, "SELECT * FROM pesan ORDER BY created_at DESC");
if ($resultPesan) {
    while ($row = mysqli_fetch_assoc($resultPesan)) {
        $messages[] = $row;
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
                <p class="muted">Lihat dan tanggapi pesan dari pengunjung website.</p>
            </div>
            <a href="index.php" class="btn btn-secondary btn-sm">Kembali ke Dashboard</a>
        </div>

        <div class="admin-section active" style="display:block;">
            <div class="card admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pengirim</th>
                            <th>Pesan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($messages) > 0) : ?>
                            <?php foreach ($messages as $index => $msg) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td>
                                        <small class="muted">
                                            <?php echo date('d M Y', strtotime($msg['created_at'])); ?><br>
                                            <?php echo date('H:i', strtotime($msg['created_at'])); ?>
                                        </small>
                                    </td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($msg['name']); ?></strong><br>
                                        <small class="muted"><?php echo htmlspecialchars($msg['email']); ?></small>
                                    </td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($msg['subject']); ?></strong><br>
                                        <?php echo htmlspecialchars($msg['message']); ?>
                                    </td>
                                    <td>
                                        <a href="mailto:<?php echo $msg['email']; ?>" class="btn btn-primary" title="Balas Email"><i class='bx bx-reply'></i></a>

                                        <form method="POST" onsubmit="return confirm('Hapus pesan ini?');" style="display:inline;">
                                            <input type="hidden" name="action_pesan" value="delete">
                                            <input type="hidden" name="id" value="<?php echo $msg['id']; ?>">
                                            <button type="submit" class="btn btn-danger" title="Hapus"><i class='bx bx-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" style="text-align:center;">Tidak ada pesan masuk.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>