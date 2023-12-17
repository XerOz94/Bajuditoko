<?php
error_reporting(1);

class ClientLogin
{
    private $url;
    private $url2;

    public function __construct($url, $url2)
    {
        $this->url = $url;
        $this->url2 = $url2;
    }

    public function filter($data)
    {
        $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
        return $data;
        unset($data);
    }

    public function login($data)
    {
        $data = '{
            "email":"' . $data['email'] . '",
            "password":"' . $data['password'] . '",
            "aksi":"' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . 'LoginProduct.php');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        $data2 = json_decode($response);
        return $data2;
        unset($data, $data2, $c, $response);
    }

    public function tampil_semua_data($jwt)
    {
        $client = curl_init($this->url . 'LoginProduct.php' . "?jwt=" . $jwt);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($jwt, $client, $response, $data);
    }
    public function tampil_data($data)
    {
        $id_product = $this->filter($data['id_product']);
        $client = curl_init($this->url . "LoginProduct.php?aksi=tampil&id_product=" . $id_product . "&jwt=" . $data['jwt']);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($id_product, $client, $response, $data);
    }

    public function tambah_data($data)
    {
        $data = '{ 
            "id_product" : "' . $data['id_product'] . '", 
            "id_brand" : "' . $data['id_brand'] . '", 
            "nama_product" : "' . $data['nama_product'] . '", 
            "imageUrl" : "' . $data['imageUrl'] . '", 
            "stok" : "' . $data['stok'] . '", 
            "harga" : "' . $data['harga'] . '", 
            "deskripsi" : "' . $data['deskripsi'] . '", 
            "jwt":"' . $data['jwt'] . '",
            "aksi": "' . $data['aksi'] . '"
        }';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . "ServerProduct.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
    }

    public function ubah_data($data)
    {
        $data = '{ 
            "id_product" : "' . $data['id_product'] . '", 
            "id_brand" : "' . $data['id_brand'] . '", 
            "nama_product" : "' . $data['nama_product'] . '", 
            "imageUrl" : "' . $data['imageUrl'] . '", 
            "stok" : "' . $data['stok'] . '", 
            "harga" : "' . $data['harga'] . '", 
            "deskripsi" : "' . $data['deskripsi'] . '", 
            "jwt":"' . $data['jwt'] . '",
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . "ServerProduct.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
        // You can unset variables here or later as needed.
    }

    public function hapus_data($data)
    {
        $id_product = $this->filter($data['id_product']);
        $data = '{ 
            "id_product" : "' . $id_product . '",
            "jwt":"' . $data['jwt'] . '",
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . "ServerProduct.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($id_product, $data, $c, $response);
        // You can unset variables here or later as needed.
    }

    // Client Brand

    public function tampil_semua_dataBrand()
    {
        $client = curl_init($this->url . 'serverBrand.php');
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($data, $client, $response);
    }
    public function tampil_dataBrand($id_brand)
    {
        $id_brand = $this->filter($id_brand);
        $client = curl_init($this->url . 'serverBrand.php' . "?aksi=tampil&id_brand=" . $id_brand);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($id_brand, $client, $response, $data);
    }

    public function tambah_dataBrand($data)
    {
        $data = '{ 
            "id_brand" : "' . $data['id_brand'] . '", 
            "nama_brand" : "' . $data['nama_brand'] . '", 
            "tahun" : "' . $data['tahun'] . '", 
            "alamat" : "' . $data['alamat'] . '", 
            "aksi": "' . $data['aksi'] . '"
        }';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . 'serverBrand.php');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
    }

    public function ubah_dataBrand($data)
    {
        $data = '{ 
            "id_brand" : "' . $data['id_brand'] . '", 
            "nama_brand" : "' . $data['nama_brand'] . '", 
            "tahun" : "' . $data['tahun'] . '", 
            "alamat" : "' . $data['alamat'] . '", 
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . 'serverBrand.php');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
        // You can unset variables here or later as needed.
    }

    public function hapus_dataBrand($data)
    {
        $id_brand = $this->filter($data['id_brand']);
        $data = '{ "id_brand" : "' . $id_brand . '",
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . 'serverBrand.php');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($id_brand, $data, $c, $response);
        // You can unset variables here or later as needed.
    }
    // Client Brand Busana

    public function tampil_semua_dataBrandBusana()
    {
        $client = curl_init($this->url2 . 'serverBrand.php');
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($data, $client, $response);
    }
    public function tampil_dataBrandBusana($id_brand)
    {
        $id_brand = $this->filter($id_brand);
        $client = curl_init($this->url2 . 'serverBrand.php' . "?aksi=tampil&id_brand=" . $id_brand);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($id_brand, $client, $response, $data);
    }

    public function tambah_dataBrandBusana($data)
    {
        $data = '{ 
        "id_brand" : "' . $data['id_brand'] . '", 
        "nama_brand" : "' . $data['nama_brand'] . '", 
        "tahun" : "' . $data['tahun'] . '", 
        "alamat" : "' . $data['alamat'] . '", 
        "aksi": "' . $data['aksi'] . '"
    }';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url2 . 'serverBrand.php');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
    }

    public function ubah_dataBrandBusana($data)
    {
        $data = '{ 
        "id_brand" : "' . $data['id_brand'] . '", 
        "nama_brand" : "' . $data['nama_brand'] . '", 
        "tahun" : "' . $data['tahun'] . '", 
        "alamat" : "' . $data['alamat'] . '", 
        "aksi": "' . $data['aksi'] . '"
    }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url2 . 'serverBrand.php');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
        // You can unset variables here or later as needed.
    }

    public function hapus_dataBrandBusana($data)
    {
        $id_brand = $this->filter($data['id_brand']);
        $data = '{ "id_brand" : "' . $id_brand . '",
        "aksi": "' . $data['aksi'] . '"
    }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url2 . 'serverBrand.php');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($id_brand, $data, $c, $response);
        // You can unset variables here or later as needed.
    }
    // Client User

    public function tampil_semua_dataUser()
    {
        $client = curl_init($this->url . 'serverUser.php');
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($data, $client, $response);
    }
    public function tampil_dataUser($id_user)
    {
        $id_user = $this->filter($id_user);
        $client = curl_init($this->url . 'serverUser.php' . "?aksi=tampil&id_user=" . $id_user);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($id_user, $client, $response, $data);
    }

    public function tambah_dataUser($data)
    {
        $data = '{ 
            "id_user" : "' . $data['id_user'] . '", 
            "username" : "' . $data['username'] . '", 
            "email" : "' . $data['email'] . '", 
            "password" : "' . $data['password'] . '", 
            "role" : "' . $data['role'] . '", 
            "aksi": "' . $data['aksi'] . '"
        }';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . 'serverUser.php');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
    }

    public function ubah_dataUser($data)
    {
        $data = '{ 
            "id_user" : "' . $data['id_user'] . '", 
            "username" : "' . $data['username'] . '", 
            "email" : "' . $data['email'] . '", 
            "password" : "' . $data['password'] . '", 
            "role" : "' . $data['role'] . '", 
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . 'serverUser.php');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
        // You can unset variables here or later as needed.
    }

    public function hapus_dataUser($data)
    {
        $id_user = $this->filter($data['id_user']);
        $data = '{ "id_user" : "' . $id_user . '",
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . 'serverUser.php');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($id_user, $data, $c, $response);
        // You can unset variables here or later as needed.
    }

    // Client Transaksi

    public function tampil_semua_dataTransaksi()
    {
        $client = curl_init($this->url . 'serverTransaksi.php');
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($data, $client, $response);
    }
    public function tampil_dataTransaksi($id_transaksi)
    {
        $id_transaksi = $this->filter($id_transaksi);
        $client = curl_init($this->url . 'serverTransaksi.php' . "?aksi=tampil&id_transaksi=" . $id_transaksi);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($id_transaksi, $client, $response, $data);
    }

    public function tambah_dataTransaksi($data)
    {
        $data = '{ 
            "id_transaksi" : "' . $data['id_transaksi'] . '", 
            "id_user" : "' . $data['id_user'] . '", 
            "id_product" : "' . $data['id_product'] . '", 
            "tanggal_transaksi" : "' . $data['tanggal_transaksi'] . '", 
            "jumlah" : "' . $data['jumlah'] . '", 
            "total_harga" : "' . $data['total_harga'] . '", 
            "tujuan" : "' . $data['tujuan'] . '", 
            "metode_pembayaran" : "' . $data['metode_pembayaran'] . '", 
            "aksi": "' . $data['aksi'] . '"
        }';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . 'serverTransaksi.php');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
    }

    public function ubah_dataTransaksi($data)
    {
        $data = '{ 
            "id_transaksi" : "' . $data['id_transaksi'] . '", 
            "id_user" : "' . $data['id_user'] . '", 
            "id_product" : "' . $data['id_product'] . '", 
            "tanggal_transaksi" : "' . $data['tanggal_transaksi'] . '", 
            "jumlah" : "' . $data['jumlah'] . '", 
            "total_harga" : "' . $data['total_harga'] . '", 
            "tujuan" : "' . $data['tujuan'] . '", 
            "metode_pembayaran" : "' . $data['metode_pembayaran'] . '", 
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . 'serverTransaksi.php');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
        // You can unset variables here or later as needed.
    }

    public function hapus_dataTransaksi($data)
    {
        $id_transaksi = $this->filter($data['id_transaksi']);
        $data = '{ "id_transaksi" : "' . $id_transaksi . '",
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url . 'serverTransaksi.php');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($id_transaksi, $data, $c, $response);
        // You can unset variables here or later as needed.
    }

    public function tampil_semua_dataBusana()
    {
        $client = curl_init($this->url2 . 'serverbusana.php');
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($data, $client, $response);
    }
    public function tampil_dataBusana($id_busana)
    {
        $id_busana = $this->filter($id_busana);
        $client = curl_init($this->url2 . "serverbusana.php?aksi=tampil&id_busana=" . $id_busana);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;

        unset($id_busana, $client, $response, $data);
    }

    public function tambah_dataBusana($data)
    {
        $data = '{ 
            "id_busana" : "' . $data['id_busana'] . '", 
            "id_brand" : "' . $data['id_brand'] . '", 
            "nama_busana" : "' . $data['nama_busana'] . '", 
            "imageUrl" : "' . $data['imageUrl'] . '", 
            "stok" : "' . $data['stok'] . '", 
            "harga" : "' . $data['harga'] . '", 
            "deskripsi" : "' . $data['deskripsi'] . '", 
            "aksi": "' . $data['aksi'] . '"
        }';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url2 . "serverbusana.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
    }

    public function ubah_dataBusana($data)
    {
        $data = '{ 
            "id_busana" : "' . $data['id_busana'] . '", 
            "id_brand" : "' . $data['id_brand'] . '", 
            "nama_busana" : "' . $data['nama_busana'] . '", 
            "imageUrl" : "' . $data['imageUrl'] . '", 
            "stok" : "' . $data['stok'] . '", 
            "harga" : "' . $data['harga'] . '", 
            "deskripsi" : "' . $data['deskripsi'] . '", 
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url2 . "serverbusana.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
        // You can unset variables here or later as needed.
    }

    public function hapus_dataBusana($data)
    {
        $id_busana = $this->filter($data['id_busana']);
        $data = '{ "id_busana" : "' . $id_busana . '",
            "aksi": "' . $data['aksi'] . '"
        }';
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url2 . "serverbusana.php");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($id_busana, $data, $c, $response);
        // You can unset variables here or later as needed.
    }

    public function __destruct()
    {
        unset($this->url);
        unset($this->url2);
    }
}

$url = 'http://192.168.56.1/restful-bajuditoko/server/';
$url2 = 'http://192.168.56.1/restful-bajuditoko/server2/';  
$abc = new ClientLogin($url, $url2);
?>