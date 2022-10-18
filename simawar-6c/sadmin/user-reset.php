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

$id_user = $_GET["id"];
$password = '$2y$10$Pwdy2hY92U.OA6.0o3FzxOxeEj/VFOg7ZvJpeUQHK/OOdA1bBTdnS';

$query = "UPDATE tbl_user SET password = '$password' WHERE id_user = $id_user";
$update = mysqli_query($conn, $query);


if ($update) {
    echo "<script>
        alert ('Password berhasil direset menjadi admin');
        document.location.href = 'user.php';
        </script>";
} else {
    echo "<script>
        alert ('Password gagal direset...!');
        history.go(-1);
        </script>";
}
