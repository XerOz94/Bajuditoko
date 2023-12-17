<?php
class Koneksi
{
    private static $host = "localhost";
    private static $dbname = "busanamuslimah";
    private static $user = "root";
    private static $password = "";
    private static $port = "3306";
    private static $conn;

    public static function getKoneksi()
    {
        if (!isset(self::$conn)) {
            try {
                // Koneksi menggunakan MySQLi
                $mysqli = new mysqli(self::$host, self::$user, self::$password, self::$dbname);

                // Cek apakah koneksi MySQLi berhasil
                if ($mysqli->connect_error) {
                    die("Connection failed: " . $mysqli->connect_error);
                }

                // Koneksi PDO menggunakan koneksi MySQLi
                self::$conn = new PDO("mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbname . ";charset=utf8", self::$user, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                echo "Koneksi gagal: " . $e->getMessage();
            }
        }
        return self::$conn;
    }
}
?>
