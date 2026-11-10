<?php
include 'koneksi.php';

$id = $_GET['id'] ?? 0;
$query = "SELECT * FROM laporan WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if(!$data) { header("Location: index.php"); exit; }

if(isset($_POST['update'])) {
    $status   = mysqli_real_escape_string($conn, $_POST['status']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $lokasi   = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $pesan    = mysqli_real_escape_string($conn, $_POST['pesan']);

    $update_query = "UPDATE laporan SET kategori='$kategori', lokasi='$lokasi', pesan='$pesan', status='$status' WHERE id=$id";
    if(mysqli_query($conn, $update_query)) {
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengaduan - SIPASTI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark py-3">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-edit me-2"></i>Edit Status & Detail Laporan</h4>
                </div>
                <div class="card-body p-4">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Pelapor</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($data['nama']); ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori Masalah</label>
                            <select name="kategori" class="form-select" required>
                                <option value="Jalan Rusak" <?= $data['kategori']=='Jalan Rusak'?'selected':'';?>>Jalan Rusak</option>
                                <option value="Drainase / Banjir" <?= $data['kategori']=='Drainase / Banjir'?'selected':'';?>>Drainase / Banjir</option>
                                <option value="Penerangan Jalan Umum" <?= $data['kategori']=='Penerangan Jalan Umum'?'selected':'';?>>Penerangan Jalan Umum</option>
                                <option value="Fasilitas Umum Lainnya" <?= $data['kategori']=='Fasilitas Umum Lainnya'?'selected':'';?>>Fasilitas Umum Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Lokasi Kejadian</label>
                            <input type="text" name="lokasi" class="form-control" value="<?= htmlspecialchars($data['lokasi']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="pesan" class="form-control" rows="3" required><?= htmlspecialchars($data['pesan']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status Pengerjaan</label>
                            <select name="status" class="form-select" required>
                                <option value="Pending" <?= $data['status']=='Pending'?'selected':'';?>>Pending</option>
                                <option value="Proses" <?= $data['status']=='Proses'?'selected':'';?>>Proses</option>
                                <option value="Selesai" <?= $data['status']=='Selesai'?'selected':'';?>>Selesai</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                            <button type="submit" name="update" class="btn btn-warning"><i class="fas fa-save me-1"></i> Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>