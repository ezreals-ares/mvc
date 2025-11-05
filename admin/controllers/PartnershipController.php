<?php
// Controller: Logika untuk 'partnership', termasuk upload file
class PartnershipController
{

    private $partnershipModel;
    private $pdo;
    private $uploadDir = 'uploads/partnership/'; // Pastikan folder ini ada

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        require_once 'models/Partnership.php';
        $this->partnershipModel = new Partnership($pdo);

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    // Aksi: Menampilkan semua partnership
    public function index()
    {
        $data_partnership = $this->partnershipModel->getAll();
        require 'views/v_partnership_index.php';
    }

    // Aksi: Menampilkan form 'create'
    public function create()
    {
        $partner = null;
        require 'views/v_partnership_form.php';
    }

    // Aksi: Menyimpan data baru
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $logo = $this->handleUpload($_FILES['logo']);

            $this->partnershipModel->create(
                $_POST['nama'],
                $logo,
                $_POST['website']
            );
            header('Location: index.php?page=partnership&status=created');
        }
    }

    // Aksi: Menampilkan form 'edit'
    public function edit($uuid)
    {
        $partner = $this->partnershipModel->getById($uuid);
        if (!$partner) die('Partner tidak ditemukan.');

        require 'views/v_partnership_form.php';
    }

    // Aksi: Menyimpan update
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uuid = $_POST['uuid'];
            $logo = null;

            if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
                // Hapus logo lama
                $partnerLama = $this->partnershipModel->getById($uuid);
                if ($partnerLama['logo'] && file_exists($partnerLama['logo'])) {
                    unlink($partnerLama['logo']);
                }
                // Upload logo baru
                $logo = $this->handleUpload($_FILES['logo']);
            }

            $this->partnershipModel->update(
                $uuid,
                $_POST['nama'],
                $_POST['website'],
                $logo // Akan null jika tidak ada logo baru
            );
            header('Location: index.php?page=partnership&status=updated');
        }
    }

    // Aksi: Menghapus data
    public function delete($uuid)
    {
        $this->partnershipModel->delete($uuid);
        header('Location: index.php?page=partnership&status=deleted');
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
        $data = $this->partnershipModel->getAll();
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($data);
    }
}
