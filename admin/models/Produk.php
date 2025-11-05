<?php
// Model: Query untuk tabel 'produk'
class Produk
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        $sql = "SELECT p.*, a.nama as pembuat_nama 
                FROM public.produk p
                LEFT JOIN public.anggota a ON p.pembuat_id = a.uuid
                ORDER BY p.tahun DESC, p.created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($uuid)
    {
        $stmt = $this->db->prepare("SELECT * FROM public.produk WHERE uuid = ?");
        $stmt->execute([$uuid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nama, $tahun, $pembuat_id, $deskripsi, $link_demo, $path_gambar)
    {
        $sql = "INSERT INTO public.produk (nama, tahun, pembuat_id, deskripsi, link_demo, path_gambar, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $stmt = $this->db->prepare($sql);
        $pembuat_id = empty($pembuat_id) ? null : $pembuat_id;
        return $stmt->execute([$nama, $tahun, $pembuat_id, $deskripsi, $link_demo, $path_gambar]);
    }

    public function update($uuid, $nama, $tahun, $pembuat_id, $deskripsi, $link_demo, $path_gambar = null)
    {
        $pembuat_id = empty($pembuat_id) ? null : $pembuat_id;

        if ($path_gambar) {
            $sql = "UPDATE public.produk SET 
                    nama = ?, tahun = ?, pembuat_id = ?, deskripsi = ?, link_demo = ?, path_gambar = ?, updated_at = CURRENT_TIMESTAMP 
                    WHERE uuid = ?";
            $params = [$nama, $tahun, $pembuat_id, $deskripsi, $link_demo, $path_gambar, $uuid];
        } else {
            $sql = "UPDATE public.produk SET 
                    nama = ?, tahun = ?, pembuat_id = ?, deskripsi = ?, link_demo = ?, updated_at = CURRENT_TIMESTAMP 
                    WHERE uuid = ?";
            $params = [$nama, $tahun, $pembuat_id, $deskripsi, $link_demo, $uuid];
        }
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($uuid)
    {
        $produk = $this->getById($uuid);
        if ($produk && $produk['path_gambar'] && file_exists($produk['path_gambar'])) {
            unlink($produk['path_gambar']);
        }
        $stmt = $this->db->prepare("DELETE FROM public.produk WHERE uuid = ?");
        return $stmt->execute([$uuid]);
    }
}
