<?php
include 'koneksi.php';
$id = $_GET['id'] ?? 0;
$result = mysqli_query($conn, "SELECT * FROM laporan WHERE id = $id");
$data = mysqli_fetch_assoc($result);
if(!$data) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Laporan - SIPASTI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-dark py-3">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-info-circle me-2"></i>Detail Informasi Pengaduan</h4>
                </div>
                <div class="card-body p-4">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Tanggal Pengaduan</th>
                            <td><?= $data['tanggal']; ?></td>
                        </tr>
                        <tr>
                            <th>Nama Pelapor</th>
                            <td><?= htmlspecialchars($data['nama']); ?></td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td><?= htmlspecialchars($data['nik']); ?></td>
                        </tr>
                        <tr>
                            <th>Kategori Masalah</th>
                            <td><?= htmlspecialchars($data['kategori']); ?></td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td><?= htmlspecialchars($data['lokasi']); ?></td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td><?= htmlspecialchars($data['pesan']); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span class="badge bg-secondary"><?= $data['status']; ?></span></td>
                        </tr>
                    </table>
                    <div class="text-end">
                        <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>