<?php
// Model: Query untuk tabel 'publikasi'
class Publikasi
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Ambil semua publikasi, di-JOIN dengan anggota untuk dapat nama penulis
    public function getAll()
    {
        $sql = "SELECT pub.*, a.nama as penulis_nama 
                FROM public.publikasi pub
                LEFT JOIN public.anggota a ON pub.penulis_id = a.uuid
                ORDER BY pub.tahun DESC, pub.created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil satu publikasi berdasarkan UUID
    public function getById($uuid)
    {
        $stmt = $this->db->prepare("SELECT * FROM public.publikasi WHERE uuid = ?");
        $stmt->execute([$uuid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buat publikasi baru
    public function create($judul, $tahun, $penulis_id, $tautan, $kategori)
    {
        $sql = "INSERT INTO public.publikasi (judul, tahun, penulis_id, tautan, kategori, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $stmt = $this->db->prepare($sql);
        // Set penulis_id ke null jika kosong
        $penulis_id = empty($penulis_id) ? null : $penulis_id;
        return $stmt->execute([$judul, $tahun, $penulis_id, $tautan, $kategori]);
    }

    // Update publikasi
    public function update($uuid, $judul, $tahun, $penulis_id, $tautan, $kategori)
    {
        $penulis_id = empty($penulis_id) ? null : $penulis_id;

        $sql = "UPDATE public.publikasi SET 
                judul = ?, 
                tahun = ?, 
                penulis_id = ?, 
                tautan = ?, 
                kategori = ?, 
                updated_at = CURRENT_TIMESTAMP 
                WHERE uuid = ?";
        $params = [$judul, $tahun, $penulis_id, $tautan, $kategori, $uuid];

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    // Hapus publikasi
    public function delete($uuid)
    {
        $stmt = $this->db->prepare("DELETE FROM public.publikasi WHERE uuid = ?");
        return $stmt->execute([$uuid]);
    }
}
