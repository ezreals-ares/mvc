<?php
// Model: Query untuk tabel 'profile'
class Profile
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Ambil data profile (kita asumsikan hanya ada satu baris)
    public function get()
    {
        $stmt = $this->db->query("SELECT * FROM public.profile LIMIT 1");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buat data profile baru (jika belum ada)
    public function create($visi, $misi, $sejarah)
    {
        $sql = "INSERT INTO public.profile (visi, misi, sejarah, created_at, updated_at) 
                VALUES (?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$visi, $misi, $sejarah]);
    }

    // Update data profile yang sudah ada
    public function update($uuid, $visi, $misi, $sejarah)
    {
        $sql = "UPDATE public.profile SET 
                visi = ?, 
                misi = ?, 
                sejarah = ?, 
                updated_at = CURRENT_TIMESTAMP 
                WHERE uuid = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$visi, $misi, $sejarah, $uuid]);
    }
}
