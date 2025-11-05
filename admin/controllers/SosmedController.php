<?php
// Controller: Logika untuk 'sosmed'
class SosmedController
{

    private $sosmedModel;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        require_once 'models/Sosmed.php';
        $this->sosmedModel = new Sosmed($pdo);
    }

    // Aksi: Menampilkan semua sosmed
    public function index()
    {
        $data_sosmed = $this->sosmedModel->getAll();
        require 'views/v_sosmed_index.php';
    }

    // Aksi: Menampilkan form 'create'
    public function create()
    {
        $sosmed = null;
        require 'views/v_sosmed_form.php';
    }

    // Aksi: Menyimpan data baru
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->sosmedModel->create(
                $_POST['nama'],
                $_POST['url']
            );
            header('Location: index.php?page=sosmed&status=created');
        }
    }

    // Aksi: Menampilkan form 'edit'
    public function edit($uuid)
    {
        $sosmed = $this->sosmedModel->getById($uuid);
        if (!$sosmed) die('Link sosmed tidak ditemukan.');

        require 'views/v_sosmed_form.php';
    }

    // Aksi: Menyimpan update
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uuid = $_POST['uuid'];
            $this->sosmedModel->update(
                $uuid,
                $_POST['nama'],
                $_POST['url']
            );
            header('Location: index.php?page=sosmed&status=updated');
        }
    }

    // Aksi: Menghapus data
    public function delete($uuid)
    {
        $this->sosmedModel->delete($uuid);
        header('Location: index.php?page=sosmed&status=deleted');
    }

    // API untuk frontend (jika frontend perlu link sosmed)
    public function apiGetAll()
    {
        $data = $this->sosmedModel->getAll();
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($data);
    }
}
