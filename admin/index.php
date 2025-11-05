<?php
// Mulai session di paling atas
session_start();

// Cek apakah user sudah login. Jika belum, lempar ke halaman login.
// (Saya sesuaikan dengan logika di file login.php Anda)
if (!isset($_SESSION['user_uuid'])) {
    header('Location: login.php');
    exit;
}

// 1. Masukkan file koneksi database
require_once '../config/database.php';

// ===================================================================
// 2. ROUTING UNTUK API (FRONTEND)
// ===================================================================
// Ini adalah bagian yang akan dipanggil oleh frontend Intrados-Liberty
// Contoh: /admin/index.php?api=getAllBerita
if (isset($_GET['api'])) {
    $api_action = $_GET['api'];

    // INI ADALAH BLOK SWITCH YANG ANDA TANYAKAN
    switch ($api_action) {
        case 'getAllBerita':
            require_once 'controllers/BeritaController.php';
            $controller = new BeritaController($pdo);
            $controller->apiGetAll();
            break;
        case 'getAllAnggota':
            require_once 'controllers/AnggotaController.php';
            $controller = new AnggotaController($pdo);
            $controller->apiGetAll();
            break;
        case 'getAllKegiatan':
            require_once 'controllers/KegiatanController.php';
            $controller = new KegiatanController($pdo);
            $controller->apiGetAll();
            break;
        // (API untuk Galeri/Foto mungkin lebih kompleks)
        case 'getAllProduk':
            require_once 'controllers/ProdukController.php';
            $controller = new ProdukController($pdo);
            $controller->apiGetAll();
            break;
        case 'getAllPublikasi':
            require_once 'controllers/PublikasiController.php';
            $controller = new PublikasiController($pdo);
            $controller->apiGetAll();
            break;
        case 'getAllPartnership':
            require_once 'controllers/PartnershipController.php';
            $controller = new PartnershipController($pdo);
            $controller->apiGetAll();
            break;
        case 'getAllFasilitas':
            require_once 'controllers/FasilitasController.php';
            $controller = new FasilitasController($pdo);
            $controller->apiGetAll();
            break;
        case 'getProfile':
            require_once 'controllers/ProfileController.php';
            $controller = new ProfileController($pdo);
            $controller->apiGet();
            break;


        case 'getAllSosmed':
            require_once 'controllers/SosmedController.php';
            $controller = new SosmedController($pdo);
            $controller->apiGetAll();
            break;
    }

    exit; // Hentikan eksekusi script setelah mengirim JSON
}

// ===================================================================
// 3. ROUTING UNTUK HALAMAN DASHBOARD (MVC)
// ===================================================================
// Bagian ini mengatur halaman admin mana yang akan ditampilkan
// Contoh: /admin/index.php?page=berita
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

switch ($page) {
    case 'berita':
        require_once 'controllers/BeritaController.php';
        $controller = new BeritaController($pdo);

        // Tentukan aksi (method) apa yang akan dipanggil di controller
        // Contoh: index.php?page=berita&action=create
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        // Panggil method di controller (index, create, store, edit, update, delete)
        if (method_exists($controller, $action)) {
            // Cek apakah ada parameter UUID untuk action edit, update, delete
            $uuid = isset($_GET['uuid']) ? $_GET['uuid'] : null;
            if ($uuid) {
                $controller->$action($uuid);
            } else {
                $controller->$action();
            }
        } else {
            $controller->index(); // Default action
        }
        break;

    case 'anggota':
        require_once 'controllers/AnggotaController.php';
        $controller = new AnggotaController($pdo);
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        if (method_exists($controller, $action)) {
            $uuid = isset($_GET['uuid']) ? $_GET['uuid'] : null;
            if ($uuid) {
                $controller->$action($uuid);
            } else {
                $controller->$action();
            }
        } else {
            $controller->index();
        }
        break;

    case 'kegiatan': // <-- TAMBAHKAN CASE INI
        require_once 'controllers/KegiatanController.php';
        $controller = new KegiatanController($pdo);
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        if (method_exists($controller, $action)) {
            $uuid = isset($_GET['uuid']) ? $_GET['uuid'] : null;
            if ($uuid) {
                $controller->$action($uuid);
            } else {
                $controller->$action();
            }
        } else {
            $controller->index();
        }
        break;

    case 'galeri': // <-- TAMBAHKAN CASE INI
        require_once 'controllers/GaleriController.php';
        $controller = new GaleriController($pdo);
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        if (method_exists($controller, $action)) {
            $uuid = isset($_GET['uuid']) ? $_GET['uuid'] : null;
            if ($uuid) {
                $controller->$action($uuid);
            } else {
                $controller->$action();
            }
        } else {
            $controller->index();
        }
        break;

    case 'foto': // <-- TAMBAHKAN CASE INI (Untuk Aksi)
        require_once 'controllers/FotoController.php';
        $controller = new FotoController($pdo);
        $action = isset($_GET['action']) ? $_GET['action'] : 'store'; // Default-nya 'store'

        if (method_exists($controller, $action)) {
            $uuid = isset($_GET['uuid']) ? $_GET['uuid'] : null;
            if ($uuid) {
                $controller->$action($uuid); // Untuk 'delete'
            } else {
                $controller->$action(); // Untuk 'store'
            }
        }
        break;

    case 'produk': // <-- TAMBAHKAN CASE INI
        require_once 'controllers/ProdukController.php';
        $controller = new ProdukController($pdo);
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        if (method_exists($controller, $action)) {
            $uuid = isset($_GET['uuid']) ? $_GET['uuid'] : null;
            if ($uuid) {
                $controller->$action($uuid);
            } else {
                $controller->$action();
            }
        } else {
            $controller->index();
        }
        break;

    case 'publikasi': // <-- TAMBAHKAN CASE INI
        require_once 'controllers/PublikasiController.php';
        $controller = new PublikasiController($pdo);
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        if (method_exists($controller, $action)) {
            $uuid = isset($_GET['uuid']) ? $_GET['uuid'] : null;
            if ($uuid) {
                $controller->$action($uuid);
            } else {
                $controller->$action();
            }
        } else {
            $controller->index();
        }
        break;

    case 'partnership': // <-- TAMBAHKAN CASE INI
        require_once 'controllers/PartnershipController.php';
        $controller = new PartnershipController($pdo);
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        if (method_exists($controller, $action)) {
            $uuid = isset($_GET['uuid']) ? $_GET['uuid'] : null;
            if ($uuid) {
                $controller->$action($uuid);
            } else {
                $controller->$action();
            }
        } else {
            $controller->index();
        }
        break;

    case 'fasilitas': // <-- TAMBAHKAN CASE INI
        require_once 'controllers/FasilitasController.php';
        $controller = new FasilitasController($pdo);
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        if (method_exists($controller, $action)) {
            $uuid = isset($_GET['uuid']) ? $_GET['uuid'] : null;
            if ($uuid) {
                $controller->$action($uuid);
            } else {
                $controller->$action();
            }
        } else {
            $controller->index();
        }
        break;

    case 'profile': // <-- TAMBAHKAN CASE INI
        require_once 'controllers/ProfileController.php';
        $controller = new ProfileController($pdo);
        // Aksi default-nya 'index' (tampilkan form) atau 'save' (simpan form)
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            $controller->index();
        }
        break;

    case 'sosmed': // <-- TAMBAHKAN CASE INI
        require_once 'controllers/SosmedController.php';
        $controller = new SosmedController($pdo);
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        if (method_exists($controller, $action)) {
            $uuid = isset($_GET['uuid']) ? $_GET['uuid'] : null;
            if ($uuid) {
                $controller->$action($uuid);
            } else {
                $controller->$action();
            }
        } else {
            $controller->index();
        }
        break;

    case 'dashboard':
    default:
        // Tampilkan halaman dashboard default
        // (Kita akan buat view sederhana untuk ini)
        require 'views/v_dashboard.php';
        break;
}
