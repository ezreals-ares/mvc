<?php
// Model: Query untuk tabel 'anggota'
class Anggota
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM public.anggota ORDER BY nama ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($uuid)
    {
        $stmt = $this->db->prepare("SELECT * FROM public.anggota WHERE uuid = ?");
        $stmt->execute([$uuid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // path_gambar diisi oleh controller
    public function create($nama, $nidn, $jabatan, $status, $path_gambar)
    {
        $sql = "INSERT INTO public.anggota (nama, nidn, jabatan, status, path_gambar, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nama, $nidn, $jabatan, $status, $path_gambar]);
    }

    // path_gambar diisi oleh controller
    public function update($uuid, $nama, $nidn, $jabatan, $status, $path_gambar = null)
    {
        // Jika path_gambar tidak null, update gambarnya. Jika null, biarkan gambar lama.
        if ($path_gambar) {
            $sql = "UPDATE public.anggota SET nama = ?, nidn = ?, jabatan = ?, status = ?, path_gambar = ?, updated_at = CURRENT_TIMESTAMP WHERE uuid = ?";
            $params = [$nama, $nidn, $jabatan, $status, $path_gambar, $uuid];
        } else {
            $sql = "UPDATE public.anggota SET nama = ?, nidn = ?, jabatan = ?, status = ?, updated_at = CURRENT_TIMESTAMP WHERE uuid = ?";
            $params = [$nama, $nidn, $jabatan, $status, $uuid];
        }
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($uuid)
    {
        // (PENTING: Kita juga harus hapus file gambar dari server)
        $anggota = $this->getById($uuid);
        if ($anggota && $anggota['path_gambar'] && file_exists($anggota['path_gambar'])) {
            unlink($anggota['path_gambar']); // Hapus file fisik
        }

        $stmt = $this->db->prepare("DELETE FROM public.anggota WHERE uuid = ?");
        return $stmt->execute([$uuid]);
    }
}
