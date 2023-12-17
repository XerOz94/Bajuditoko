<?php
include "ClientLogin.php";

if ($_POST['aksi'] == 'tambah') {
    $data = array(
        "id_brand" => $_POST['id_brand'],
        "nama_brand" => $_POST['nama_brand'],
        "tahun" => $_POST['tahun'],
        "alamat" => $_POST['alamat'],
        "aksi" => $_POST['aksi']
    );
    $abc->tambah_dataBrand($data);
    header('location:ViewBrand.php');
} else if ($_POST['aksi'] == 'ubah') {
    $data = array(
        "id_brand" => $_POST['id_brand'],
        "nama_brand" => $_POST['nama_brand'],
        "tahun" => $_POST['tahun'],
        "alamat" => $_POST['alamat'],
        "aksi" => $_POST['aksi']
    );
    $abc->ubah_dataBrand($data);
    header('location:ViewBrand.php');
} else if ($_GET['aksi'] == 'hapus') {
    $data = array(
        "id_brand" => $_GET['id_brand'],
        "aksi" => $_GET['aksi']
    );
    $abc->hapus_dataBrand($data);
    header('location:ViewBrand.php');
}

unset($abc, $data);