<?php
// Controller: Logika untuk 'galeri' (album)
class GaleriController
{

    private $galeriModel;
    private $fotoModel;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        require_once 'models/Galeri.php';
        require_once 'models/Foto.php';
        $this->galeriModel = new Galeri($pdo);
        $this->fotoModel = new Foto($pdo); // Dibutuhkan untuk 'view'
    }

    // Aksi: Menampilkan semua galeri (album)
    public function index()
    {
        $data_galeri = $this->galeriModel->getAll();
        require 'views/v_galeri_index.php';
    }

    // Aksi: Menampilkan form untuk buat galeri baru
    public function create()
    {
        $galeri = null; // Mode 'create'
        require 'views/v_galeri_form.php';
    }

    // Aksi: Menyimpan galeri baru
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->galeriModel->create($_POST['judul'], $_POST['deskripsi']);
            header('Location: index.php?page=galeri&status=created');
        }
    }

    // Aksi: Menampilkan form edit galeri
    public function edit($uuid)
    {
        $galeri = $this->galeriModel->getById($uuid);
        if (!$galeri) die('Galeri tidak ditemukan.');
        require 'views/v_galeri_form.php';
    }

    // Aksi: Menyimpan update galeri
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uuid = $_POST['uuid'];
            $this->galeriModel->update($uuid, $_POST['judul'], $_POST['deskripsi']);
            header('Location: index.php?page=galeri&status=updated');
        }
    }

    // Aksi: Menghapus galeri
    public function delete($uuid)
    {
        $this->galeriModel->delete($uuid);
        header('Location: index.php?page=galeri&status=deleted');
    }

    // Aksi: Melihat isi satu galeri (foto-fotonya)
    public function view($uuid)
    {
        $galeri = $this->galeriModel->getById($uuid);
        if (!$galeri) die('Galeri tidak ditemukan.');

        $data_foto = $this->fotoModel->getByGaleriId($uuid);
        require 'views/v_galeri_view.php';
    }
}
