CREATE DATABASE IF NOT EXISTS db_sipasti;
USE db_sipasti;

CREATE TABLE IF NOT EXISTS laporan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nik VARCHAR(20) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    lokasi TEXT NOT NULL,
    pesan TEXT NOT NULL,
    tanggal DATE NOT NULL,
    status ENUM('Pending', 'Proses', 'Selesai') DEFAULT 'Pending'
);

-- Contoh Data Dummy
INSERT INTO laporan (nama, nik, kategori, lokasi, pesan, tanggal, status) VALUES
('Ahmad Fauzi', '3326123456780001', 'Jalan Rusak', 'Jl. Jenderal Sudirman No. 45, Pekalongan', 'Terdapat lubang besar di tengah jalan yang membahayakan pengendara motor.', '2026-11-01', 'Proses'),
('Siti Aminah', '3326123456780002', 'Drainase / Banjir', 'Kp. Ambokembang RT 02/05, Pekalongan', 'Saluran air mampet dan meluap saat hujan deras.', '2026-11-02', 'Pending');