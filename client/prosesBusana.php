<?php
include "ClientLogin.php";

if ($_POST['aksi'] == 'tambah') {
    $data = array(
        "id_busana" => $_POST['id_busana'],
        "id_brand" => $_POST['id_brand'],
        "nama_busana" => $_POST['nama_busana'],
        "imageUrl" => $_POST['imageUrl'],
        "stok" => $_POST['stok'],
        "harga" => $_POST['harga'],
        "deskripsi" => $_POST['deskripsi'],
        "aksi" => $_POST['aksi']
    );
    $abc->tambah_dataBusana($data);
    header('location:ViewBusana.php');
} else if ($_POST['aksi'] == 'ubah') {
    $data = array(
        "id_busana" => $_POST['id_busana'],
        "id_brand" => $_POST['id_brand'],
        "nama_busana" => $_POST['nama_busana'],
        "imageUrl" => $_POST['imageUrl'],
        "stok" => $_POST['stok'],
        "harga" => $_POST['harga'],
        "deskripsi" => $_POST['deskripsi'],
        "aksi" => $_POST['aksi']
    );
    $abc->ubah_dataBusana($data);
    header('location:ViewBusana.php');
} else if ($_GET['aksi'] == 'hapus') {
    $data = array(
        "id_busana" => $_GET['id_busana'],
        "aksi" => $_GET['aksi']
    );
    $abc->hapus_dataBusana($data);
    header('location:ViewBusana.php');
}

unset($abc, $data);