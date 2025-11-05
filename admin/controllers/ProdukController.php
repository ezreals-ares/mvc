<?php
// Controller: Logika untuk 'produk'
class ProdukController
{

    private $produkModel;
    private $anggotaModel;
    private $pdo;
    private $uploadDir = 'uploads/produk/';

    public function __construct($pdo)
    {
        $this->pdo = $pdo;

        // Perbaiki path
        require_once __DIR__ . '/../models/Produk.php';
        require_once __DIR__ . '/../models/Anggota.php';

        $this->produkModel = new Produk($pdo);
        $this->anggotaModel = new Anggota($pdo);

        // Buat folder upload jika belum ada
        $fullUploadDir = __DIR__ . '/../' . $this->uploadDir;
        if (!is_dir($fullUploadDir)) {
            mkdir($fullUploadDir, 0777, true);
        }
    }

    public function index()
    {
        $data_produk = $this->produkModel->getAll();

        // Perbaiki path (ini baris 32 Anda)
        require __DIR__ . '/../views/v_produk_index.php';
    }

    public function create()
    {
        $produk = null;
        $data_anggota = $this->anggotaModel->getAll();
        require __DIR__ . '/../views/v_produk_form.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $path_gambar = $this->handleUpload($_FILES['path_gambar']);
            $this->produkModel->create(
                $_POST['nama'],
                $_POST['tahun'],
                $_POST['pembuat_id'],
                $_POST['deskripsi'],
                $_POST['link_demo'],
                $path_gambar
            );
            header('Location: index.php?page=produk&status=created');
        }
    }

    public function edit($uuid)
    {
        $produk = $this->produkModel->getById($uuid);
        if (!$produk) die('Produk tidak ditemukan.');
        $data_anggota = $this->anggotaModel->getAll();
        require __DIR__ . '/../views/v_produk_form.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uuid = $_POST['uuid'];
            $path_gambar = null;

            if (isset($_FILES['path_gambar']) && $_FILES['path_gambar']['error'] == 0) {
                $produkLama = $this->produkModel->getById($uuid);
                $oldImagePath = __DIR__ . '/../' . $produkLama['path_gambar'];
                if ($produkLama['path_gambar'] && file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                $path_gambar = $this->handleUpload($_FILES['path_gambar']);
            }

            $this->produkModel->update(
                $uuid,
                $_POST['nama'],
                $_POST['tahun'],
                $_POST['pembuat_id'],
                $_POST['deskripsi'],
                $_POST['link_demo'],
                $path_gambar
            );
            header('Location: index.php?page=produk&status=updated');
        }
    }

    public function delete($uuid)
    {
        $this->produkModel->delete($uuid);
        header('Location: index.php?page=produk&status=deleted');
    }

    private function handleUpload($file)
    {
        if ($file['error'] !== UPLOAD_ERR_OK) return null;
        $fullUploadDir = __DIR__ . '/../' . $this->uploadDir;
        $fileName = uniqid() . '-' . basename($file['name']);
        $targetPath = $fullUploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $this->uploadDir . $fileName; // Kembalikan path relatif
        }
        return null;
    }

    public function apiGetAll()
    {
        $data = $this->produkModel->getAll();
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($data);
    }
}
