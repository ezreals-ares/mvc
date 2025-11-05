<?php
// Model: Query untuk tabel 'galeri' (album)
class Galeri
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM public.galeri ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($uuid)
    {
        $stmt = $this->db->prepare("SELECT * FROM public.galeri WHERE uuid = ?");
        $stmt->execute([$uuid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($judul, $deskripsi)
    {
        $sql = "INSERT INTO public.galeri (judul, deskripsi, created_at, updated_at) 
                VALUES (?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$judul, $deskripsi]);
    }

    public function update($uuid, $judul, $deskripsi)
    {
        $sql = "UPDATE public.galeri SET 
                judul = ?, 
                deskripsi = ?, 
                updated_at = CURRENT_TIMESTAMP 
                WHERE uuid = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$judul, $deskripsi, $uuid]);
    }

    // Menghapus galeri akan otomatis menghapus fotonya
    // karena 'ON DELETE CASCADE' di FOREIGN KEY db_lai.sql
    public function delete($uuid)
    {
        $stmt = $this->db->prepare("DELETE FROM public.galeri WHERE uuid = ?");
        return $stmt->execute([$uuid]);
    }
}
