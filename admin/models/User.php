<?php
// Model: Query untuk tabel 'users'
class User
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    /**
     * Cari user berdasarkan username
     * @param string $username
     * @return mixed Asosiatif array data user atau false
     */
    public function findByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM public.users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
