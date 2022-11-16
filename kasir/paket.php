<?php
session_start();
if (!isset($_SESSION['logkasir'])) {
    header("location: ../login.php");
    exit;
}
include "../db.php";


//jika tombol simpan di klilk
if(isset($_POST['dsimpan']))
{
    $id=$_POST['idpkt'];
    $jenis=$_POST['jnspkt'];
    $nama=$_POST['namapaket'];
    $harga=$_POST['harga'];
  $simpan = mysqli_query($koneksi,"INSERT INTO tb_paket (id,jenis,nama_paket,harga)
                                    VALUES  ('$id',
                                            '$jenis',
                                            '$nama',
                                            '$harga')
                                        ");
        if($simpan)//jika simpan sukses
        {
            echo"<script>
                alert('simpan data sukses!');
                document.location='paket.php';
            </script>";
        }
        else {
            echo"<script> 
                alert('simpan data Gagal!');
                document.location='paket.php';
            </script>";
        }
                               
}
if (isset($_POST['dsimpan'])) {
    $id = $_POST['idp'];
    $jenis = $_POST['editjenis'];
    $nama= $_POST['editnama'];
    $harga= $_POST['editharga'];
    $queryEdit = "UPDATE `tb_paket` SET `id` = '$id', `jenis` = '$jenis', `nama_paket` = '$nama', `harga`= '$harga' WHERE id = $id";
    $execEdit = mysqli_query($koneksi, $queryEdit);
    if ($execEdit) {
        // $login = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah mengubah paket dengan id($id) dengan jenis($jenis) pada daftar paket";
        // logger($login, "../../../");
        header("location: paket.php");
    }
}
if (isset($_POST['delete'])) {
    $id = $_POST['idhapus'];
    $queryDeleteUser = "DELETE FROM tb_paket WHERE id = $id";
    $execDeleteUser = mysqli_query($koneksi, $queryDeleteUser);
    if ($execDeleteUser) {
        // $login = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah menghapus paket dengan id($id) pada daftar paket";
        // logger($login, "../../../");
        header("location: paket.php");
    }
}


?>
<!DOCTYPE html>
<html lang="en">

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
                <a href="index.php" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>  
<div class="page-heading">
    <h3>list Paket Laundry</h3>
    <div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h4 class="card-title">Daftar Paket</h4>
            <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>ID Paket</th>
                                        <th>Jenis Paket</th>
                                        <th>Nama Paket</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $no = 1;

                                        $sql = $koneksi->query("select * from tb_paket");
                                        while ($data = $sql->fetch_assoc()) { 
                                ?>
                                    <tr>
                                        <td class="text-bold-500"><?php echo $no++; ?></td>
                                        <td class="text-bold-500"><?php echo $data['id'] ?> </td>
                                        <td class="text-bold-500"><?php echo $data['jenis'] ?></td>
                                        <td class="text-bold-500"><?php echo $data['nama_paket'] ?></td>
                                        <td class="text-bold-500"><?php echo $data['harga'] ?></td>
                                        <td>
                                            <?php include "editpaket.php"; ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
        </div>
        
    </div>
</div>
<div class="card-body">
                            <div class="form-group">
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#inlineForm">
                                    TAMBAH DATA
                                </button>

                                <!-- form tambah  -->
                                <div class="modal fade text-left" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">Tambah paket </h4>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                </button>
                                            </div>
                                            <form  method="post">
                                                
                                                <div class="modal-body">
                                                    <label>ID Paket</label>
                                                    <div class="form-group">
                                                        <input type="text" name="idpkt"  placeholder="masukan Id Paket"  class="form-control" required>
                                                    </div>
                                                    <div class="col-sm">
                                                    <label>jeins paket</label>
                                                    <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect" name="jnspkt"  class="form-control" required>>
                                                    <option value="kiloan">Kiloan</option>
                                                    <option value="selimut">selimut</option>
                                                    <option value="bed_cover">bed cover</option>
                                                    <option value="kaos">kaos</option>
                                                    <option value="lain">lain</option>
                                                    </select>
                                                    </fieldset>
                                                    </div>
                                                    <label>Nama paket</label>
                                                    <div class="form-group">
                                                        <input type="text" name="namapaket"  placeholder="Expres,Reguler,santuy"  class="form-control" required>
                                                    </div>
                                                    
                                                    <label>Harga</label>
                                                    <div class="form-group">
                                                        <input type="text" name="harga"  placeholder="masukan harga"  class="form-control" required>
                                                    </div>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Close</span>
                                                    </button>
                                                    <button type="submit" class="btn btn-success" name="dsimpan" data-bs-dismiss="modal">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Simpan</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
</div>

<!--script-->
<script src="../assets/js/bootstrap.js"></script>
<script src="../assets/js/app.js"></script>   
<script src="../assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="../assets/js/pages/dashboard.js"></script>

</body>

</html>
