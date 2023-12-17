<?php
error_reporting(1);
include 'Client.php';
include '../server/config.php';

$database = new Koneksi();
// Mendapatkan koneksi PDO
$conn = $database::getKoneksi();

?>
<?php if (isset($_COOKIE['jwt']) && $_COOKIE['role'] == 'Admin') { ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
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

    <?php include 'sidebar.php'; ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      <!-- Navbar -->
      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        data-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
              <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Data Transaksi</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Data Transaksi</h6>
          </nav>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- BODY -->
      <form action="prosesTransaksi.php" method="POST" name="form" class="px-4 py-4">
        <h2>Tambah Transaksi</h2>
        <p>Isi informasi berikut untuk setiap Transaksi:</p>
        <div class="row" id="alternatif-container">
          <!-- Kolom pertama -->
          <div class="col-md-6">
            <div class="input-group input-group-outline my-3">
              <input type="hidden" name="aksi" value="tambah" />
              <label class="form-label">Id Transaksi</label>
              <input type="text" name="id_transaksi" class="form-control">
            </div>
          </div>
          <!-- Kolom kedua -->
          <div class="col-md-6">
            <div class="input-group input-group-outline my-3">
              <select class="form-control" id="id_user" name="id_user">
                <option value="" disabled selected>Pilih User</option>
                <?php
                $user = $abc->tampil_semua_dataUser();
                foreach ($user as $user):
                  echo "<option value='" . $user->id_user . "'>" . $user->username . "</option>";
                endforeach;
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group input-group-outline my-3">
              <select class="form-control" id="id_product" name="id_product">
                <option value="" disabled selected>Pilih Product</option>
                <?php
                $product = $abc->tampil_semua_data();
                foreach ($product as $product):
                  echo "<option value='" . $product->id_product . "'>" . $product->nama_product . "</option>";
                endforeach;
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <label for="tanggal_transaksi">Tanggal Transaksi</label>
            <div class="input-group input-group-outline mb-2">
              <input type="date" name="tanggal_transaksi" class="form-control">
            </div>
          </div>
          <!-- Kolom kedua -->
          <div class="col-md-6">
            <div class="input-group input-group-outline my-3">
              <label class="form-label">Jumlah Beli</label>
              <input type="number" name="jumlah" class="form-control">
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group input-group-outline my-3">
              <label class="form-label">Total Transaksi</label>
              <input type="text" name="total_harga" class="form-control">
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group input-group-outline my-3">
              <label class="form-label">Tujuan Kirim</label>
              <input type="text" name="tujuan" class="form-control">
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group input-group-outline my-3">
              <label class="form-label"></label>
              <select class="form-control" name="metode_pembayaran" id="metode_pembayaran">
                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                <option value="COD">COD</option>
                <option value="Go-Pay">Go-Pay</option>
                <option value="DANA">DANA</option>
              </select>
            </div>
          </div>
        </div>

        <button type="submit" name="simpan" class="btn bg-gradient-success">Simpan</button>

        <br>
        <br>
      </form>
      <div class="card mx-4">
        <div class="text-uppercase text-white bg-gradient-primary font-weight-bolder ps-3 card-header">Data Transaksi
        </div>
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">No</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Id Transaksi</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Transaksi
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah Beli</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Transaksi</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tujuan Kirim</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Metode Pembayaran
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $data_array = $abc->tampil_semua_dataTransaksi();
              foreach ($data_array as $r) {
                ?>
                <tr>
                  <td>
                    <p class="text-xs font-weight-bold mb-0 ps-2">
                      <?= $no++ ?>
                    </p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0 ps-3">
                      <?= $r->id_transaksi ?>
                    </p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">
                      <?= $r->username ?>
                    </p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">
                      <?= $r->nama_product ?>
                    </p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">
                      <?= $r->tanggal_transaksi ?>
                    </p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">
                      <?= $r->jumlah ?>
                    </p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">
                      <?= $r->total_harga ?>
                    </p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">
                      <?= $r->tujuan ?>
                    </p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">
                      <?= $r->metode_pembayaran ?>
                    </p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">
                      <a href="#">
                        <button type="button" class="btn btn-sm bg-gradient-warning" data-bs-toggle="modal"
                          data-bs-target="#editModal<?= $r->id_transaksi ?>" name="ubah" data-id="<?= $r->id_transaksi ?>">
                          Edit
                        </button>
                      </a>
                      <a href="prosesTransaksi.php?aksi=hapus&id_transaksi=<?= $r->id_transaksi ?>"
                        onclick="return confirm('Apakah Anda ingin menghapus data ini?')">
                        <button type="button" class="btn btn-sm bg-gradient-danger">Hapus</button>
                    </p>
                  </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="editModal<?= $r->id_transaksi ?>" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Edit Product</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="prosesTransaksi.php" method="POST" name="form" class="px-4 py-4">
                          <div class="row" id="alternatif-container">
                            <div class="col-md-6">
                              <div class="input-group input-group-outline my-3">
                                <input type="hidden" name="aksi" value="ubah" />
                                <label class="form-label">Id Transaksi</label>
                                <input type="text" name="id_transaksi" class="form-control" value="<?= $r->id_transaksi ?>"
                                  readonly>
                              </div>
                            </div>
                            <!-- Kolom kedua -->
                            <div class="col-md-6">
                              <div class="input-group input-group-outline my-3">
                                <select class="form-control" id="id_user" name="id_user">
                                  <option value="" disabled selected>Pilih User</option>
                                  <?php
                                  $user = $abc->tampil_semua_dataUser();
                                  foreach ($user as $user):
                                    echo "<option value='" . $user->id_user . "'>" . $user->username . "</option>";
                                  endforeach;
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="input-group input-group-outline my-3">
                                <select class="form-control" id="id_product" name="id_product">
                                  <option value="" disabled selected>Pilih Product</option>
                                  <?php
                                  $product = $abc->tampil_semua_data();
                                  foreach ($product as $product):
                                    echo "<option value='" . $product->id_product . "'>" . $product->nama_product . "</option>";
                                  endforeach;
                                  ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label for="tanggal_transaksi">Tanggal Transaksi</label>
                              <div class="input-group input-group-outline mb-2">
                                <input type="date" name="tanggal_transaksi" class="form-control"
                                  value="<?= $r->tanggal_transaksi ?>">
                              </div>
                            </div>
                            <!-- Kolom kedua -->
                            <div class="col-md-6">
                              <div class="input-group input-group-outline my-3">
                                <label class="form-label">Jumlah Beli</label>
                                <input type="number" name="jumlah" class="form-control" value="<?= $r->jumlah ?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="input-group input-group-outline my-3">
                                <label class="form-label">Total Transaksi</label>
                                <input type="text" name="total_harga" class="form-control" value="<?= $r->total_harga ?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="input-group input-group-outline my-3">
                                <label class="form-label">Tujuan Kirim</label>
                                <input type="text" name="tujuan" class="form-control" value="<?= $r->tujuan ?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="input-group input-group-outline my-3">
                                <label class="form-label"></label>
                                <select class="form-control" name="metode_pembayaran" id="metode_pembayaran">
                                  <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                  <option value="COD">COD</option>
                                  <option value="Go-Pay">Go-Pay</option>
                                  <option value="DANA">DANA</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="simpan" class="btn bg-gradient-success">Save Changes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php }
              unset($data_array, $r);
              echo '</table>';
              ?>
            </tbody>
          </table>
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
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About
                    Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
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
<?php } elseif ($_COOKIE['role'] == 'User') {
  echo "<script>alert('Anda tidak memiliki akses.'); window.location.href='userSide.php';</script>";
  header('location:userSide.php');
} else {
  header('location:login.php');
} ?>