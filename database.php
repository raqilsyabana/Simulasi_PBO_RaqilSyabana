<?php
// file: koneksi/database.php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "db_simulasi_pbo_ti1c_raqilsyabana";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            // Menggunakan PDO untuk koneksi database
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                $this->username, 
                $this->password
            );
            // Mengatur error mode ke Exception untuk mempermudah debugging
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Koneksi database gagal: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>