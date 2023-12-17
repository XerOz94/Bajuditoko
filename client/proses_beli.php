<?php
include 'ClientLogin.php';
include 'prosesTransaksi.php';
var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['aksi']) && $_POST['aksi'] == 'beli') {
    if (isset($_POST['id_product'])) {
        // Loop untuk setiap produk yang dipilih
        foreach ($_POST['id_product'] as $id_product) {
            // Tangkap data dari form
            $id_transaksi = generateUniqueID(); // Ganti dengan fungsi pembuatan ID unik
            $id_user = $_COOKIE['jwt'];
            $tanggal_transaksi = date('Y-m-d H:i:s');
            $total_harga = $_POST['harga']; // Ganti dengan harga yang sesuai
            $metode_pembayaran = 'Metosde Pembayaran'; // Ganti dengan metode pembayaran yang sesuai

            // Simpan data transaksi ke database
            $data = array(
                "id_transaksi" => $id_transaksi,
                "id_user" => $id_user,
                "tanggal_transaksi" => $tanggal_transaksi,
                "total_harga" => $total_harga,
                "metode_pembayaran" => $metode_pembayaran,
                "id_product" => $id_product,
                "aksi" => 'tambah'
            );
            $abc->tambah_dataTransaksi($data);
        }

        // Redirect ke halaman transaksi setelah pembelian semua produk
        header('location:ViewTransaksi.php');
        exit;
    }
} else {
    // Jika aksi tidak sesuai, redirect ke halaman lain atau tampilkan pesan error
    header('location:halaman_lain.php');
    exit;
}
?>