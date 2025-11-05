<?php
// Model: Query untuk tabel 'sosmed'
class Sosmed
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM public.sosmed ORDER BY nama ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($uuid)
    {
        $stmt = $this->db->prepare("SELECT * FROM public.sosmed WHERE uuid = ?");
        $stmt->execute([$uuid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buat sosmed baru
    public function create($nama, $url)
    {
        $sql = "INSERT INTO public.sosmed (nama, url) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nama, $url]);
    }

    // Update sosmed
    public function update($uuid, $nama, $url)
    {
        $sql = "UPDATE public.sosmed SET 
                nama = ?, 
                url = ?
                WHERE uuid = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nama, $url, $uuid]);
    }

    // Hapus sosmed
    public function delete($uuid)
    {
        $stmt = $this->db->prepare("DELETE FROM public.sosmed WHERE uuid = ?");
        return $stmt->execute([$uuid]);
    }
}
