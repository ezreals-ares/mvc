<?php
// Model: Query untuk tabel 'fasilitas'
class Fasilitas
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM public.fasilitas ORDER BY nama ASC, created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($uuid)
    {
        $stmt = $this->db->prepare("SELECT * FROM public.fasilitas WHERE uuid = ?");
        $stmt->execute([$uuid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buat fasilitas baru
    public function create($nama, $deskripsi, $kuantitas, $path_gambar)
    {
        $sql = "INSERT INTO public.fasilitas (nama, deskripsi, kuantitas, path_gambar, created_at, updated_at) 
                VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nama, $deskripsi, $kuantitas, $path_gambar]);
    }

    // Update fasilitas
    public function update($uuid, $nama, $deskripsi, $kuantitas, $path_gambar = null)
    {
        // Jika path_gambar tidak null, update gambarnya.
        if ($path_gambar) {
            $sql = "UPDATE public.fasilitas SET 
                    nama = ?, deskripsi = ?, kuantitas = ?, path_gambar = ?, updated_at = CURRENT_TIMESTAMP 
                    WHERE uuid = ?";
            $params = [$nama, $deskripsi, $kuantitas, $path_gambar, $uuid];
        } else {
            // Jika null, biarkan gambar lama.
            $sql = "UPDATE public.fasilitas SET 
                    nama = ?, deskripsi = ?, kuantitas = ?, updated_at = CURRENT_TIMESTAMP 
                    WHERE uuid = ?";
            $params = [$nama, $deskripsi, $kuantitas, $uuid];
        }
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    // Hapus fasilitas
    public function delete($uuid)
    {
        // Hapus file gambar fisik dulu
        $fasilitas = $this->getById($uuid);
        if ($fasilitas && $fasilitas['path_gambar'] && file_exists($fasilitas['path_gambar'])) {
            unlink($fasilitas['path_gambar']);
        }

        $stmt = $this->db->prepare("DELETE FROM public.fasilitas WHERE uuid = ?");
        return $stmt->execute([$uuid]);
    }
}
