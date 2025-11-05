<?php
// Controller: Logika untuk halaman 'profile'
class ProfileController
{

    private $profileModel;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        require_once 'models/Profile.php';
        $this->profileModel = new Profile($pdo);
    }

    // Aksi (method) default: Menampilkan form
    public function index()
    {
        // Ambil data profile yang ada
        $profile = $this->profileModel->get();

        // Tampilkan view form, kirim data $profile (bisa null jika kosong)
        require 'views/v_profile_form.php';
    }

    // Aksi: Menyimpan data (Create atau Update)
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $visi = $_POST['visi'];
            $misi = $_POST['misi'];
            $sejarah = $_POST['sejarah'];

            // Cek apakah data sudah ada
            $existingProfile = $this->profileModel->get();

            if ($existingProfile) {
                // Jika sudah ada, UPDATE
                $this->profileModel->update($existingProfile['uuid'], $visi, $misi, $sejarah);
            } else {
                // Jika belum ada, CREATE
                $this->profileModel->create($visi, $misi, $sejarah);
            }

            // Redirect kembali ke halaman yang sama dengan status sukses
            header('Location: index.php?page=profile&status=saved');
        }
    }

    // API untuk frontend (jika frontend perlu Visi/Misi)
    public function apiGet()
    {
        $data = $this->profileModel->get();
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($data);
    }
}
