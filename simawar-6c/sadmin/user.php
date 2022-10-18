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

$query_karyawan = "SELECT B.nm_bagian, U.* FROM tbl_bagian B, tbl_user U WHERE B.id_bagian = U.id_bagian ORDER BY U.id_user DESC";
$result_karyawan = mysqli_query($conn, $query_karyawan);

?>

<!doctype html>
<html lang="en" class="<?php echo $row_user["theme"] ?>">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="../assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="../assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <!-- loader-->
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
    <title>Simawar - Data User</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">

        <?php include "theme-sidebar.php" ?>

        <?php include "theme-header.php" ?>

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="index.php"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data User</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <h5 class="my-4 text-uppercase">Data user</h5>
                <p>Silahkan mengelola data user dibawah ini, Anda dapat menambahkan user baru sesuai levelnya (User/karyawan, Admin, Kepala), Anda juga dapat memblokir user agar tidak bisa login (Edit), Anda dapat mereset password apabila user lupa(Password default : admin) dan admin juga dapat menghapus data user. Hati-hati dalam menghapus data user, apabila user sudah pernah menginput data baik dokumen ataupun surat, maka data tersebut akan error...!</p>
                <div class="col">
                    <a href="user-tambah.php" class="btn btn-primary"><i class='bx bx-plus mr-1'></i>Tambah Data</a>
                </div>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-hover table-bordered">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Action</th>
                                        <th>Level</th>
                                        <th>Status</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>NIP/NIK</th>
                                        <th>karyawan</th>
                                        <th>Telepon</th>
                                        <th>Email</th>
                                        <th>Tanggal Reg</th>
                                        <th>Oleh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row_karyawan = mysqli_fetch_assoc($result_karyawan)) { ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex order-actions">
                                                    <a href="user-edit.php?id=<?php echo $row_karyawan["id_user"] ?>" class="text-light bg-success border-0" title="Edit"><i class='bx bxs-edit'></i></a>
                                                    <a href="user-hapus.php?id=<?php echo $row_karyawan["id_user"] ?>" class="ms-4 text-light bg-warning border-0" title="Hapus" onClick="return confirm('Apakah anda yakin ingin menghapus data ini...?')"><i class='bx bxs-trash'></i></a>
                                                    <a href="user-reset.php?id=<?php echo $row_karyawan["id_user"] ?>" class="ms-4 text-light bg-info border-0" title="Reset Password" onClick="return confirm('Password akan direset menjadi admin...?')"><i class='lni lni-reload'></i></a>
                                                </div>
                                            </td>
                                            <td>
                                                <?php if ($row_karyawan["level"] == 1) { ?>
                                                    <span class="badge bg-light-danger text-danger w-100">Super Admin</span>
                                                <?php } else if ($row_karyawan["level"] == 2) { ?>
                                                    <span class="badge bg-light-warning text-warning w-100"> Admin</span>
                                                <?php } else if ($row_karyawan["level"] == 3) { ?>
                                                    <span class="badge bg-light-success text-success w-100">User</span>
                                                <?php } else if ($row_karyawan["level"] == 4) { ?>
                                                    <span class="badge bg-light-info text-info w-100">Pimpinan</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($row_karyawan["status"] == 1) { ?>
                                                    <span class="badge bg-light-success text-success w-100">Aktif</span>
                                                <?php } else if ($row_karyawan["status"] == 0) { ?>
                                                    <span class="badge bg-light-danger text-danger w-100">Blokir</span>
                                                <?php } ?>
                                            </td>

                                            <td>
                                                <img src="../assets/images/users/<?php echo $row_karyawan["foto"] ?>" alt="<?php echo $row_karyawan["foto"] ?>" class="rounded-circle p-1 border" width="50">
                                            </td>

                                            <td><?php echo $row_karyawan["nm_user"] ?></td>
                                            <td><?php echo $row_karyawan["username"] ?></td>
                                            <td><?php echo $row_karyawan["nik"] ?></td>
                                            <td><?php echo $row_karyawan["nm_bagian"] ?></td>
                                            <td><a href="tel:<?php echo $row_karyawan["telp"] ?>"><?php echo $row_karyawan["telp"] ?></a></td>
                                            <td><a href="mailto:<?php echo $row_karyawan["email"] ?>"><?php echo $row_karyawan["email"] ?></a></td>
                                            <td><?php echo $row_karyawan["tgl_reg"] ?></td>
                                            <td><?php echo $row_karyawan["oleh"] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
    <script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
    <!--app JS-->
    <script src="../assets/js/app.js"></script>
</body>

</html>