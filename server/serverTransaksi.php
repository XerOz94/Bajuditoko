<?php
error_reporting(1); // error ditampilkan 


include "Database.php";
// buat objek baru dari class Database
$abc = new Database();

// function untuk menghapus selain huruf dan angka 
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin:{$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials:true');
    header('Access-Control-Max-Age:86400');
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header('Access-Control-Allow-Method:OPTIONS GET, POST, OPTIONS');
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS)']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

$postdata = file_get_contents("php://input");

function filter($data)
{
    $data = preg_replace('/[^a-zA-Z0-9]/', ' ', $data);
    return $data;
    unset($data);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode($postdata);
    $id_transaksi = $data->id_transaksi; // Ubah 'id transaksi' menjadi 'id_transaksi'
    $id_user = $data->id_user; // Ubah 'id transaksi' menjadi 'id_transaksi'
    $id_product = $data->id_product; // Ubah 'id transaksi' menjadi 'id_transaksi'
    $tanggal_transaksi = $data->tanggal_transaksi;
    $jumlah = $data->jumlah;
    $tujuan = $data->tujuan;
    $total_harga = $data->total_harga;
    $metode_pembayaran = $data->metode_pembayaran;
    $aksi = $data->aksi;

    if ($aksi == 'tambah') {
        $data2 = array(
            'id_transaksi' => $id_transaksi,
            'id_user' => $id_user,
            'id_product' => $id_product,
            'tanggal_transaksi' => $tanggal_transaksi,
            'jumlah' => $jumlah,
            'total_harga' => $total_harga,
            'tujuan' => $tujuan,
            'metode_pembayaran' => $metode_pembayaran
        );

        $abc->tambah_dataTransaksi($data2);
    } elseif ($aksi == 'ubah') {
        $data2 = array(
            'id_transaksi' => $id_transaksi,
            'id_user' => $id_user,
            'id_product' => $id_product,
            'tanggal_transaksi' => $tanggal_transaksi,
            'jumlah' => $jumlah,
            'total_harga' => $total_harga,
            'tujuan' => $tujuan,
            'metode_pembayaran' => $metode_pembayaran
        );
        $abc->ubah_dataTransaksi($data2);
    } elseif ($aksi == 'hapus') { // Ubah '=' menjadi '==' untuk memeriksa kesamaan
        $abc->hapus_dataTransaksi($id_transaksi);
    }

    // hapus variabel dari memori,
    unset($input, $data, $data2, $id_transaksi, $id_user, $tanggal_transaksi, $total_harga, $metode_pembayaran, $aksi, $abc);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (($_GET['aksi'] == 'tampil') and (isset($_GET['id_transaksi']))) {
        $id_transaksi = filter($_GET['id_transaksi']); // Ubah 'id transaksi' menjadi 'id_transaksi'
        $data = $abc->tampil_dataTransaksi($id_transaksi); // Ubah 'tampil data' menjadi 'tampil_data'
        echo json_encode($data);
    } else { //menampilkan semua data
        $data = $abc->tampil_semua_dataTransaksi();
        echo json_encode($data);
    }
    unset($postdata, $data, $id_transaksi, $abc);
}

?>