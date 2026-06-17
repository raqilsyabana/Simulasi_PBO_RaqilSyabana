<?php
// file: index.php

// 1. Import semua file yang dibutuhkan
require_once 'database.php';
require_once 'PendaftaranReguler.php';
require_once 'PendaftaranPrestasi.php';
require_once 'PendaftaranKedinasan.php';

// 2. Inisialisasi Koneksi Database
$database = new Database();
$db = $database->getConnection();

if (!$db) {
    die("Gagal memuat halaman karena masalah koneksi database.");
}

// 3. Mengambil data menggunakan Metode Query Spesifik
$dataReguler   = PendaftaranReguler::getDaftarReguler($db);
$dataPrestasi  = PendaftaranPrestasi::getDaftarPrestasi($db);
$dataKedinasan = PendaftaranKedinasan::getDaftarKedinasan($db);

// 4. Konversi ke Kumpulan Objek
$listReguler = [];
foreach ($dataReguler as $row) {
    $listReguler[] = new PendaftaranReguler(
        $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], 
        $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], 
        $row['pilihan_prodi'], $row['lokasi_kampus']
    );
}

$listPrestasi = [];
foreach ($dataPrestasi as $row) {
    $listPrestasi[] = new PendaftaranPrestasi(
        $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], 
        $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], 
        $row['jenis_prestasi'], $row['tingkat_prestasi']
    );
}

$listKedinasan = [];
foreach ($dataKedinasan as $row) {
    $listKedinasan[] = new PendaftaranKedinasan(
        $row['id_pendaftaran'], $row['nama_calon'], $row['asal_sekolah'], 
        $row['nilai_ujian'], $row['biaya_pendaftaran_dasar'], 
        $row['sk_ikatan_dinas'], $row['instansi_sponsor']
    );
}

// Menghitung total pendaftar untuk statistik ringkas di atas halaman
$totalPendaftar = count($listReguler) + count($listPrestasi) + count($listKedinasan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pendaftaran Mahasiswa Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
        }
        .card-stats {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s;
        }
        .card-stats:hover {
            transform: translateY(-5px);
        }
        .table-container {
            background: #ffffff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin-bottom: 40px;
        }
        .section-title {
            font-weight: 600;
            position: relative;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .section-title::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 4px;
            bottom: 0;
            left: 0;
            border-radius: 2px;
        }
        .title-reguler::after { background-color: #0d6efd; }
        .title-prestasi::after { background-color: #198754; }
        .title-kedinasan::after { background-color: #ffc107; }
        
        .thead-custom {
            background-color: #212529;
            color: #ffffff;
        }
        .badge-info-custom {
            background-color: #e9ecef;
            color: #495057;
            font-size: 0.85rem;
            padding: 6px 12px;
            border-radius: 8px;
            display: inline-block;
        }
        .price-final {
            font-weight: 600;
            color: #2c3e50;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fa-solid fa-graduation-cap me-2"></i>SIM-PMB</a>
            <span class="navbar-text text-white-50 d-none d-md-inline">
                Sistem Informasi Manajemen Pendaftaran Mahasiswa Baru
            </span>
        </div>
    </nav>

    <div class="container my-5">
        
        <div class="p-5 mb-4 bg-white rounded-3 shadow-sm border border-light">
            <div class="container-fluid py-2">
                <h1 class="display-6 fw-bold text-dark">Selamat Datang di Panel Admisi</h1>
                <p class="col-md-8 fs-6 text-muted">Data di bawah ini merupakan data pendaftaran masuk yang dikelompokkan secara dinamis menggunakan prinsip Polimorfisme dan Abstraksi PBO.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-6 col-lg-3">
                <div class="card card-stats bg-primary text-white shadow-sm p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="mb-1 text-white-50">Jalur Reguler</h6>
                            <h3 class="fw-bold mb-0"><?= count($listReguler); ?> <small class="fs-6 fw-normal">Siswa</small></h3>
                        </div>
                        <i class="fa-solid fa-user-graduate fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card card-stats bg-success text-white shadow-sm p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="mb-1 text-white-50">Jalur Prestasi</h6>
                            <h3 class="fw-bold mb-0"><?= count($listPrestasi); ?> <small class="fs-6 fw-normal">Siswa</small></h3>
                        </div>
                        <i class="fa-solid fa-award fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card card-stats bg-warning text-dark shadow-sm p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="mb-1 text-dark-50 text-muted">Jalur Kedinasan</h6>
                            <h3 class="fw-bold mb-0"><?= count($listKedinasan); ?> <small class="fs-6 fw-normal text-muted">Siswa</small></h3>
                        </div>
                        <i class="fa-solid fa-building-shield fa-2x text-black-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card card-stats bg-dark text-white shadow-sm p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="mb-1 text-white-50">Total Pendaftar</h6>
                            <h3 class="fw-bold mb-0"><?= $totalPendaftar; ?> <small class="fs-6 fw-normal">Siswa</small></h3>
                        </div>
                        <i class="fa-solid fa-users fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-container">
            <h3 class="section-title title-reguler text-primary"><i class="fa-solid fa-user-graduate me-2"></i>Data Jalur Reguler</h3>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="20%">Nama Calon</th>
                            <th width="20%">Asal Sekolah</th>
                            <th width="10%">Nilai</th>
                            <th width="15%">Biaya Dasar</th>
                            <th width="15%">Atribut Khusus</th>
                            <th width="15%">Total Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($listReguler)): ?>
                            <tr><td colspan="7" class="text-center py-4 text-muted">Tidak ada data pendaftaran reguler.</td></tr>
                        <?php else: ?>
                            <?php foreach ($listReguler as $mhs): ?>
                                <tr>
                                    <td><span class="badge bg-secondary">#<?= $mhs->getIdPendaftaran(); ?></span></td>
                                    <td class="fw-semibold text-secondary"><?= htmlspecialchars($mhs->getNamaCalon()); ?></td>
                                    <td><?= htmlspecialchars($mhs->getAsalSekolah()); ?></td>
                                    <td><span class="badge bg-light text-dark border fw-normal"><?= $mhs->getNilaiUjian(); ?></span></td>
                                    <td>Rp <?= number_format($mhs->getBiayaPendaftaranDasar(), 0, ',', '.'); ?></td>
                                    <td><span class="badge-info-custom"><i class="fa-solid fa-circle-info me-1 text-primary"></i> <?= str_replace("Jalur: Reguler | ", "", $mhs->tampilkanInfoJalur()); ?></span></td>
                                    <td class="price-final text-primary">Rp <?= number_format($mhs->hitungTotalBiaya(), 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="table-container">
            <h3 class="section-title title-prestasi text-success"><i class="fa-solid fa-award me-2"></i>Data Jalur Prestasi</h3>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="20%">Nama Calon</th>
                            <th width="20%">Asal Sekolah</th>
                            <th width="10%">Nilai</th>
                            <th width="15%">Biaya Dasar</th>
                            <th width="15%">Atribut Khusus</th>
                            <th width="15%">Total Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($listPrestasi)): ?>
                            <tr><td colspan="7" class="text-center py-4 text-muted">Tidak ada data pendaftaran prestasi.</td></tr>
                        <?php else: ?>
                            <?php foreach ($listPrestasi as $mhs): ?>
                                <tr>
                                    <td><span class="badge bg-secondary">#<?= $mhs->getIdPendaftaran(); ?></span></td>
                                    <td class="fw-semibold text-secondary"><?= htmlspecialchars($mhs->getNamaCalon()); ?></td>
                                    <td><?= htmlspecialchars($mhs->getAsalSekolah()); ?></td>
                                    <td><span class="badge bg-light text-dark border fw-normal"><?= $mhs->getNilaiUjian(); ?></span></td>
                                    <td>Rp <?= number_format($mhs->getBiayaPendaftaranDasar(), 0, ',', '.'); ?></td>
                                    <td><span class="badge-info-custom"><i class="fa-solid fa-medal me-1 text-success"></i> <?= str_replace("Jalur: Prestasi | ", "", $mhs->tampilkanInfoJalur()); ?></span></td>
                                    <td class="price-final text-success">Rp <?= number_format($mhs->hitungTotalBiaya(), 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="table-container">
            <h3 class="section-title title-kedinasan text-warning"><i class="fa-solid fa-building-shield me-2"></i>Data Jalur Kedinasan</h3>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="20%">Nama Calon</th>
                            <th width="20%">Asal Sekolah</th>
                            <th width="10%">Nilai</th>
                            <th width="15%">Biaya Dasar</th>
                            <th width="15%">Atribut Khusus</th>
                            <th width="15%">Total Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($listKedinasan)): ?>
                            <tr><td colspan="7" class="text-center py-4 text-muted">Tidak ada data pendaftaran kedinasan.</td></tr>
                        <?php else: ?>
                            <?php foreach ($listKedinasan as $mhs): ?>
                                <tr>
                                    <td><span class="badge bg-secondary">#<?= $mhs->getIdPendaftaran(); ?></span></td>
                                    <td class="fw-semibold text-secondary"><?= htmlspecialchars($mhs->getNamaCalon()); ?></td>
                                    <td><?= htmlspecialchars($mhs->getAsalSekolah()); ?></td>
                                    <td><span class="badge bg-light text-dark border fw-normal"><?= $mhs->getNilaiUjian(); ?></span></td>
                                    <td>Rp <?= number_format($mhs->getBiayaPendaftaranDasar(), 0, ',', '.'); ?></td>
                                    <td><span class="badge-info-custom"><i class="fa-solid fa-shield-halved me-1 text-warning"></i> <?= str_replace("Jalur: Kedinasan | ", "", $mhs->tampilkanInfoJalur()); ?></span></td>
                                    <td class="price-final text-dark">Rp <?= number_format($mhs->hitungTotalBiaya(), 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>