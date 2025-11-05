<?php
// Controller: Logika untuk 'fasilitas', termasuk upload file
class FasilitasController
{

    private $fasilitasModel;
    private $pdo;
    private $uploadDir = 'uploads/fasilitas/'; // Pastikan folder ini ada

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        require_once 'models/Fasilitas.php';
        $this->fasilitasModel = new Fasilitas($pdo);

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    // Aksi: Menampilkan semua fasilitas
    public function index()
    {
        $data_fasilitas = $this->fasilitasModel->getAll();
        require 'views/v_fasilitas_index.php';
    }

    // Aksi: Menampilkan form 'create'
    public function create()
    {
        $fasilitas = null;
        require 'views/v_fasilitas_form.php';
    }

    // Aksi: Menyimpan data baru
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $path_gambar = $this->handleUpload($_FILES['path_gambar']);

            $this->fasilitasModel->create(
                $_POST['nama'],
                $_POST['deskripsi'],
                $_POST['kuantitas'],
                $path_gambar
            );
            header('Location: index.php?page=fasilitas&status=created');
        }
    }

    // Aksi: Menampilkan form 'edit'
    public function edit($uuid)
    {
        $fasilitas = $this->fasilitasModel->getById($uuid);
        if (!$fasilitas) die('Fasilitas tidak ditemukan.');

        require 'views/v_fasilitas_form.php';
    }

    // Aksi: Menyimpan update
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uuid = $_POST['uuid'];
            $path_gambar = null;

            if (isset($_FILES['path_gambar']) && $_FILES['path_gambar']['error'] == 0) {
                // Hapus gambar lama
                $fasilitasLama = $this->fasilitasModel->getById($uuid);
                if ($fasilitasLama['path_gambar'] && file_exists($fasilitasLama['path_gambar'])) {
                    unlink($fasilitasLama['path_gambar']);
                }
                // Upload gambar baru
                $path_gambar = $this->handleUpload($_FILES['path_gambar']);
            }

            $this->fasilitasModel->update(
                $uuid,
                $_POST['nama'],
                $_POST['deskripsi'],
                $_POST['kuantitas'],
                $path_gambar // Akan null jika tidak ada gambar baru
            );
            header('Location: index.php?page=fasilitas&status=updated');
        }
    }

    // Aksi: Menghapus data
    public function delete($uuid)
    {
        $this->fasilitasModel->delete($uuid);
        header('Location: index.php?page=fasilitas&status=deleted');
    }

    // Fungsi helper untuk upload
    private function handleUpload($file)
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $fileName = uniqid() . '-' . basename($file['name']);
        $targetPath = $this->uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $targetPath;
        }
        return null;
    }

    // API untuk frontend
    public function apiGetAll()
    {
        $data = $this->fasilitasModel->getAll();
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($data);
    }
}
