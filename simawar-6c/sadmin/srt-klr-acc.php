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
include "../phpqrcode/qrlib.php";


$id_srt = $_GET["id"];
$status = "Ditandatangani";
$tgl_ttd = date('Y-m-d');



$query = "UPDATE tbl_srt_klr  SET
    status = '$status', 
    tgl_ttd = '$tgl_ttd' 
    WHERE id_srt_klr = $id_srt";
$edit = mysqli_query($conn, $query);



if ($edit) {

    $text_qrcode = "../surat-keluar.php?id=$id_srt";
    $tmpdir = "../phpqrcode/images/";
    $namafile = "image$id_srt.png";
    $quality = "H";
    $ukuran = 10;
    $padding = 4;

    QRcode::png($text_qrcode, $tmpdir . $namafile, $quality, $ukuran, $padding);

    echo "<script>
        alert ('Surat Berhasil Ditandatangani....!');
        history.go(-1);
        </script>";
} else {
    echo "<script>
        alert ('Data gagal diupdate...!');
        history.go(-1);
        </script>";
}
