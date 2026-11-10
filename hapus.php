<?php
include 'koneksi.php';
$id = $_GET['id'] ?? 0;
if($id) {
    mysqli_query($conn, "DELETE FROM laporan WHERE id = $id");
}
header("Location: index.php");
exit;
?>