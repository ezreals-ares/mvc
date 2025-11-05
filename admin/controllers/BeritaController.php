<?php
// Controller: Otak/logika yang menghubungkan Model dan View
class BeritaController
{

    private $beritaModel;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;

        // ▼▼▼ PERBAIKAN PENTING DI SINI ▼▼▼
        // Gunakan __DIR__ untuk mendapatkan path folder 'controllers'
        // Gunakan '/../' untuk NAIK satu level ke folder 'admin'
        // Lalu masuk ke 'models/Berita.php'
        require_once __DIR__ . '/../models/Berita.php';

        $this->beritaModel = new Berita($pdo); // <-- Ini baris 13 Anda
    }

    // Aksi (method) default: Menampilkan semua berita
    public function index()
    {
        $data_berita = $this->beritaModel->getAll();

        // ▼▼▼ Path ke view juga diperbaiki ▼▼▼
        require __DIR__ . '/../views/v_berita_index.php';
    }

    // Aksi: Menampilkan form untuk buat berita baru
    public function create()
    {
        $berita = null;

        // ▼▼▼ Path ke view juga diperbaiki ▼▼▼
        require __DIR__ . '/../views/v_berita_form.php';
    }

    // Aksi: Menyimpan data dari form 'create' ke database
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->beritaModel->create(
                $_POST['judul'],
                $_POST['tanggal'],
                $_POST['tempat'],
                $_POST['deskripsi'],
                $_POST['kategori']
            );
            header('Location: index.php?page=berita&status=created');
        }
    }

    // Aksi: Menampilkan form edit berisi data lama
    public function edit($uuid)
    {
        $berita = $this->beritaModel->getById($uuid);
        if (!$berita) {
            die('Berita tidak ditemukan.');
        }

        // ▼▼▼ Path ke view juga diperbaiki ▼▼▼
        require __DIR__ . '/../views/v_berita_form.php';
    }

    // Aksi: Menyimpan data dari form 'edit' ke database
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->beritaModel->update(
                $_POST['uuid'],
                $_POST['judul'],
                $_POST['tanggal'],
                $_POST['tempat'],
                $_POST['deskripsi'],
                $_POST['kategori']
            );

            header('Location: index.php?page=berita&status=updated');
        }
    }

    // Aksi: Menghapus data dari database
    public function delete($uuid)
    {
        $this->beritaModel->delete($uuid);
        header('Location: index.php?page=berita&status=deleted');
    }

    // ==============================================
    // API UNTUK FRONTEND (Intrados-Liberty)
    // ==============================================
    public function apiGetAll()
    {
        // Model sudah di-load di __construct, jadi kita bisa langsung pakai
        $data = $this->beritaModel->getAll();
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($data);
    }
}
