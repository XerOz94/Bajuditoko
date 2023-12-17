<?php
error_reporting(1);
include_once 'core.php';
include_once 'lib/php-jwt/src/BeforeValidException.php';
include_once 'lib/php-jwt/src/ExpiredException.php';
include_once 'lib/php-jwt/src/SignatureInvalidException.php';
include_once 'lib/php-jwt/src/JWT.php';

use \Firebase\JWT\JWT;

include_once "Database.php";
$abc = new Database();

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header("Content-Type: application/json; charset=UTF-8");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 3600'); // cache selama 1 jam
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET,POST,OPTIONS");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

$postdata = file_get_contents("php://input");
$data = json_decode($postdata);

function filter($data)
{
    $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
    return $data;
    unset($data);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($data->email) and isset($data->password)) {
    $data2['email'] = $data->email;
    $data2['password'] = $data->password;

    // cek login pengguna
    $data3 = $abc->login($data2);
    if ($data3) {
        // generate json web token (jwt)
        $token = array(
            "iat" => $issued_at,
            "exp" => $expiration_time,
            "iss" => $issuer,
            "data" => array(
                "email" => $data3['email'],
                "username" => $data3['username'],
                "id_user" => $data3['id_user'],
                "role" => $data3['role']
            )
        );
        // set response code
        http_response_code(200);
        // generate jwt
        $jwt = JWT::encode($token, $key);
        echo json_encode(
            array(
                "message" => "Login sukses",
                "email" => $data3['email'],
                "username" => $data3['username'],
                "id_user" => $data3['id_user'],
                "role" => $data3['role'],
                "jwt" => $jwt
            )
        );
    } else { // login gagal 
        // set response code
        http_response_code(401);
        echo json_encode(array("message" => "Login gagal"));
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jwt = $data->jwt;
    $aksi = $data->aksi;
    $id_product = $data->id_product; // Ubah 'id product' menjadi 'id_product'
    $id_brand = $data->id_brand; // Ubah 'id product' menjadi 'id_product'
    $nama_brand = $data->nama_brand; // Ubah 'id product' menjadi 'id_product'
    $nama_product = $data->nama_product;
    $imageUrl = $data->imageUrl;
    $harga = $data->harga;
    $stok = $data->stok;
    $deskripsi = $data->deskripsi;
    // decode jwt
    try {
        JWT::decode($jwt, $key, array('HS256'));

        if ($aksi == 'tambah') {
            $data2 = array(
                'aksi' => $aksi,
                'id_product' => $id_product,
                'id_brand' => $id_brand,
                'nama_product' => $nama_product,
                'imageUrl' => $imageUrl,
                'stok' => $stok,
                'harga' => $harga,
                'deskripsi' => $deskripsi
            );
            $abc->tambah_data($data2);
        } elseif ($aksi == 'ubah') {
            $data2 = array(
                'aksi' => $aksi,
                'id_product' => $id_product,
                'id_brand' => $id_brand,
                'nama_product' => $nama_product,
                'imageUrl' => $imageUrl,
                'stok' => $stok,
                'harga' => $harga,
                'deskripsi' => $deskripsi
            );
            $abc->ubah_data($data2);
        } elseif ($aksi == 'hapus') {
            $data2 = array(
                'aksi' => $aksi,
                'id_product' => $id_product
            );
            $abc->hapus_data($id_product);
        }

        // set response code
        http_response_code(200);
        echo json_encode($data2);

        // jika decode gagal, berarti jwt tidak valid
    } catch (Exception $e) {   // set response code
        http_response_code(401);
        echo json_encode(array(
            "message" => "Acces denied"
        ));
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $jwt = $_GET['jwt'];
    // decode jwt
    try {
        $decoded = JWT::decode($jwt, $key, array('HS256'));

        if (($_GET['aksi'] == 'tampil') and (isset($_GET['id_product']))) {
            $id_product = filter($_GET['id_product']);
            $data = $abc->tampil_data($id_product);
        } else  //menampilkan semua data 
        {
            $data = $abc->tampil_semua_data();
        }

        // set response code
        http_response_code(200);
        echo json_encode($data);

        // jika decode gagal, berarti jwt tidak valid
    } catch (Exception $e) {   // set response code
        http_response_code(401);
        echo json_encode(array(
            "message" => "Acces denied"
        ));
    }
} else { // error jika tanpa jwt
    // set response code
    http_response_code(401);
    echo json_encode(array("message" => "Acces denied"));
}
unset($abc, $postdata, $data, $data2, $data3, $token, $key, $issued_at, $expiration_time, $issuer, $jwt, $id_product, $id_brand, $nama_product, $imageUrl, $stok, $harga, $deskripsi, $aksi, $e);
