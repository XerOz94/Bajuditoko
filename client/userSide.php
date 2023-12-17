<?php
error_reporting(1);
include 'ClientLogin.php';
include '../server/config.php';

$database = new Koneksi();
// Mendapatkan koneksi PDO
$conn = $database::getKoneksi();

?>
<?php if (isset($_COOKIE['jwt'])) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="../assets/img/favicon.png">
        <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <title>
            Bajuditoko
        </title>
        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css"
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
        <!-- Nucleo Icons -->
        <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
        <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        <!-- CSS Files -->
        <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
        <!-- Nepcha Analytics (nepcha.com) -->
        <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
        <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    </head>

    <body class="g-sidenav-show  bg-gray-200">
        <?php
        if ($_COOKIE['role'] == 'Admin') {
            include 'sidebar.php';
        } else if ($_COOKIE['role'] == 'User') { ?>
                <aside
                    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
                    id="sidenav-main">
                    <div class="sidenav-header">
                        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                            aria-hidden="true" id="iconSidenav"></i>
                        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
                            target="_blank">
                            <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
                            <span class="ms-1 font-weight-bold text-white">Bajuditoko</span>
                        </a>
                    </div>
                    <hr class="horizontal light mt-0 mb-2">
                    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-white active bg-gradient-primary" href="index.php">
                                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                        <i class="material-icons opacity-10">dashboard</i>
                                    </div>
                                    <span class="nav-link-text ms-1">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white " href="userSide.php">
                                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                        <i class="material-icons opacity-10">table_view</i>
                                    </div>
                                    <span class="nav-link-text ms-1">Busana Muslim/Muslimah</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="sidenav-footer position-absolute w-100 bottom-5">
                        <div class="mx-3">
                            <a href="prosesLogin.php?aksi=logout" onclick="return confirm('Apakah Anda ingin Logout?')"
                                class="btn bg-gradient-primary w-100">Logout</a>
                        </div>
                    </div>
                    </div>
                </aside>
        <?php } ?>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
                data-scroll="true">
                <div class="container-fluid py-1 px-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                    href="javascript:;">Halaman</a></li>
                            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">Dashboard</h6>
                    </nav>
                </div>
            </nav>
            <!-- End Navbar -->
            <!-- BODY -->
            <div class="container-fluid px-4 py-5">
                <div class="row">
                    <h3>Busana Muslim</h3>
                    <?php
                    $no = 1;
                    $data_array = $abc->tampil_semua_data($_COOKIE['jwt']);
                    foreach ($data_array as $r) {
                        ?>
                        <div class="col-lg-3 py-3">
                            <div class="card">
                                <div class="card-header text-center">
                                    <a class="d-block blur-shadow-image">
                                        <img src="<?= $r->imageUrl ?>" alt="img-blur-shadow"
                                            class="img-fluid img-fluid shadow border-radius-lg"
                                            style="width: 300px; height: 250px;">
                                    </a>
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="font-weight-normal mt-0">
                                        <a href="">
                                            <?= $r->nama_product ?>
                                        </a>
                                    </h5>
                                    <p class="mb-0">
                                        <?= $r->deskripsi ?>
                                    </p>
                                </div>

                                <hr class="dark horizontal my-0">
                                <div class="card-footer d-flex">
                                    <p class="text-sm my-auto">Rp
                                        <?= $r->harga ?>
                                    </p>
                                    <i class="material-icons position-relative ms-auto text-lg me-1 my-auto"></i>
                                    <p class="text-sm my-auto">Stok:
                                        <?= $r->stok ?>
                                    </p>
                                    <i class="material-icons position-relative ms-auto text-lg me-1 my-auto">badge</i>
                                    <p class="text-sm my-auto">
                                        <?= $r->nama_brand ?>
                                    </p>
                                </div>
                                <hr class="dark horizontal my-0">
                                <div class="card-footer text-center">
                                    <a href="#">
                                        <button type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal"
                                            data-bs-target="#beliModal<?= $r->id_product ?>" name="ubah"
                                            data-id="<?= $r->id_product ?>">
                                            Beli
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="beliModal<?= $r->id_product ?>" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Beli Product</h5>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="prosesTransaksi.php" method="POST" name="form" class="px-4 py-4">
                                            <div class="row" id="alternatif-container">
                                                <!-- Kolom pertama -->
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-outline my-3">
                                                        <input type="hidden" name="aksi" value="tambah" />
                                                        <input type="hidden" name="id_transaksi" value="" />
                                                        <input type="hidden" name="id_user"
                                                            value="<?= $_COOKIE['id_user'] ?>" />
                                                        <input type="hidden" name="id_product" value="<?= $r->id_product ?>" />
                                                        <label class="form-label">Product</label>
                                                        <input type="text" name="nama_product" class="form-control"
                                                            value="<?= $r->nama_product ?>" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label class="form-label">Harga Satuan</label>
                                                        <input type="text" name="harga" class="form-control"
                                                            value="<?= $r->harga ?>" readonly>
                                                    </div>
                                                </div>
                                                <!-- Kolom kedua -->
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label class="form-label">Tanggal Transaksi</label>
                                                        <input type="date" name="tanggal_transaksi" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label class="form-label">Jumlah Beli</label>
                                                        <input type="number" id="jumlah" name="jumlah" class="form-control">
                                                    </div>
                                                </div>
                                                <!-- Kolom kedua -->
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label class="form-label">Alamat Tujuan</label>
                                                        <input type="text" name="tujuan" class="form-control">
                                                    </div>
                                                </div>
                                                <!-- Kolom kedua -->
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-outline my-3">
                                                        <select class="form-control" id="metode_pembayaran"
                                                            name="metode_pembayaran">
                                                            <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                                            <option value="Transfer BRI">Go-Pay</option>
                                                            <option value="Shopee Pay">Shopee Pay</option>
                                                            <option value="BRI">COD</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="total_harga" name="total_harga" value="" />
                                            <hr class="dark horizontal my-4">
                                            <h4 id="totalTransaksi">Total Transaksi: 0
                                            </h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary" id="hitung"
                                            name="hitung">Hitung</button>
                                        <button type="submit" name="simpan" class="btn bg-gradient-success">Pesan
                                            Sekarang</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function () {
                                // Menangkap event input pada elemen dengan id "jumlah"
                                $('#jumlah').on('input', function () {
                                    // Mengambil nilai input jumlah
                                    var jumlah = $(this).val();

                                    // Mendapatkan harga dari elemen yang bersesuaian, gantilah dengan id atau class yang sesuai
                                    var harga = <?= $r->harga ?> - 10000;

                                    // Melakukan perhitungan total transaksi
                                    var totalTransaksi = harga * jumlah;

                                    // Menampilkan total transaksi
                                    $('#totalTransaksi').text('Total Transaksi: ' + totalTransaksi);

                                    // Mengubah nilai input total_harga
                                    $('#total_harga').val(totalTransaksi); // Ganti id dengan yang benar, sesuai dengan input yang ingin diubah
                                });

                                // Jika tombol Hitung ditekan
                                $('[#hitung]').on('click', function () {
                                    // Mengambil nilai input jumlah
                                    var jumlah = $('#jumlah').val();

                                    // Mendapatkan harga dari elemen yang bersesuaian, gantilah dengan id atau class yang sesuai
                                    var harga = <?= $r->harga ?>;

                                    // Melakukan perhitungan total transaksi
                                    var totalTransaksi = harga - jumlah;

                                    // Menampilkan total transaksi
                                    $('#totalTransaksi').text('Total Transaksi: ' + totalTransaksi);

                                    // Mengubah nilai input total_harga
                                    $('#total_harga').val(totalTransaksi); // Ganti id dengan yang benar, sesuai dengan input yang ingin diubah
                                });
                            });
                        </script>
                    <?php }
                    unset($data_array, $r);
                    ?>
                </div>
                <div class="row py-5">
                    <h3>Busana Muslimah</h3>
                    <?php
                    $no = 1;
                    $data_array = $abc->tampil_semua_dataBusana();
                    foreach ($data_array as $r) {
                        ?>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-header text-center">
                                    <a class="d-block blur-shadow-image">
                                        <img src="<?= $r->imageUrl ?>" alt="img-blur-shadow"
                                            class="img-fluid img-fluid shadow border-radius-lg"
                                            style="width: 300px; height: 250px;">
                                    </a>
                                </div>
                                <div class=" card-body text-center">
                                    <h5 class="font-weight-normal mt-3">
                                        <a href="">
                                            <?= $r->nama_busana ?>
                                        </a>
                                    </h5>
                                    <p class="mb-0">
                                        <?= $r->deskripsi ?>
                                    </p>
                                </div>
                                <hr class="dark horizontal my-0">
                                <div class="card-footer d-flex">
                                    <p class="font-weight-normal my-auto">Rp
                                        <?= $r->harga ?>
                                    </p>
                                    <i class="material-icons position-relative ms-auto text-lg me-1 my-auto"></i>
                                    <p class="text-sm my-auto">Stok:
                                        <?= $r->stok ?>
                                    </p>
                                    <i class="material-icons position-relative ms-auto text-lg me-1 my-auto">badge</i>
                                    <p class="text-sm my-auto">
                                        <?= $r->nama_brand ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                    <?php }
                    unset($data_array, $r);
                    ?>
                </div>
            </div>

            <!-- BATAS BODY -->
            <!-- FOOTER -->
            <footer class="footer py-4  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fa fa-heart"></i> by
                                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                                    Tim</a>
                                for a better web.
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                        target="_blank">Creative Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                        target="_blank">About
                                        Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                        target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                        target="_blank">License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
            </div>
        </main>
        </div>
        <!--   Core JS Files   -->
        <script src="../assets/js/core/popper.min.js"></script>
        <script src="../assets/js/core/bootstrap.min.js"></script>
        <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script src="../assets/js/plugins/chartjs.min.js"></script>

        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            } 
        </script>
        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>

        <script>
            $(document).ready(function () {
                $('#editModal').on('show.bs.modal', function (e) {
                    var idProduct = $(e.relatedTarget).data('id');
                    $('#id_product_input').val(idProduct);
                    // Tambahkan kode lain untuk mengisi elemen-elemen lain di dalam modal sesuai kebutuhan
                });
            });
        </script>


    </body>

    </html>
<?php } else {
    header('location:login.php');
} ?>