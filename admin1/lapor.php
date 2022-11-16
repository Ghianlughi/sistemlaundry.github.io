<?php 

session_start();
if (!isset($_SESSION['logadmin'])) {
    header("location: ../admin.php");
    exit;
}
include "../db.php";

// Cari
if (isset($_POST['cari'])) {
    $awal = date("Y-m-d H:i:s", strtotime($_POST["awal"]));
    $akhir = date("Y-m-d H:i:s", strtotime($_POST["akhir"]));
    // var_dump($awal, $akhir);
    $queryTransaksi = "SELECT id,id_member FROM tb_transaksi WHERE tgl BETWEEN '$awal' AND '$akhir'";
    $execTransaksi = mysqli_query($koneksi, $queryTransaksi);
    $dataTransaksi = mysqli_fetch_all($execTransaksi, MYSQLI_ASSOC);
    // var_dump($dataTransaksi);
    $semuaId = [];
    $semuaPelanggan = [];
    foreach ($dataTransaksi as $transaksi) {
        $semuaId[] += $transaksi['id'];
        $semuaPelanggan[] += $transaksi['id_member'];
    }
    // var_dump($semuaId);
    $listQuery = [];
    $i = 0;
    foreach ($semuaId as $id) {
        $listQuery[$i] = "SELECT * FROM tb_detail_transaksi WHERE id_transaksi = $id";
        $i++;
    }
    $coba = true;
    // var_dump($listQuery);
    // Ambil data detail transaksi antara id terbesar dan terkecil
}
?>




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem laundry</title>
    
    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="stylesheet" href="../assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
    
<link rel="stylesheet" href="../assets/css/shared/iconly.css">

</head>

<body>
    <div id="app">
    <?php include "sidebar.php"; ?>  
    </div>
         <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <p class="fs-4">Laporan Transaksi</p>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <form action="" method="post">
                            <div class="card-content">
                                <div class="col-12">
                                    <div class="row p-4">
                                        <div class="col-4">
                                            <input type="datetime-local" class="form-control" name="awal" id="" value="<?= @$awal ?>">
                                        </div>
                                        <div class="col-4">
                                            <input type="datetime-local" class="form-control" name="akhir" id="" value="<?= @$akhir ?>">
                                        </div>
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-secondary" name="cari">Coba</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php if (@$coba) {  ?>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card p-4">
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0 p-0">
                                        <tr>
                                            <th class="col-1">No</th>
                                            <th class="col-2">Tanggal</th>
                                            <th class="col-1">Kode Invoice</th>
                                            <th class="col-2">Pelanggan</th>
                                            <th class="col-5 ">Layanan</th>
                                            <th class="col-1">Total Biyaya</th>
                                        </tr>
                                        <?php $no = 1; ?>
                                        <?php $i = 0; ?>
                                        <?php $b = 0; ?>
                                        <?php $bayar = []; ?>
                                        <?php $totalHarga = [] ?>
                                        <?php foreach ($listQuery as $query) {
                                            // Detail Transaksi
                                            $execQuery = mysqli_query($koneksi, $query);
                                            $dataQuery = mysqli_fetch_assoc($execQuery);
                                            // Transaksi
                                            $idTransaksi = $semuaId[$i];
                                            $queryTransaksiSatu = "SELECT * FROM tb_transaksi WHERE id = $idTransaksi";
                                            $execTransaksiSatu = mysqli_query($koneksi, $queryTransaksiSatu);
                                            $dataTransaksiSatu = mysqli_fetch_assoc($execTransaksiSatu);
                                            // Pelanggan
                                            $idPelanggan = $semuaPelanggan[$i];
                                            $queryPelanggan = "SELECT * FROM tb_member WHERE id = $idPelanggan";
                                            $execPelanggan = mysqli_query($koneksi, $queryPelanggan);
                                            $dataPelanggan = mysqli_fetch_assoc($execPelanggan);
                                            // Paket
                                            $queryPaket = "SELECT * FROM tb_detail_transaksi WHERE id_transaksi = $idTransaksi";
                                            $execPaket = mysqli_query($koneksi, $queryPaket);
                                            $dataPaket = mysqli_fetch_all($execPaket, MYSQLI_ASSOC);
                                            $beratPaket = [];
                                            $semuaPaket = [];
                                            foreach ($dataPaket as $paket) {
                                                $beratPaket[] += $paket['qty'];
                                                $semuaPaket[] += $paket['id_paket'];
                                            }
                                            // var_dump($semuaPaket, $beratPaket);
                                            $c = 0;
                                            foreach ($dataPaket as $hrg) {
                                                if ($hrg['id_paket'] == $semuaPaket[$c] && $hrg['id_transaksi'] == $idTransaksi) {
                                                    $idPaket = $hrg['id_paket'];
                                                    $queryHargaPaket = "SELECT * FROM tb_paket WHERE id = $idPaket";
                                                    $execHargaPaket = mysqli_query($koneksi, $queryHargaPaket);
                                                    $dataHargaPaket = mysqli_fetch_assoc($execHargaPaket);
                                                    $hargaPaket = $dataHargaPaket['harga'];
                                                    @$bayar[$i] += $beratPaket[$c] * $hargaPaket;
                                                    $c++;
                                                }
                                            }
                                        ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $dataTransaksiSatu['tgl'] ?></td>
                                                <td><?= $dataTransaksiSatu['kode_invoice'] ?></td>
                                                <td><?= $dataPelanggan['nama'] ?></td>
                                                <td>
                                                    <ul class="list-group">
                                                        <?php $a = 0;
                                                        foreach ($semuaPaket as $pkt) :
                                                            $idAmbilPaket = $semuaPaket[$a];
                                                            $queryAmbilPaket = "SELECT * FROM tb_paket WHERE id = $idAmbilPaket";
                                                            $execAmbilPaket = mysqli_query($koneksi, $queryAmbilPaket);
                                                            $dataAmbilPaket = mysqli_fetch_assoc($execAmbilPaket);
                                                        ?>
                                                            <li class="list-group-item"><?= $dataAmbilPaket['nama_paket'] ?> (<?= $beratPaket[$a] ?> Kg)</li>
                                                            <?php $a++ ?>
                                                        <?php endforeach ?>
                                                    </ul>
                                                </td>
                                                <td>Rp. <?= $bayar[$i]; ?></td>
                                            </tr>
                                            <?php $i++ ?>
                                            <?php $no++ ?>
                                        <?php } ?>


                                    </table>
                                </div>
                            </div>
                            <td class="col-1 mt-5"><button class="btn btn-danger" onclick="window.print()" type="button">Print</button></td>
                        <?php } ?>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <script>
        function print() {
            window.print;
         
<!--script-->
<script src="../assets/js/bootstrap.js"></script>
<script src="../assets/js/app.js"></script>   
<script src="../assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="../assets/js/pages/dashboard.js"></script>

</body>

</html>
