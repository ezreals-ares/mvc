<?php
// Mulai session
session_start();

// 1. Jika user SUDAH login, lempar ke dashboard
if (isset($_SESSION['user_uuid'])) {
    header('Location: index.php?page=dashboard');
    exit;
}

// 2. Masukkan file koneksi dan model (DENGAN PATH YANG DIPERBAIKI)
require_once '../config/database.php';
require_once 'models/User.php';

$error_message = '';

// 3. Proses form jika di-submit (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userModel = new User($pdo);

    // 4. Cari user di database
    $user = $userModel->findByUsername($username);

    // 5. Verifikasi user dan password
    if ($user && password_verify($password, $user['password'])) {

        // 6. Jika sukses, simpan data ke session
        session_regenerate_id(); // Keamanan
        $_SESSION['user_uuid'] = $user['uuid'];
        $_SESSION['username'] = $user['username'];

        // 7. Arahkan ke dashboard MVC
        header('Location: index.php?page=dashboard');
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        $error_message = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>
        Admin Login
    </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Sign In</h4>
                                    <p class="mb-0">Enter your username and password to sign in</p>
                                </div>
                                <div class="card-body">

                                    <?php if (!empty($error_message)): ?>
                                        <div class="alert alert-danger text-white" role="alert">
                                            <?php echo $error_message; ?>
                                        </div>
                                    <?php endif; ?>

                                    <form role="form" method="POST" action="login.php">
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" name="username" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="password" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://demos.creative-tim.com/argon-dashboard/assets/img/signin-ill.jpg');
          background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new currency"</h4>
                                <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>