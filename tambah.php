<?php
include 'koneksi.php';

$pesan = '';
if(isset($_POST['submit'])) {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $nik      = mysqli_real_escape_string($conn, $_POST['nik']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $lokasi   = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $pesan_lap= mysqli_real_escape_string($conn, $_POST['pesan']);
    $tanggal  = date('Y-m-d');
    $status   = 'Pending';

    $query = "INSERT INTO laporan (nama, nik, kategori, lokasi, pesan, tanggal, status) VALUES ('$nama', '$nik', '$kategori', '$lokasi', '$pesan_lap', '$tanggal', '$status')";
    
    if(mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit;
    } else {
        $pesan = "Gagal menyimpan data: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Pengaduan - SIPASTI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-plus-circle me-2"></i>Form Input Aspirasi & Pengaduan</h4>
                </div>
                <div class="card-body p-4">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required placeholder="Masukkan nama pelapor">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">NIK</label>
                            <input type="text" name="nik" class="form-control" required placeholder="Masukkan NIK pelapor">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori Masalah</label>
                            <select name="kategori" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Jalan Rusak">Jalan Rusak</option>
                                <option value="Drainase / Banjir">Drainase / Banjir</option>
                                <option value="Penerangan Jalan Umum">Penerangan Jalan Umum</option>
                                <option value="Fasilitas Umum Lainnya">Fasilitas Umum Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Lokasi Kejadian</label>
                            <input type="text" name="lokasi" class="form-control" required placeholder="Contoh: Jl. Ahmad Yani No. 10">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi Pengaduan</label>
                            <textarea name="pesan" class="form-control" rows="4" required placeholder="Jelaskan detail permasalahan..."></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Kirim Pengaduan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>