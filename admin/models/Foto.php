<?php
// Model: Query untuk tabel 'foto'
class Foto
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Ambil semua foto untuk SATU galeri
    public function getByGaleriId($id_galeri)
    {
        $stmt = $this->db->prepare("SELECT * FROM public.foto WHERE id_galeri = ? ORDER BY created_at ASC");
        $stmt->execute([$id_galeri]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($uuid)
    {
        $stmt = $this->db->prepare("SELECT * FROM public.foto WHERE uuid = ?");
        $stmt->execute([$uuid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buat/tambahkan foto baru ke galeri
    public function create($id_galeri, $path_gambar)
    {
        $sql = "INSERT INTO public.foto (id_galeri, path_gambar, created_at, updated_at) 
                VALUES (?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_galeri, $path_gambar]);
    }

    // Hapus satu foto
    public function delete($uuid)
    {
        // (PENTING: Kita juga harus hapus file gambar dari server)
        $foto = $this->getById($uuid);
        if ($foto && $foto['path_gambar'] && file_exists($foto['path_gambar'])) {
            unlink($foto['path_gambar']); // Hapus file fisik
        }

        $stmt = $this->db->prepare("DELETE FROM public.foto WHERE uuid = ?");
        return $stmt->execute([$uuid]);
    }
}
