<?php
// Controller: Logika untuk 'publikasi'
class PublikasiController
{

    private $publikasiModel;
    private $anggotaModel; // Kita butuh model Anggota untuk dropdown
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;

        // Memuat DUA model
        require_once __DIR__ . '/../models/Publikasi.php';
        require_once __DIR__ . '/../models/Anggota.php';

        $this->publikasiModel = new Publikasi($pdo);
        $this->anggotaModel = new Anggota($pdo);
    }

    // Aksi: Menampilkan semua publikasi
    public function index()
    {
        $data_publikasi = $this->publikasiModel->getAll();
        require 'views/v_publikasi_index.php';
    }

    // Aksi: Menampilkan form 'create', kirim data anggota
    public function create()
    {
        $publikasi = null;
        $data_anggota = $this->anggotaModel->getAll(); // Ambil data anggota
        require 'views/v_publikasi_form.php';
    }

    // Aksi: Menyimpan publikasi baru
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->publikasiModel->create(
                $_POST['judul'],
                $_POST['tahun'],
                $_POST['penulis_id'],
                $_POST['tautan'],
                $_POST['kategori']
            );
            header('Location: index.php?page=publikasi&status=created');
        }
    }

    // Aksi: Menampilkan form 'edit', kirim data publikasi & data anggota
    public function edit($uuid)
    {
        $publikasi = $this->publikasiModel->getById($uuid);
        if (!$publikasi) die('Publikasi tidak ditemukan.');

        $data_anggota = $this->anggotaModel->getAll(); // Ambil data anggota
        require 'views/v_publikasi_form.php';
    }

    // Aksi: Menyimpan update publikasi
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uuid = $_POST['uuid'];

            $this->publikasiModel->update(
                $uuid,
                $_POST['judul'],
                $_POST['tahun'],
                $_POST['penulis_id'],
                $_POST['tautan'],
                $_POST['kategori']
            );
            header('Location: index.php?page=publikasi&status=updated');
        }
    }

    // Aksi: Menghapus publikasi
    public function delete($uuid)
    {
        $this->publikasiModel->delete($uuid);
        header('Location: index.php?page=publikasi&status=deleted');
    }

    // API untuk frontend
    public function apiGetAll()
    {
        $data = $this->publikasiModel->getAll();
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($data);
    }
}
