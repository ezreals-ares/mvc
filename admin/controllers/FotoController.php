<?php
// Controller: Khusus untuk aksi upload dan delete 'foto'
class FotoController
{

    private $fotoModel;
    private $pdo;
    private $uploadDir = 'uploads/galeri/'; // Buat folder 'uploads/galeri' di /admin

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        require_once 'models/Foto.php';
        $this->fotoModel = new Foto($pdo);

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    // Aksi: Menyimpan foto baru yang di-upload
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_galeri'])) {
            $id_galeri = $_POST['id_galeri'];

            // Logika Upload File
            $path_gambar = $this->handleUpload($_FILES['path_gambar']);

            if ($path_gambar) {
                $this->fotoModel->create($id_galeri, $path_gambar);
            }

            // Redirect kembali ke halaman 'view' galeri
            header('Location: index.php?page=galeri&action=view&uuid=' . $id_galeri . '&status=foto_added');
        }
    }

    // Aksi: Menghapus satu foto
    public function delete($uuid)
    {
        $foto = $this->fotoModel->getById($uuid);
        if ($foto) {
            $id_galeri = $foto['id_galeri'];
            $this->fotoModel->delete($uuid);
            header('Location: index.php?page=galeri&action=view&uuid=' . $id_galeri . '&status=foto_deleted');
        } else {
            header('Location: index.php?page=galeri');
        }
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
}
