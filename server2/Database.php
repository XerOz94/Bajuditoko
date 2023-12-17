<?php
error_reporting(1); 
require_once('config.php');// error ditampilkan
class Database
{
    private $conn;

    // function yang pertama kali di-load saat class dipanggil
    public function __construct()
    {
        $this->conn = Koneksi::getKoneksi();
    }

    public function tampil_data($id_busana)
    {
        $query = $this->conn->prepare("SELECT p.id_busana, p.id_brand, p.nama_busana, p.imageUrl, p.stok, p.harga, p.deskripsi, b.nama_brand
        FROM busana p
        INNER JOIN brand b ON p.id_brand = b.id_brand
        WHERE p.id_busana = ?
        ");
        $query->execute(array($id_busana));
        // mengambil satu data dengan fetch
        $data = $query->fetch(PDO::FETCH_ASSOC); // mengembalikan data
        return $data;
        // hapus variable dari memory
        $query->closeCursor();
        unset($id_busana, $data);
    }

    public function tampil_semua_data()
    {
        $query = $this->conn->prepare("SELECT p.id_busana, p.id_brand, p.nama_busana, p.imageUrl, p.stok, p.harga, p.deskripsi, b.nama_brand
        FROM busana p
        INNER JOIN brand b ON p.id_brand = b.id_brand ORDER BY p.id_busana");
        $query->execute();
        // mengambil banyak data dengan fetchAll
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($data);
    }

    public function tambah_data($data)
    {
        $query = $this->conn->prepare("insert ignore into busana (id_busana, id_brand, nama_busana, imageUrl, stok, harga, deskripsi) values (?,?,?,?,?,?,?)");
        $query->execute(array($data['id_busana'], $data['id_brand'], $data['nama_busana'],$data['imageUrl'], $data['stok'], $data['harga'], $data['deskripsi'], ));
        $query->closeCursor();
        unset($data);
    }

    public function ubah_data($data)
    {
        try {
            $query = $this->conn->prepare("UPDATE busana SET id_brand=?, nama_busana=?, imageUrl=?, stok=?, harga=?, deskripsi=? WHERE id_busana=?");
            $query->execute(array($data['id_brand'], $data['nama_busana'], $data['imageUrl'], $data['stok'], $data['harga'], $data['deskripsi'], $data['id_busana']));
            $query->closeCursor();
            unset($data);
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            // Handle any database-related errors here.
            // You can log the error, display a user-friendly message, or take appropriate action.
        }
    }

    public function hapus_data($id_busana)
    {
        $query = $this->conn->prepare("delete from busana where id_busana=?");
        $query->execute(array($id_busana));
        $query->closeCursor();
        unset($id_busana);
    }

    // DATABASE BRAND 
    public function tampil_dataBrand($id_brand)
    {
        $query = $this->conn->prepare("select id_brand, nama_brand, tahun, alamat from brand where id_brand=?");
        $query->execute(array($id_brand));
        // mengambil satu data dengan fetch
        $data = $query->fetch(PDO::FETCH_ASSOC); // mengembalikan data
        return $data;
        // hapus variable dari memory
        $query->closeCursor();
        unset($id_brand, $data);
    }

    public function tampil_semua_dataBrand()
    {
        $query = $this->conn->prepare("select id_brand, nama_brand, tahun, alamat from brand order by id_brand");
        $query->execute();
        // mengambil banyak data dengan fetchAll
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($data);
    }

    public function tambah_dataBrand($data)
    {
        $query = $this->conn->prepare("insert ignore into brand (id_brand, nama_brand, tahun, alamat) values (?,?,?,?)");
        $query->execute(array($data['id_brand'], $data['nama_brand'], $data['tahun'], $data['alamat']));
        $query->closeCursor();
        unset($data);
    }

    public function ubah_dataBrand($data)
    {
        try {
            $query = $this->conn->prepare("UPDATE brand SET nama_brand=?, tahun=?, alamat=? WHERE id_brand=?");
            $query->execute(array($data['nama_brand'], $data['tahun'], $data['alamat'], $data['id_brand']));
            $query->closeCursor();
            unset($data);
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            // Handle any database-related errors here.
            // You can log the error, display a user-friendly message, or take appropriate action.
        }
    }

    public function hapus_dataBrand($id_brand)
    {
        $query = $this->conn->prepare("delete from brand where id_brand=?");
        $query->execute(array($id_brand));
        $query->closeCursor();
        unset($id_brand);
    }

}
