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
    $id=$_POST['idp'];
    $nama=$_POST['namap'];
    $alamat=$_POST['alamatp'];
    $jenis_kelamin=$_POST['jenisk'];
    $telpon=$_POST['tlpp'];
    if(empty($nama)||empty($alamat)||empty($jenis_kelamin)||empty($telpon)){
        header("location:dtpelanggan.php");
        exit;
    }
    $simpan = mysqli_query($koneksi,"INSERT INTO tb_member (id,nama,alamat,jenis_kelamin,tlp)
                                    VALUES  ('$id',
                                            '$nama',
                                            '$alamat',
                                            '$jenis_kelamin',
                                            '$telpon')
                                        ");
        if($simpan)//jika simpan sukses
        {
            echo"<script>
                alert('simpan data sukses!');
                document.location='dtpelanggan.php';
            </script>";
        }
        else {
            echo"<script> 
                alert('simpan data Gagal!');
                document.location='dtpelanggan.php';
            </script>";
        }                            
}
// edit dan hapus
if (isset($_POST['dsimpan'])) {
    $id = $_POST['idp'];
    $nama = $_POST['editnama'];
    $alamat= $_POST['editalamat'];
    $jenis_kelamin = $_POST['editjenis'];
    $telpon= $_POST['edittlp'];
    $queryEdit = "UPDATE `tb_member` SET `id` = '$id', `nama` = '$nama', `alamat` = '$alamat',`jenis_kelamin` = '$jenis_kelamin',`tlp` = '$telpon'   WHERE id = $id";
    $execEdit = mysqli_query($koneksi, $queryEdit);
    if ($execEdit) {
        header("location: dtpelanggan.php");
    }
}
if (isset($_POST['delete'])) {
    $id = $_POST['idhapus'];
    $queryDeleteUser = "DELETE FROM tb_member WHERE id = $id";
    $execDeleteUser = mysqli_query($koneksi, $queryDeleteUser);
    if ($execDeleteUser) {
        header("location: dtpelanggan.php");
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
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="index.php" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>  
<div class="page-heading">
    <h3>list Member BintangLaundry</h3>
    <div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h4 class="card-title">Data member</h4>
            <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>ID Member</th>
                                        <th>Nama Member</th>
                                        <th>Alamat</th>
                                        <th>Jenis Kelamin</th>
                                        <th>NoTLP </th>
                                        <th>Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $no = 1;

                                        $sql = $koneksi->query("select * from tb_member");
                                        while ($data = $sql->fetch_assoc()) { 
                                ?>
                                    <tr>
                                        <td class="text-bold-500"><?php echo $no++; ?></td>
                                        <td class="text-bold-500"><?php echo $data['id'] ?> </td>
                                        <td class="text-bold-500"><?php echo $data['nama'] ?></td>
                                        <td class="text-bold-500"><?php echo $data['alamat'] ?></td>
                                        <td class="text-bold-500"><?php echo $data['jenis_kelamin'] ?></td>
                                        <td class="text-bold-500"><?php echo $data['tlp'] ?></td>
                                        <td>
                                            <?php include "edit_member.php"; ?>
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
                                                <h4 class="modal-title" id="myModalLabel33">Tambahkan Data </h4>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                </button>
                                            </div>
                                            <form  method="post">
                                                
                                                <div class="modal-body">
                                                    <label>ID Member</label>
                                                    <div class="form-group">
                                                        <input type="text" name="idp" value="<?=@ $id?>" placeholder="Id Member"  class="form-control" required>
                                                    </div>
                                                    <label>Nama Member</label>
                                                    <div class="form-group">
                                                        <input type="text" name="namap" value="<?=@$nama?>"  placeholder="Nama Member"  class="form-control" required>
                                                    </div>
                                                    <label>Alamat</label>
                                                    <div class="form-group">
                                                        <input type="text" name="alamatp" value="<?=@$alamat?>"  placeholder="Alamat"  class="form-control" required>
                                                    </div>
                                                    <label>Jenis kelamin</label>
                                                    <div class="form-group">
                                                        <input type="text" name="jenisk" value="<?=@$jenis_kelamin?>"  placeholder="L / P"  class="form-control" required>
                                                    </div>
                                                    <label>NO TLP</label>
                                                    <div class="form-group">
                                                        <input type="text" name="tlpp" value="<?=@$telpon?>"  placeholder="nomor telpone"  class="form-control" required>
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
