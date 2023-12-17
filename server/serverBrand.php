<?php
error_reporting(1); // error ditampilkan 


include "Database.php";
// buat objek baru dari class Database
$abc = new Database();

// function untuk menghapus selain huruf dan angka 
if(isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin:{$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials:true');
    header('Access-Control-Max-Age:86400');
}
if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header('Access-Control-Allow-Method:OPTIONS GET, POST, OPTIONS');
    if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS)']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

$postdata = file_get_contents("php://input");

function filter($data) {
    $data = preg_replace('/[^a-zA-Z0-9]/', ' ', $data);
    return $data;
    unset($data);
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode($postdata);
    $id_brand = $data->id_brand; // Ubah 'id product' menjadi 'id_product'
    $nama_brand = $data->nama_brand;
    $tahun = $data->tahun;
    $alamat = $data->alamat;
    $aksi = $data->aksi;

    if($aksi == 'tambah') {
        $data2 = array(
            'id_brand' => $id_brand,
            'nama_brand' => $nama_brand,
            'tahun' => $tahun,
            'alamat' => $alamat,
        );

        $abc->tambah_dataBrand($data2);
    } elseif($aksi == 'ubah') {
        $data2 = array(
            'id_brand' => $id_brand,
            'nama_brand' => $nama_brand,
            'tahun' => $tahun,
            'alamat' => $alamat,
        );
        $abc->ubah_dataBrand($data2);
    } elseif($aksi == 'hapus') { // Ubah '=' menjadi '==' untuk memeriksa kesamaan
        $abc->hapus_dataBrand($id_brand);
    }

    // hapus variabel dari memori
    unset($input, $data, $data2, $id_brand, $nama_brand, $tahun, $alamat, $aksi, $abc);
} elseif($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(($_GET['aksi'] == 'tampil') and (isset($_GET['id_brand']))) {
        $id_brand = filter($_GET['id_brand']); // Ubah 'id product' menjadi 'id_product'
        $data = $abc->tampil_dataBrand($id_brand); // Ubah 'tampil data' menjadi 'tampil_data'
        echo json_encode($data);
    } else { //menampilkan semua data
        $data = $abc->tampil_semua_dataBrand();
        echo json_encode($data);
    }
    unset($postdata, $data, $id_brand, $abc);
}

?>