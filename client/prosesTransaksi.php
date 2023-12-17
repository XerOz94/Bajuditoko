<?php
include "ClientLogin.php";

if ($_POST['aksi'] == 'tambah') {
    $data = array(
        "id_transaksi" => $_POST['id_transaksi'],
        "id_user" => $_POST['id_user'],
        "id_product" => $_POST['id_product'],
        "tanggal_transaksi" => $_POST['tanggal_transaksi'],
        "jumlah" => $_POST['jumlah'],
        "total_harga" => $_POST['total_harga'],
        "tujuan" => $_POST['tujuan'],
        "metode_pembayaran" => $_POST['metode_pembayaran'],
        "aksi" => $_POST['aksi']
    );
    $abc->tambah_dataTransaksi($data);
    header('location:ViewTransaksi.php');
} else if ($_POST['aksi'] == 'ubah') {
    $data = array(
        "id_transaksi" => $_POST['id_transaksi'],
        "id_user" => $_POST['id_user'],
        "id_product" => $_POST['id_product'],
        "tanggal_transaksi" => $_POST['tanggal_transaksi'],
        "jumlah" => $_POST['jumlah'],
        "total_harga" => $_POST['total_harga'],
        "tujuan" => $_POST['tujuan'],
        "metode_pembayaran" => $_POST['metode_pembayaran'],
        "aksi" => $_POST['aksi']
    );
    $abc->ubah_dataTransaksi($data);
    header('location:ViewTransaksi.php');
} else if ($_GET['aksi'] == 'hapus') {
    $data = array(
        "id_transaksi" => $_GET['id_transaksi'],
        "aksi" => $_GET['aksi']
    );
    $abc->hapus_dataTransaksi($data);
    header('location:ViewTransaksi.php');
}

unset($abc, $data);