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
    public function login($data)
    {
        $query = $this->conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
        $query->execute(array($data['email'], $data['password']));
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($data);
    }

    public function tampil_data($id_product)
    {
        $query = $this->conn->prepare("SELECT p.id_product, p.id_brand, p.nama_product, p.imageUrl, p.stok, p.harga, p.deskripsi, b.nama_brand
        FROM product p
        INNER JOIN brand b ON p.id_brand = b.id_brand
        WHERE p.id_product = ?
        ");
        $query->execute(array($id_product));
        // mengambil satu data dengan fetch
        $data = $query->fetch(PDO::FETCH_ASSOC); // mengembalikan data
        return $data;
        // hapus variable dari memory
        $query->closeCursor();
        unset($id_product, $data);
    }

    public function tampil_semua_data()
    {
        $query = $this->conn->prepare("SELECT p.id_product, p.id_brand, p.nama_product, p.imageUrl, p.stok, p.harga, p.deskripsi, b.nama_brand
        FROM product p
        INNER JOIN brand b ON p.id_brand = b.id_brand ORDER BY p.id_product");
        $query->execute();
        // mengambil banyak data dengan fetchAll
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($data);
    }

    public function tambah_data($data)
    {
        $query = $this->conn->prepare("insert ignore into product (id_product, id_brand, nama_product, imageUrl, stok, harga, deskripsi) values (?,?,?,?,?,?,?)");
        $query->execute(array($data['id_product'], $data['id_brand'], $data['nama_product'],$data['imageUrl'], $data['stok'], $data['harga'], $data['deskripsi'], ));
        $query->closeCursor();
        unset($data);
    }

    public function ubah_data($data)
    {
        try {
            $query = $this->conn->prepare("UPDATE product SET id_brand=?, nama_product=?, imageUrl=?, stok=?, harga=?, deskripsi=? WHERE id_product=?");
            $query->execute(array($data['id_brand'], $data['nama_product'], $data['imageUrl'], $data['stok'], $data['harga'], $data['deskripsi'], $data['id_product']));
            $query->closeCursor();
            unset($data);
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            // Handle any database-related errors here.
            // You can log the error, display a user-friendly message, or take appropriate action.
        }
    }

    public function hapus_data($id_product)
    {
        $query = $this->conn->prepare("delete from product where id_product=?");
        $query->execute(array($id_product));
        $query->closeCursor();
        unset($id_product);
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

    // DATABASE USER

    public function tampil_dataUser($id_user)
    {
        $query = $this->conn->prepare("select id_user, username, email, password, role from users where id_user=?");
        $query->execute(array($id_user));
        // mengambil satu data dengan fetch
        $data = $query->fetch(PDO::FETCH_ASSOC); // men gembalikan data
        return $data;
        // hapus variable dari memory
        $query->closeCursor();
        unset($id_user, $data);
    }

    public function tampil_semua_dataUser()
    {
        $query = $this->conn->prepare("select id_user, username, email, password, role from users order by id_user");
        $query->execute();
        // mengambil banyak data dengan fetchAll
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($data);
    }

    public function tambah_dataUser($data)
    {
        $query = $this->conn->prepare("insert ignore into users (id_user, username, email, password, role) values (?,?,?,?,?)");
        $query->execute(array($data['id_user'], $data['username'], $data['email'], $data['password'], $data['role']));
        $query->closeCursor();
        unset($data);
    }

    public function ubah_dataUser($data)
    {
        try {
            $query = $this->conn->prepare("UPDATE users SET username=?, email=?, password=?, role=? WHERE id_user=?");
            $query->execute(array($data['username'], $data['email'], $data['password'], $data['role'], $data['id_user']));
            $query->closeCursor();
            unset($data);
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            // Handle any database-related errors here.
            // You can log the error, display a user-friendly message, or take appropriate action.
        }
    }

    public function hapus_dataUser($id_user)
    {
        $query = $this->conn->prepare("delete from user where id_user=?");
        $query->execute(array($id_user));
        $query->closeCursor();
        unset($id_user);
    }

    // DATABASE TRANSAKSI
    public function tampil_dataTransaksi($id_transaksi)
    {
        $query = $this->conn->prepare("SELECT p.id_transaksi, p.id_user, p.id_product, p.tanggal_transaksi, p.jumlah, p.total_harga, p.tujuan, p.metode_pembayaran, b.username, c.nama_product
        FROM transaksi p
        INNER JOIN users b ON p.id_user = b.id_user
        INNER JOIN product c ON p.id_product = c.id_product
        WHERE p.id_transaksi = ?");
        $query->execute(array($id_transaksi));
        // mengambil satu data dengan fetch
        $data = $query->fetch(PDO::FETCH_ASSOC); // men gembalikan data
        return $data;
        // hapus variable dari memory
        $query->closeCursor();
        unset($id_transaksi, $data);
    }

    public function tampil_semua_dataTransaksi()
    {
        $query = $this->conn->prepare("SELECT p.id_transaksi, p.id_user, p.id_product, p.tanggal_transaksi, p.jumlah, p.total_harga, p.tujuan, p.metode_pembayaran, b.username, c.nama_product
         FROM transaksi p
        INNER JOIN users b ON p.id_user = b.id_user
        INNER JOIN product c ON p.id_product = c.id_product ORDER BY p.id_transaksi");
        $query->execute();
        // mengambil banyak data dengan fetchAll
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($data);
    }

    public function tambah_dataTransaksi($data)
    {
        $query = $this->conn->prepare("insert ignore into transaksi (id_transaksi, id_user, id_product, tanggal_transaksi, jumlah, total_harga, tujuan, metode_pembayaran) values (?,?,?,?,?,?,?,?)");
        $query->execute(array($data['id_transaksi'],$data['id_user'],$data['id_product'], $data['tanggal_transaksi'],$data['jumlah'], $data['total_harga'],$data['tujuan'], $data['metode_pembayaran']));
        $query->closeCursor();
        unset($data);
    }

    public function ubah_dataTransaksi($data)
    {
        try {
            $query = $this->conn->prepare("UPDATE transaksi SET id_user=?, id_product=?, tanggal_transaksi=?, jumlah=? total_harga=?, tujuan = ?, metode_pembayaran=?, WHERE id_transaksi=?");
            $query->execute(array($data['id_user'],$data['id_product'], $data['tanggal_transaksi'],$data['jumlah'], $data['total_harga'],$data['tujuan'], $data['metode_pembayaran'],$data['id_transaksi']));
            $query->closeCursor();
            unset($data);
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            // Handle any database-related errors here.
            // You can log the error, display a user-friendly message, or take appropriate action.
        }
    }

    public function hapus_dataTransaksi($id_transaksi)
    {
        $query = $this->conn->prepare("delete from transaksi where id_transaksi=?");
        $query->execute(array($id_transaksi));
        $query->closeCursor();
        unset($id_transaksi);
    }

}
