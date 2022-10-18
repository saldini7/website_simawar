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

if (isset($_POST["submit"])) {

    $username = htmlspecialchars($_POST["username"]);
    $nm_user = htmlspecialchars($_POST["nm_user"]);
    $nik = htmlspecialchars($_POST["nik"]);
    $telp = htmlspecialchars($_POST["telp"]);
    $email = htmlspecialchars($_POST["email"]);
    $fotolama = htmlspecialchars($_POST["fotolama"]);

    if ($_FILES["foto"]["error"] === 4) {
        $foto = $fotolama;
    } else {
        //fungsi upload foto
        $namafile = $_FILES["foto"]["name"];
        $ukuranfile = $_FILES["foto"]["size"];
        $error = $_FILES["foto"]["error"];
        $tmpname = $_FILES["foto"]["tmp_name"];

        $ekstensifotovalid = ["jpg", "jpeg", "png"];
        $ekstensifoto = explode('.', $namafile);
        $ekstensifoto = strtolower(end($ekstensifoto));

        if (!in_array($ekstensifoto, $ekstensifotovalid)) {
            echo "<script>
        alert ('Yang Anda Upload Bukan Foto.....!');
        history.go(-1);
        </script>";
            return false;
        }

        if ($ukuranfile > 1000000) {
            echo "<script>
            alert ('Ukuran Foto Terlalu Besar, Maksimal 1 MB');
            history.go(-1);
            </script>";
            return false;
        }

        $namafilebaru = uniqid();
        $namafilebaru .= '.';
        $namafilebaru .= $ekstensifoto;

        move_uploaded_file($tmpname, '../assets/images/users/' . $namafilebaru);
        $foto = $namafilebaru;
    }

    $query = "UPDATE tbl_user SET 
    username = '$username',
    nm_user = '$nm_user',
    nik = '$nik',
    telp = '$telp',
    email = '$email',
    foto = '$foto'
    WHERE id_user = $id_user";
    $update = mysqli_query($conn, $query);

    if ($update) {
        echo "<script>
        alert ('Profil Berhasil DiUpdate, Anda Harus Login Kembali');
        document.location.href = 'logout.php';
        </script>";
    } else {
        echo "<script>
        alert ('Data Gagal Disimpan');
        history.go(-1);
        </script>";
    }
}
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
    <title>Simawar - Profile</title>
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
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="row">
                    <div class="col-xl-12 mx-auto">
                        <h6 class="mb-0 text-uppercase">Profile</h6>
                        <hr />
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body px-5 pb-5">
                                <div class="card-title d-flex align-items-center">
                                    <div><i class="bx bx-plus me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary">Update Profile</h5>
                                </div>
                                <hr>
                                <form class="row g-3" method="POST" target="" enctype="multipart/form-data">
                                    <div class="col-12">
                                        <label for="username" class="form-label">Username :</label>
                                        <input type="text" class="form-control" name="username" id="username" value="<?php echo $row_user["username"] ?>" placeholder="Username 1 kata huruf Kecil semua" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="nm_user" class="form-label">Nama :</label>
                                        <input type="text" class="form-control" name="nm_user" id="nm_user" value="<?php echo $row_user["nm_user"] ?>" placeholder="Nama Lengkap dengan Gelar" required>
                                    </div>


                                    <div class="col-12">
                                        <label for="nik" class="form-label">NIK/NIP :</label>
                                        <input type="number" class="form-control" name="nik" id="nik" value="<?php echo $row_user["nik"] ?>" placeholder="Nomor Induk Kepegawaian" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="telp" class="form-label">Telpon :</label>
                                        <input type="number" class="form-control" name="telp" id="telp" value="<?php echo $row_user["telp"] ?>" placeholder="Nomor Telepon Aktif Whatsapp" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="email" class="form-label">Email :</label>
                                        <input type="email" class="form-control" name="email" id="email" value="<?php echo $row_user["email"] ?>" placeholder="Email Aktif" required>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <img src="../assets/images/users/<?php echo $row_user["foto"] ?>" class="rounded-circle p-1 border" width="90" alt="<?php echo $row_user["foto"] ?>">
                                    </div>

                                    <div class="col-12">
                                        <label for="foto" class="form-label">Upload Foto :</label>
                                        <input class="form-control" type="file" name="foto" id="foto">
                                    </div>
                                    <small>File format .JPG .JPEG .PNG dengan ukuran maksimal 1 MB</small>
                                    <input type="hidden" name="fotolama" value="<?php echo $row_user["foto"] ?>">

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary px-5" name="submit">Simpan</button>
                                        <button type="button" class="btn btn-secondary px-5" onclick="self.history.back()">Cancel</button>
                                    </div>
                                </form>
                            </div>
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

        <!--end wrapper-->
        <!-- Bootstrap JS -->
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <!--plugins-->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
        <script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
        <script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
        <!--app JS-->
        <script src="../assets/js/app.js"></script>
</body>

</html>