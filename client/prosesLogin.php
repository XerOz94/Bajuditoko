<?php
include "ClientLogin.php";


if ($_POST['aksi'] == 'login') {
    $data = array(
        "email" => $_POST['email'],
        'password' => $_POST['password'],
        'aksi' => $_POST['login']
    );
    $data2 = $abc->login($data);

    if ($data2) {
        setcookie('jwt', $data2->jwt, time() + 3600);
        setcookie('id_user', $data2->id_user, time() + 3600);
        setcookie('email', $data2->email, time() + 3600);
        setcookie('username', $data2->username, time() + 3600);
        setcookie('role', $data2->role, time() + 3600);
        header('location:index.php');
    } else {
        header('location:ViewProduct.php');
    }
} else if ($_POST['aksi'] == 'tambah') {
    $data = array(
        "id_product" => $_POST['id_product'],
        "id_brand" => $_POST['id_brand'],
        "nama_product" => $_POST['nama_product'],
        "imageUrl" => $_POST['imageUrl'],
        "stok" => $_POST['stok'],
        "harga" => $_POST['harga'],
        "deskripsi" => $_POST['deskripsi'],
        "jwt" => $_POST['jwt'],
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
        "jwt" => $_POST['jwt'],
        "aksi" => $_POST['aksi']
    );
    $abc->ubah_data($data);
    header('location:ViewProduct.php');
} else if ($_GET['aksi'] == 'hapus') {
    $data = array(
        "id_product" => $_GET['id_product'],
        "jwt" => $_POST['jwt'],
        "aksi" => $_GET['aksi']
    );
    $abc->hapus_data($data);
    header('location:ViewProduct.php');
    
} else if ($_GET['aksi'] == 'logout') {
    setcookie('jwt', '', time() - 3600);
    setcookie('id_user', '', time() - 3600);
    setcookie('email', '', time() - 3600);
    setcookie('username', '', time() - 3600);
    header('location:login.php');
}
unset($abc, $data, $data2);

unset($abc, $data);