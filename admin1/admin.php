<?php
session_start();
if (!isset($_SESSION['logadmin'])) {
    header("location: ../admin.php");
    exit;
}
include "../db.php";
$queryUser = "SELECT * FROM tb_user";
$execUser = mysqli_query($koneksi, $queryUser);
$dataUser = mysqli_fetch_all($execUser, MYSQLI_ASSOC);

// Harian
$queryTransaksiHarian = "SELECT * FROM tb_transaksi WHERE  cast(tgl AS Date) = CURRENT_DATE";
$execTransaksiHarian = mysqli_query($koneksi, $queryTransaksiHarian);
$dataTransaksiHarian = mysqli_fetch_all($execTransaksiHarian, MYSQLI_ASSOC);

$queryPaket = "SELECT * FROM tb_paket";
$execPaket = mysqli_query($koneksi, $queryPaket);
$dataPaket = mysqli_fetch_all($execPaket, MYSQLI_ASSOC);


$idTransaksiHarian = [];
foreach ($dataTransaksiHarian as $harian) {
    $idTransaksiHarian[] += $harian['id'];
}
$queryHarian = [];
foreach ($idTransaksiHarian as $harian) {
    $idHarian = $harian;
    $queryHarian[] .= "SELECT * FROM tb_detail_transaksi WHERE id_transaksi = $idHarian";
}
$totalHarian = 0;
foreach ($queryHarian as $query) {
    $execQuery = mysqli_query($koneksi, $query);
    $dataHarian = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);
    $qty = [];
    $pesananPaket = [];
    foreach ($dataHarian as $Harian) {
        $pesananPaket[] += $Harian['id_paket'];
        $qty[] += $Harian['qty'];
    }
    $a = 0;
    foreach ($pesananPaket as $paket) {
        foreach ($dataPaket as $pkt) {
            $idPaket = $pkt['id'];
            if ($paket == $idPaket) {
                $totalHarian += $qty[$a] * $pkt['harga'];
                $a++;
            }
        }
    }
}



// Bulanan
$queryTransaksiBulanan = 'SELECT * FROM tb_transaksi WHERE Date_format(tgl, "%m") = DATE_FORMAT(CURRENT_DATE, "%m")';
$execTransaksiBulanan = mysqli_query($koneksi, $queryTransaksiBulanan);
$dataTransaksiBulanan = mysqli_fetch_all($execTransaksiBulanan, MYSQLI_ASSOC);

$idTransaksiBulanan = [];
foreach ($dataTransaksiBulanan as $bulanan) {
    $idTransaksiBulanan[] += $bulanan['id'];
}
// var_dump($idTransaksiBulanan);
$queryBulanan = [];
foreach ($idTransaksiBulanan as $bulanan) {
    $idBulanan = $bulanan;
    $queryBulanan[] .= "SELECT * FROM tb_detail_transaksi WHERE id_transaksi = $idBulanan";
}
$totalBulanan = 0;
foreach ($queryBulanan as $query) {
    $execQuery = mysqli_query($koneksi, $query);
    $dataBulanan = mysqli_fetch_all($execQuery, MYSQLI_ASSOC);
    $qty = [];
    $pesananPaket = [];
    foreach ($dataBulanan as $bulanan) {
        $pesananPaket[] += $bulanan['id_paket'];
        $qty[] += $bulanan['qty'];
    }
    $a = 0;
    foreach ($pesananPaket as $paket) {
        foreach ($dataPaket as $pkt) {
            $idPaket = $pkt['id'];
            if ($paket == $idPaket) {
                $totalBulanan += $qty[$a] * $pkt['harga'];
                $a++;
            }
        }
    }
}
// echo $totalBulanan;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/main/app-dark.css">
    <link rel="stylesheet" href="../assets/css/shared/iconly.css">
    <style>
        header {
            margin-left: 20px;
        }
    </style>
</head>

<body class="theme-dark">
    <div id="app">
        <?php include "sidebar.php" ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>Sistem Informasi Manajemen BintangLaundry</h3>
            </div>
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">transaksi hari ini</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= $totalHarian ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-currency-dollar" style="font-size: 2.8rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">transaksi bulan ini</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= $totalBulanan ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-currency-dollar" style="font-size: 2.8rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Halaman Hak Akses Admin</h4>
                                <hr>
                                <h4 class="fs-5">Sistem Informasi Manajemen Laundry</h4>
                            </div>
                            <div class="card-body">
                                <div class="col-md-6">
                                    <p class="fs-4">Merupakan sebuah sistem yang digunakan untuk mengelola data kebutuhan Laundry mulai dari pemesanan, status, data penjualan, data kasir, data pengguna, dan laporan transaksi.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="../assets/js/bootstrap.js"></script>
        <script src="../assets/js/app.js"></script>
</body>

</html>