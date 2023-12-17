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
    $id_user = $data->id_user; // Ubah 'id product' menjadi 'id_product'
    $username = $data->username;
    $email = $data->email;
    $password = $data->password;
    $role = $data->role;
    $aksi = $data->aksi;

    if($aksi == 'tambah') {
        $data2 = array(
            'id_user' => $id_user,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role' => $role,
        );

        $abc->tambah_dataUser($data2);
    } elseif($aksi == 'ubah') {
        $data2 = array(
            'id_user' => $id_user,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role' => $role,
        );
        $abc->ubah_dataUser($data2);
    } elseif($aksi == 'hapus') { // Ubah '=' menjadi '==' untuk memeriksa kesamaan
        $abc->hapus_dataUser($id_user);
    }

    // hapus variabel dari memori
    unset($input, $data, $data2, $id_user, $username, $email, $password, $role, $aksi, $abc);
} elseif($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(($_GET['aksi'] == 'tampil') and (isset($_GET['id_user']))) {
        $id_user = filter($_GET['id_user']); // Ubah 'id product' menjadi 'id_product'
        $data = $abc->tampil_dataUser($id_user); // Ubah 'tampil data' menjadi 'tampil_data'
        echo json_encode($data);
    } else { //menampilkan semua data
        $data = $abc->tampil_semua_dataUser();
        echo json_encode($data);
    }
    unset($postdata, $data, $id_user, $abc);
}

?>