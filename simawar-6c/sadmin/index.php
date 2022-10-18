<?php
session_start();

if ($_SESSION["level"] == 2 or $_SESSION["level"] == 3 or $_SESSION["level"] == 4) {
    header("Location: logout.php");
    exit;
}

if (!isset($_SESSION["login"])) {
    header("Location: ../index.php");
    exit;
}

include "../koneksi.php";

$id_user = $_SESSION["id_user"];

$query_user = "SELECT * FROM tbl_user WHERE id_user = '$id_user'";
$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_assoc($result_user);

?>

<!doctype html>
<html lang="en" class="<?php echo $row_user["theme"] ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../assets/images/favicon-32x32.png" type="image/png" />
    <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="../assets/plugins/highcharts/css/highcharts.css" rel="stylesheet" />
    <link href="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="../assets/css/pace.min.css" rel="stylesheet" />
    <script src="../assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/app.css" rel="stylesheet">
    <link href="../assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="../assets/css/dark-theme.css" />
    <link rel="stylesheet" href="../assets/css/semi-dark.css" />
    <link rel="stylesheet" href="../assets/css/header-colors.css" />
    <title>Simawar - Dashboard</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">

        <?php include "theme-sidebar.php" ?>

        <?php include "theme-header.php" ?>

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">

                    <?php
                    $query_bagian = "SELECT * FROM tbl_bagian";
                    $result_bagian = mysqli_query($conn, $query_bagian);
                    $jumlah_bagian = mysqli_num_rows($result_bagian);
                    ?>

                    <div class="col">
                        <div class="card radius-10 overflow-hidden bg-danger">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-white">Jumlah Bagian</p>
                                        <h5 class="mb-0 text-white"><?php echo $jumlah_bagian ?></h5>
                                    </div>
                                    <div class="ms-auto text-white"> <i class='bx bx-cabinet font-30'></i>
                                    </div>
                                </div>
                            </div>
                            <div class="" id="chart1"></div>
                        </div>
                    </div>

                    <?php
                    $query_usr = "SELECT * FROM tbl_user";
                    $result_usr = mysqli_query($conn, $query_usr);
                    $jumlah_usr = mysqli_num_rows($result_usr);
                    ?>
                    <div class="col">
                        <div class="card radius-10 overflow-hidden bg-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-white">Jumlah User</p>
                                        <h5 class="mb-0 text-white"><?php echo $jumlah_usr ?></h5>
                                    </div>
                                    <div class="ms-auto text-white"> <i class='bx bx-user font-30'></i>
                                    </div>
                                </div>
                            </div>
                            <div class="" id="chart2"></div>
                        </div>
                    </div>

                    <?php
                    $query_masuk = "SELECT * FROM tbl_srt_msk";
                    $result_masuk = mysqli_query($conn, $query_masuk);
                    $jumlah_masuk = mysqli_num_rows($result_masuk);
                    ?>

                    <div class="col">
                        <div class="card radius-10 overflow-hidden bg-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-dark">Surat Masuk</p>
                                        <h5 class="mb-0 text-dark"><?php echo $jumlah_masuk ?></h5>
                                    </div>
                                    <div class="ms-auto text-dark"> <i class='bx bx-envelope font-30'></i>
                                    </div>
                                </div>
                            </div>
                            <div class="" id="chart3"></div>
                        </div>
                    </div>

                    <?php
                    $query_keluar = "SELECT * FROM tbl_srt_klr";
                    $result_keluar = mysqli_query($conn, $query_keluar);
                    $jumlah_keluar = mysqli_num_rows($result_keluar);
                    ?>

                    <div class="col">
                        <div class="card radius-10 overflow-hidden bg-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-white">Surat Keluar</p>
                                        <h5 class="mb-0 text-white"><?php echo $jumlah_keluar ?></h5>
                                    </div>
                                    <div class="ms-auto text-white"> <i class='bx bx-envelope-open font-30'></i>
                                    </div>
                                </div>
                            </div>
                            <div class="" id="chart4"></div>
                        </div>
                    </div>
                </div>
                <!--end row-->
                <!--end row-->
                <div class="row">
                    <div class="col">
                        <div class="card radius-10 mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h5 class="mb-1">5 Surat Masuk Terbaru</h5>
                                    </div>
                                </div>


                                <?php
                                $query_srt_msk = "SELECT * FROM tbl_srt_msk ORDER BY id_srt_msk DESC LIMIT 5 ";
                                $result_srt_msk = mysqli_query($conn, $query_srt_msk);
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Nomor</th>
                                                <th>Tanggal</th>
                                                <th>Lampiran</th>
                                                <th>Hal</th>
                                                <th>Dari</th>
                                                <th>Tgl Terima</th>
                                                <th>Oleh</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row_srt_msk = mysqli_fetch_assoc($result_srt_msk)) { ?>
                                                <tr>
                                                    <td>
                                                        <a href="../assets/files/<?php echo $row_srt_msk["file"] ?>" target="_blank"><?php echo $row_srt_msk["no_srt"] ?><i class="lni lni-link"></i></a>
                                                    </td>
                                                    <td><?php echo $row_srt_msk["tgl_srt"] ?></td>
                                                    <td><?php echo $row_srt_msk["lampiran"] ?></td>
                                                    <td><?php echo $row_srt_msk["hal"] ?></td>
                                                    <td><?php echo $row_srt_msk["dari"] ?></td>
                                                    <td><?php echo $row_srt_msk["tgl_terima"] ?></td>
                                                    <td><?php echo $row_srt_msk["penerima"] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->


                <div class="row">
                    <div class="col">
                        <div class="card radius-10 mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h5 class="mb-1">5 Surat Keluar Terbaru</h5>
                                    </div>
                                </div>


                                <?php
                                $query_srt_klr = "SELECT * FROM tbl_srt_klr ORDER BY id_srt_klr DESC LIMIT 5 ";
                                $result_srt_klr = mysqli_query($conn, $query_srt_klr);
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Status</th>
                                                <th>Nomor</th>
                                                <th>Tanggal</th>
                                                <th>Lampiran</th>
                                                <th>Hal</th>
                                                <th>Untuk</th>
                                                <th>Tgl Input</th>
                                                <th>Oleh</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row_srt_klr = mysqli_fetch_assoc($result_srt_klr)) { ?>
                                                <tr>
                                                    <td>
                                                        <?php if ($row_srt_klr["status"] == 'Ditandatangani') { ?>
                                                            <span class="badge bg-success"><?php echo $row_srt_klr["status"] ?></span>
                                                        <?php } else { ?>
                                                            <span class="badge bg-warning text-dark"><?php echo $row_srt_klr["status"] ?></span>
                                                        <?php } ?>
                                                    </td>

                                                    <td>
                                                        <a href="../assets/files/<?php echo $row_srt_klr["file"] ?>" target="_blank"><?php echo $row_srt_klr["no_srt"] ?><i class="lni lni-link"></i></a>
                                                    </td>
                                                    <td><?php echo $row_srt_klr["tgl_srt"] ?></td>
                                                    <td><?php echo $row_srt_klr["lampiran"] ?></td>
                                                    <td><?php echo $row_srt_klr["hal"] ?></td>
                                                    <td><?php echo $row_srt_klr["untuk"] ?></td>
                                                    <td><?php echo $row_srt_klr["tgl_input"] ?></td>
                                                    <td><?php echo $row_srt_klr["oleh"] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->


            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

        <?php include "theme-footer.php" ?>

    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../assets/plugins/highcharts/js/highcharts.js"></script>
    <script src="../assets/plugins/highcharts/js/exporting.js"></script>
    <script src="../assets/plugins/highcharts/js/variable-pie.js"></script>
    <script src="../assets/plugins/highcharts/js/export-data.js"></script>
    <script src="../assets/plugins/highcharts/js/accessibility.js"></script>
    <script src="../assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <script src="../assets/js/index.js"></script>
    <!--app JS-->
    <script src="../assets/js/app.js"></script>
    <script>
        new PerfectScrollbar('.customers-list');
        new PerfectScrollbar('.store-metrics');
        new PerfectScrollbar('.product-list');
    </script>
</body>

</html>