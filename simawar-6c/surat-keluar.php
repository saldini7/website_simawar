<?php

include "koneksi.php";

$id_srt = $_GET['id'];

$query_srt = "SELECT U.nm_user, SK.* FROM tbl_user U, tbl_srt_klr SK WHERE U.id_user = SK.penandatangan AND id_srt_klr = $id_srt";
$result_srt = mysqli_query($conn, $query_srt);
$row_srt = mysqli_fetch_assoc($result_srt);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <title>Simawar - Surat Keluar</title>
</head>

<body class="bg-login">
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-2 text-center">
                            <img src="assets/images/logo-img.png" width="100" alt="" />
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Sistem Informasi Surat Masuk dan Keluar (Simawar)</h3>
                                    </div>
                                    <div class="login-separater text-center mb-4"> <span>SIGN IN HERE</span>
                                        <hr />
                                    </div>

                                    <div class="form-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td> Nomor Surat</td>
                                                    <th>: <?php echo $row_srt["no_srt"] ?></th>
                                                </tr>
                                                <tr>
                                                    <td> Tgl Surat</td>
                                                    <th>: <?php echo $row_srt["tgl_srt"] ?></th>
                                                </tr>
                                                <tr>
                                                    <td> Lampiran</td>
                                                    <th>: <?php echo $row_srt["lampiran"] ?></th>
                                                </tr>
                                                <tr>
                                                    <td> Hal</td>
                                                    <th>: <?php echo $row_srt["hal"] ?></th>
                                                </tr>
                                                <tr>
                                                    <td> Tujuan</td>
                                                    <th>: <?php echo $row_srt["untuk"] ?></th>
                                                </tr>
                                                <tr>
                                                    <td> Penandatangan</td>
                                                    <th>: <?php echo $row_srt["nm_user"] ?></th>
                                                </tr>
                                                <tr>
                                                    <td> Tanggal TTD</td>
                                                    <th>: <?php echo $row_srt["tgl_ttd"] ?></th>
                                                </tr>
                                                <tr>
                                                    <td> Status</td>
                                                    <?php if ($row_srt["status"] == 'New') { ?>
                                                        <th class="text-danger">:Belum Ditandatangani</th>
                                                    <?php } else if ($row_srt["status"] == 'Ditandatangani') { ?>
                                                        <th class="text-info">: <?php echo $row_srt["status"] ?></th>
                                                    <?php } ?>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <script src="assets/js/app.js"></script>
</body>

</html>