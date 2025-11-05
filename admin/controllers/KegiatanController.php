<?php
// Controller: Logika yang menghubungkan Model dan View untuk Kegiatan
class KegiatanController
{

    private $kegiatanModel;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        require_once __DIR__ . '/../models/Kegiatan.php';
        $this->kegiatanModel = new Kegiatan($pdo);
    }

    // Aksi (method) default: Menampilkan semua kegiatan
    public function index()
    {
        $data_kegiatan = $this->kegiatanModel->getAll();
        require __DIR__ . '/../views/v_kegiatan_index.php';
    }

    // Aksi: Menampilkan form untuk buat kegiatan baru
    public function create()
    {
        $kegiatan = null; // Mode 'create'
        require __DIR__ . '/../views/v_kegiatan_form.php';
    }

    // Aksi: Menyimpan data dari form 'create' ke database
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $tanggal = $_POST['tanggal'];
            $pemateri = $_POST['pemateri'];
            $kategori = $_POST['kategori_kegiatan'];
            $deskripsi = $_POST['deskripsi_singkat'];

            $this->kegiatanModel->create($nama, $tanggal, $pemateri, $kategori, $deskripsi);

            header('Location: index.php?page=kegiatan&status=created');
        }
    }

    // Aksi: Menampilkan form edit berisi data lama
    public function edit($uuid)
    {
        $kegiatan = $this->kegiatanModel->getById($uuid);
        if (!$kegiatan) {
            die('Kegiatan tidak ditemukan.');
        }
        require __DIR__ . '/../views/v_kegiatan_form.php';
    }

    // Aksi: Menyimpan data dari form 'edit' ke database
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uuid = $_POST['uuid'];
            $nama = $_POST['nama'];
            $tanggal = $_POST['tanggal'];
            $pemateri = $_POST['pemateri'];
            $kategori = $_POST['kategori_kegiatan'];
            $deskripsi = $_POST['deskripsi_singkat'];

            $this->kegiatanModel->update($uuid, $nama, $tanggal, $pemateri, $kategori, $deskripsi);

            header('Location: index.php?page=kegiatan&status=updated');
        }
    }

    // Aksi: Menghapus data dari database
    public function delete($uuid)
    {
        $this->kegiatanModel->delete($uuid);
        header('Location: index.php?page=kegiatan&status=deleted');
    }

    // ==============================================
    // API UNTUK FRONTEND (Opsional, jika diperlukan)
    // ==============================================
    public function apiGetAll()
    {
        $data = $this->kegiatanModel->getAll();
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($data);
    }
}
