<?php

session_start();
if (!isset($_SESSION['logkasir'])) {
    header("location: ../login.php");
    exit;
}

include "../db.php";


$querySemuaPelanggan = "SELECT * FROM tb_member";
$execSemuaPelanggan = mysqli_query($koneksi, $querySemuaPelanggan);
$dataSemuaPelanggan = mysqli_fetch_all($execSemuaPelanggan, MYSQLI_ASSOC);
// var_dump($dataSemuaPelanggan);


$kode = $_GET['kode'];
$idTransaksi = $_GET['idTransaksi'];
$queryTransaksi = "SELECT * FROM tb_transaksi WHERE id = $idTransaksi";
$execTransaksi = mysqli_query($koneksi, $queryTransaksi);
$dataTransaksi = mysqli_fetch_assoc($execTransaksi);



$tgl = $dataTransaksi['tgl'];


$idPelanggan = $dataTransaksi['id_member'];
$queryPelanggan = "SELECT * FROM tb_member WHERE id = $idPelanggan";
$execPelanggan = mysqli_query($koneksi, $queryPelanggan);
$dataPelanggan = mysqli_fetch_assoc($execPelanggan);


$namaPelanggan = $dataPelanggan['nama'];
$noHp = $dataPelanggan['tlp'];
$alamat = $dataPelanggan['alamat'];

$queryDetail = "SELECT * FROM tb_detail_transaksi WHERE id_transaksi = $idTransaksi";
$execDetail = mysqli_query($koneksi, $queryDetail);
$dataDetail = mysqli_fetch_all($execDetail, MYSQLI_ASSOC);
// var_dump($dataDetail);


$querryPaket = "SELECT * FROM tb_paket";
$execPaket = mysqli_query($koneksi, $querryPaket);
$dataPaket = mysqli_fetch_all($execPaket, MYSQLI_ASSOC);




if ((!isset($_GET['idTransaksi']) || !isset($_GET['kode'])) || ($kode !== $dataTransaksi['kode_invoice'] || $idTransaksi !== $dataTransaksi['id'])) {
    header("location: riwayat.php");
    exit;
}

// Warna badge
if ($dataTransaksi['dibayar'] == 'dibayar') {
    $bayarWarna = "badge bg-success";
}
if ($dataTransaksi['dibayar'] == 'belum_dibayar') {
    $bayarWarna = "badge bg-warning";
}
if ($dataTransaksi['status'] == 'baru') {
    $statusWarna = "badge bg-secondary";
}
if ($dataTransaksi['status'] == 'proses') {
    $statusWarna = "badge bg-info";
}
if ($dataTransaksi['status'] == 'selesai') {
    $statusWarna = "badge bg-primary";
}
if ($dataTransaksi['status'] == 'diambil') {
    $statusWarna = "badge bg-success";
}
// Akhir warna badge


// Inner html badge
if ($dataTransaksi['dibayar'] == 'belum_dibayar') {
    $status = "Belum Dibayar";
}
if ($dataTransaksi['dibayar'] == 'dibayar') {
    $status = "Dibayar";
}
if ($dataTransaksi['status'] == 'baru') {
    $proses = 'Baru';
}
if ($dataTransaksi['status'] == 'proses') {
    $proses = 'Dalam Proses';
}
if ($dataTransaksi['status'] == 'selesai') {
    $proses = 'Selesai';
}
if ($dataTransaksi['status'] == 'diambil') {
    $proses = 'Diambil';
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/shared/iconly.css">
    <style>
        @media print {
            #hasil {
                color: grey;
            }
        }
    </style>
</head>

<body onload="window.print();">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-sm-1 text-left">
                    </div>
                    <div class="col-sm-11 text-left">
                        <h3>BintangLaundry</h3>
                        <h6>Jl. Jalan, Derpoyudo, Kec. Karanganyar, Kabupaten Karanganyar, kode 57715, Telp 0813-1097-9210</h6>
                        <h6>@Starlaundry</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!--rows -->
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>No Invoice</td>
                                        <td>: <?= $kode ?></td>
                                        <input type="hidden" name="no_invoice" id="no_invoice" value="<?= $kode ?>">
                                    </tr>
                                    <tr>
                                        <td>Waktu Transaksi</td>
                                        <td>: <?= $tgl ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pelanggan</td>
                                        <td>: <?= $namaPelanggan ?></td>
                                    </tr>
                                    <tr>
                                        <td>No Telp</td>
                                        <td>: <?= $noHp ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: <?= $alamat ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pembayaran</td>
                                        <td>: <?= $status ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pengambilan</td>
                                        <td>: <?= $proses ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-8">

                    </div>
                </div>
                <!-- table table-bordered -->
                <!--rows -->
                <div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Paket</th>
                                    <th>Jenis Paket</th>
                                    <th>Tarif</th>
                                    <th>Berat</th>
                                    <th>Total Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php $totalBayar = 0 ?>
                                <?php foreach ($dataDetail as $detail) : ?>
                                    <?php
                                    $idPaket = $detail['id_paket'];
                                    $queryAmbilPaket = "SELECT * FROM tb_paket WHERE id = $idPaket";
                                    $execAmbilPaket = mysqli_query($koneksi, $queryAmbilPaket);
                                    $dataAmbilPaket = mysqli_fetch_assoc($execAmbilPaket);
                                    $namaPaket = $dataAmbilPaket['nama_paket'];
                                    $jenisPaket = $dataAmbilPaket['jenis'];
                                    $hargaPaket = $dataAmbilPaket['harga'];
                                    $totalHarga = $detail['qty'] * $hargaPaket;
                                    $totalBayar += $totalHarga;
                                    ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $namaPaket ?></td>
                                        <td><?= $jenisPaket ?></td>
                                        <td><?= $hargaPaket ?></td>
                                        <td><?= $detail['qty'] ?></td>
                                        <td><?= $totalHarga ?></td>
                                    </tr>
                                    <?php $no++ ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <br>
                        <span class="float-end">
                            <h3 id="hasil" style="color: black;">Total Bayar : Rp. <?= $totalBayar ?></h3>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/app.js"></script>

</body>

</html>