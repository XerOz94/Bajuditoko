<?php
include "ClientLogin.php";

if ($_POST['aksi'] == 'tambah') {
    $data = array(
        "id_product" => $_POST['id_product'],
        "id_brand" => $_POST['id_brand'],
        "nama_product" => $_POST['nama_product'],
        "imageUrl" => $_POST['imageUrl'],
        "stok" => $_POST['stok'],
        "harga" => $_POST['harga'],
        "deskripsi" => $_POST['deskripsi'],
        "aksi" => $_POST['aksi']
    );
    $abc->tambah_data($data);
    header('location:ViewProduct.php');
} else if ($_POST['aksi'] == 'ubah') {
    $data = array(
        "id_product" => $_POST['id_product'],
        "id_brand" => $_POST['id_brand'],
        "nama_product" => $_POST['nama_product'],
        "imageUrl" => $_POST['imageUrl'],
        "stok" => $_POST['stok'],
        "harga" => $_POST['harga'],
        "deskripsi" => $_POST['deskripsi'],
        "aksi" => $_POST['aksi']
    );
    $abc->ubah_data($data);
    header('location:ViewProduct.php');
} else if ($_GET['aksi'] == 'hapus') {
    $data = array(
        "id_product" => $_GET['id_product'],
        "aksi" => $_GET['aksi']
    );
    $abc->hapus_data($data);
    header('location:ViewProduct.php');
}

unset($abc, $data);