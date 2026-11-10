<?php
include 'koneksi.php';

// Ambil statistik data
$total_laporan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM laporan"));
$total_selesai = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM laporan WHERE status='Selesai'"));
$total_proses = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM laporan WHERE status='Proses'"));
$total_pending = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM laporan WHERE status='Pending'"));

// Ambil data laporan untuk tabel
$result = mysqli_query($conn, "SELECT * FROM laporan ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPASTI - Sistem Pengaduan & Aspirasi Infrastruktur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { background: #1e293b; min-height: 100vh; color: #fff; }
        .sidebar a { color: #cbd5e1; text-decoration: none; padding: 12px 20px; display: block; border-radius: 6px; margin-bottom: 5px; }
        .sidebar a:hover, .sidebar a.active { background: #0f172a; color: #fff; }
        .card-stat { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar p-3 d-none d-md-block">
            <h4 class="text-center text-white py-3 fw-bold"><i class="fas fa-city me-2 text-primary"></i>SIPASTI</h4>
            <hr class="text-secondary">
            <ul class="nav flex-column">
                <li class="nav-item"><a href="index.php" class="active"><i class="fas fa-home me-2"></i> Dashboard</a></li>
                <li class="nav-item"><a href="tambah.php"><i class="fas fa-plus-circle me-2"></i> Input Pengaduan</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 fw-bold text-dark">Dashboard Monitoring Infrastruktur</h1>
                <a href="tambah.php" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Buat Pengaduan Baru</a>
            </div>

            <!-- Kartu Statistik -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card card-stat bg-white p-3 border-start border-primary border-4">
                        <div class="text-muted small">Total Laporan</div>
                        <h3 class="fw-bold mb-0 text-primary"><?= $total_laporan; ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stat bg-white p-3 border-start border-warning border-4">
                        <div class="text-muted small">Dalam Proses</div>
                        <h3 class="fw-bold mb-0 text-warning"><?= $total_proses; ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stat bg-white p-3 border-start border-info border-4">
                        <div class="text-muted small">Pending</div>
                        <h3 class="fw-bold mb-0 text-info"><?= $total_pending; ?></h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stat bg-white p-3 border-start border-success border-4">
                        <div class="text-muted small">Selesai</div>
                        <h3 class="fw-bold mb-0 text-success"><?= $total_selesai; ?></h3>
                    </div>
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-secondary"><i class="fas fa-list me-2"></i>Daftar Aspirasi & Pengaduan Warga</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pelapor</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                while($row = mysqli_fetch_assoc($result)) { 
                                    $badge = 'bg-secondary';
                                    if($row['status'] == 'Selesai') $badge = 'bg-success';
                                    elseif($row['status'] == 'Proses') $badge = 'bg-warning text-dark';
                                    elseif($row['status'] == 'Pending') $badge = 'bg-info text-dark';
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['tanggal']; ?></td>
                                    <td><?= htmlspecialchars($row['nama']); ?></td>
                                    <td><?= htmlspecialchars($row['kategori']); ?></td>
                                    <td><?= htmlspecialchars($row['lokasi']); ?></td>
                                    <td><span class="badge <?= $badge; ?>"><?= $row['status']; ?></span></td>
                                    <td>
                                        <a href="detail.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-info" title="Detail"><i class="fas fa-eye"></i></a>
                                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus data ini?')" title="Hapus"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>