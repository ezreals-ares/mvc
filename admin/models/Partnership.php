<?php
// Model: Query untuk tabel 'partnership'
class Partnership
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM public.partnership ORDER BY nama ASC, created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($uuid)
    {
        $stmt = $this->db->prepare("SELECT * FROM public.partnership WHERE uuid = ?");
        $stmt->execute([$uuid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buat partnership baru
    public function create($nama, $logo, $website)
    {
        $sql = "INSERT INTO public.partnership (nama, logo, website, created_at, updated_at) 
                VALUES (?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nama, $logo, $website]);
    }

    // Update partnership
    public function update($uuid, $nama, $website, $logo = null)
    {
        // Jika logo tidak null, update gambarnya. Jika null, biarkan gambar lama.
        if ($logo) {
            $sql = "UPDATE public.partnership SET 
                    nama = ?, logo = ?, website = ?, updated_at = CURRENT_TIMESTAMP 
                    WHERE uuid = ?";
            $params = [$nama, $logo, $website, $uuid];
        } else {
            $sql = "UPDATE public.partnership SET 
                    nama = ?, website = ?, updated_at = CURRENT_TIMESTAMP 
                    WHERE uuid = ?";
            $params = [$nama, $website, $uuid];
        }
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    // Hapus partnership
    public function delete($uuid)
    {
        // Hapus file logo fisik dulu
        $partner = $this->getById($uuid);
        if ($partner && $partner['logo'] && file_exists($partner['logo'])) {
            unlink($partner['logo']);
        }

        $stmt = $this->db->prepare("DELETE FROM public.partnership WHERE uuid = ?");
        return $stmt->execute([$uuid]);
    }
}
