<?php
// Controller: Logika untuk 'anggota', termasuk upload file
class AnggotaController
{

    private $anggotaModel;
    private $pdo;
    private $uploadDir = 'uploads/anggota/'; // Buat folder 'uploads/anggota' di dalam /admin

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        require_once __DIR__ . '/../models/Anggota.php';
        $this->anggotaModel = new Anggota($pdo);

        // Buat direktori upload jika belum ada
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function index()
    {
        $data_anggota = $this->anggotaModel->getAll();
        require __DIR__ . '/../views/v_anggota_index.php';
    }

    public function create()
    {
        $anggota = null;
        require __DIR__ . '/../views/v_anggota_form.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $nidn = $_POST['nidn'];
            $jabatan = $_POST['jabatan'];
            $status = $_POST['status'];

            // Logika Upload File
            $path_gambar = $this->handleUpload($_FILES['path_gambar']);

            $this->anggotaModel->create($nama, $nidn, $jabatan, $status, $path_gambar);
            header('Location: index.php?page=anggota&status=created');
        }
    }

    public function edit($uuid)
    {
        $anggota = $this->anggotaModel->getById($uuid);
        if (!$anggota) die('Anggota tidak ditemukan.');
        require __DIR__ . '/../views/v_anggota_form.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uuid = $_POST['uuid'];
            $nama = $_POST['nama'];
            $nidn = $_POST['nidn'];
            $jabatan = $_POST['jabatan'];
            $status = $_POST['status'];

            $path_gambar = null;
            // Cek apakah ada file baru yang di-upload
            if (isset($_FILES['path_gambar']) && $_FILES['path_gambar']['error'] == 0) {
                // Hapus gambar lama dulu
                $anggotaLama = $this->anggotaModel->getById($uuid);
                if ($anggotaLama['path_gambar'] && file_exists($anggotaLama['path_gambar'])) {
                    unlink($anggotaLama['path_gambar']);
                }
                // Upload gambar baru
                $path_gambar = $this->handleUpload($_FILES['path_gambar']);
            }

            $this->anggotaModel->update($uuid, $nama, $nidn, $jabatan, $status, $path_gambar);
            header('Location: index.php?page=anggota&status=updated');
        }
    }

    public function delete($uuid)
    {
        $this->anggotaModel->delete($uuid);
        header('Location: index.php?page=anggota&status=deleted');
    }

    // Fungsi helper untuk menangani upload file
    private function handleUpload($file)
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null; // Tidak ada file atau error
        }

        $fileName = uniqid() . '-' . basename($file['name']);
        $targetPath = $this->uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $targetPath; // Kembalikan path file yang disimpan
        }
        return null;
    }

    // API untuk frontend
    public function apiGetAll()
    {
        $data = $this->anggotaModel->getAll();
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($data);
    }
}
