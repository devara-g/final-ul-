<?php
include 'config.php';
$pageTitle = 'Login Admin';
$currentPage = '';
include __DIR__ . '/header.php';
?>

<main class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <p class="tag">Portal Internal</p>
            <h1>Login Admin</h1>
            <p>Gunakan akun resmi sekolah untuk masuk ke dashboard manajemen informasi.</p>
        </div>

        <div class="login-wrapper login-single" data-aos="fade-up">
            <form id="login-admin" class="login-form active">
                <label>Email Admin</label>
                <input type="email" name="admin_email" placeholder="admin@smppgri3bogor.sch.id" required>
                <label>Password</label>
                <input type="password" name="admin_password" placeholder="Masukkan password" required>
                <!-- TODO: Backend - Authenticate admin via session/database (tabel users) -->
                <button class="btn btn-primary" type="submit">Masuk Dashboard</button>
                <a class="btn-link" href="#">Lupa password?</a>
            </form>
        </div>
    </div>
</main>

<?php include __DIR__ . '/footer.php'; ?>
