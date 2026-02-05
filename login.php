<?php
session_start();
// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin/admin-dashboard.php");
    exit;
}

include 'config.php';
// Include koneksi database
if (file_exists('database/koneksi.php')) {
    include 'database/koneksi.php';
} elseif (file_exists('admin/conn.php')) {
    include 'admin/conn.php';
} else {
    // Fallback
    $conn = mysqli_connect("localhost", "root", "", "p3");
}

$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['admin_email']);
    $password = $_POST['admin_password'];

    // Cek user
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password (MD5 sesuai data seed di database, 
        // NOTE: Untuk keamanan lebih baik di masa depan gunakan password_hash/verify)
        if ($user['password'] === md5($password)) {
            // Login sukses
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_name'] = $user['name'];
            $_SESSION['admin_role'] = $user['role'];

            header("Location: admin/index.php");
            exit;
        } else {
            $errorMsg = "Password salah!";
        }
    } else {
        $errorMsg = "Email tidak terdaftar!";
    }
}

$pageTitle = 'Login Admin';
$currentPage = '';
include __DIR__ . '/header.php';
?>

<main class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <p class="tag">Portal Internal</p>
            <h1>Login Admin</h1>
            <p>Gunakan akun resmi sekolah untuk masuk ke dashboard manajemen informasi. <br> (Default: admin@smppgri3bogor.sch.id / admin123)</p>
        </div>

        <div class="login-wrapper login-single" data-aos="fade-up">
            <?php if (!empty($errorMsg)): ?>
                <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                    <?php echo $errorMsg; ?>
                </div>
            <?php endif; ?>

            <form id="login-admin" class="login-form active" method="POST">
                <label>Email Admin</label>
                <input type="email" name="admin_email" placeholder="admin@smppgri3bogor.sch.id" required>
                <label>Password</label>
                <input type="password" name="admin_password" placeholder="Masukkan password" required>

                <button class="btn btn-primary" type="submit">Masuk Dashboard</button>
                <a class="btn-link" href="#">Lupa password?</a>
            </form>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>