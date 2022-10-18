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

$id_srt_klr = $_GET["id"];

$query = "DELETE FROM tbl_srt_klr WHERE id_srt_klr = $id_srt_klr";
$hapus = mysqli_query($conn, $query);


if ($hapus) {
    echo "<script>
        alert ('Data berhasil dihapus');
        document.location.href = 'srt-klr.php';
        </script>";
} else {
    echo "<script>
        alert ('Data gagal dihapus...!');
        history.go(-1);
        </script>";
}
