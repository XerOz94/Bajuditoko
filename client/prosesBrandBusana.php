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
    $abc->tambah_dataBrandBusana($data);
    header('location:ViewBrandBusana.php');
} else if ($_POST['aksi'] == 'ubah') {
    $data = array(
        "id_brand" => $_POST['id_brand'],
        "nama_brand" => $_POST['nama_brand'],
        "tahun" => $_POST['tahun'],
        "alamat" => $_POST['alamat'],
        "aksi" => $_POST['aksi']
    );
    $abc->ubah_dataBrandBusana($data);
    header('location:ViewBrandBusana.php');
} else if ($_GET['aksi'] == 'hapus') {
    $data = array(
        "id_brand" => $_GET['id_brand'],
        "aksi" => $_GET['aksi']
    );
    $abc->hapus_dataBrandBusana($data);
    header('location:ViewBrandBusana.php');
}

unset($abc, $data);