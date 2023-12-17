<?php
include "ClientLogin.php";

if($_POST['aksi'] == 'tambah') {
    $data = array(
        "id_user" => $_POST['id_user'], 
        "username" => $_POST['username'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "role" => $_POST['role'],
        "aksi" => $_POST['aksi']
    );
    $abc->tambah_dataUser($data);
    header('location:viewUser.php');
} else if($_POST['aksi'] == 'ubah') {
    $data = array(
        "id_user" => $_POST['id_user'],
        "username" => $_POST['username'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "role" => $_POST['role'],
        "aksi" => $_POST['aksi']
    );
    $abc->ubah_dataUser($data);
    header('location: viewUser.php');
} else if($_GET['aksi'] == 'hapus') {
    $data = array(
        "id_user" => $_GET['id_user'],
        "aksi" => $_GET['aksi']
    );
    $abc->hapus_dataUser($data);
    header('location: viewUser.php');
}

unset($abc, $data);