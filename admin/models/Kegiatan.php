<?php
// Model: Berisi semua query database untuk tabel 'kegiatan'
class Kegiatan
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Ambil semua kegiatan
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM public.kegiatan ORDER BY tanggal DESC, created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil satu kegiatan berdasarkan UUID
    public function getById($uuid)
    {
        $stmt = $this->db->prepare("SELECT * FROM public.kegiatan WHERE uuid = ?");
        $stmt->execute([$uuid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buat kegiatan baru
    public function create($nama, $tanggal, $pemateri, $kategori, $deskripsi)
    {
        $sql = "INSERT INTO public.kegiatan (nama, tanggal, pemateri, kategori_kegiatan, deskripsi_singkat, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nama, $tanggal, $pemateri, $kategori, $deskripsi]);
    }

    // Update kegiatan
    public function update($uuid, $nama, $tanggal, $pemateri, $kategori, $deskripsi)
    {
        $sql = "UPDATE public.kegiatan SET 
                nama = ?, 
                tanggal = ?, 
                pemateri = ?, 
                kategori_kegiatan = ?, 
                deskripsi_singkat = ?, 
                updated_at = CURRENT_TIMESTAMP 
                WHERE uuid = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nama, $tanggal, $pemateri, $kategori, $deskripsi, $uuid]);
    }

    // Hapus kegiatan
    public function delete($uuid)
    {
        $stmt = $this->db->prepare("DELETE FROM public.kegiatan WHERE uuid = ?");
        return $stmt->execute([$uuid]);
    }
}
