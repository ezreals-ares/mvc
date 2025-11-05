<?php
// GANTI DENGAN DETAIL DATABASE ANDA
$host = 'localhost';
$db   = 'db_lai'; // <-- Ganti ini
$user = 'postgres';            // <-- Ganti jika user Anda bukan postgres
$pass = '12345678';       // <-- Ganti dengan password Anda
$port = '5432';

$dsn = "pgsql:host=$host;port=$port;dbname=$db;";

try {
    // Buat koneksi PDO
    $pdo = new PDO($dsn, $user, $pass);

    // Set mode error untuk menampilkan exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Tampilkan pesan error jika koneksi gagal
    die("Koneksi database gagal: " . $e->getMessage());
}
