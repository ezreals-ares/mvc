<?php
// Model: Berisi semua query database untuk tabel 'berita'
class Berita
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Ambil semua berita
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM public.berita ORDER BY tanggal DESC, created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil satu berita berdasarkan UUID
    public function getById($uuid)
    {
        $stmt = $this->db->prepare("SELECT * FROM public.berita WHERE uuid = ?");
        $stmt->execute([$uuid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buat berita baru
    public function create($judul, $tanggal, $tempat, $deskripsi, $kategori)
    {
        $sql = "INSERT INTO public.berita (judul, tanggal, tempat, deskripsi, kategori, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$judul, $tanggal, $tempat, $deskripsi, $kategori]);
    }

    // Update berita
    public function update($uuid, $judul, $tanggal, $tempat, $deskripsi, $kategori)
    {
        $sql = "UPDATE public.berita SET 
                judul = ?, 
                tanggal = ?, 
                tempat = ?, 
                deskripsi = ?, 
                kategori = ?, 
                updated_at = CURRENT_TIMESTAMP 
                WHERE uuid = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$judul, $tanggal, $tempat, $deskripsi, $kategori, $uuid]);
    }

    // Hapus berita
    public function delete($uuid)
    {
        $stmt = $this->db->prepare("DELETE FROM public.berita WHERE uuid = ?");
        return $stmt->execute([$uuid]);
    }
}
