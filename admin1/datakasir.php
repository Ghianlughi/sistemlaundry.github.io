<?php
session_start();
if (!isset($_SESSION['logadmin'])) {
    header("location: ../admin.php");
    exit;
}
include "../db.php";

//jika tombol simpan di klilk
if(isset($_POST['dsimpan']))
{
    $id=$_POST['idd'];
    $nama=$_POST['namak'];
    $user=$_POST['userk'];
    $password=$_POST['pask'];
    $role=$_POST['editrole'];
  $simpan = mysqli_query($koneksi,"INSERT INTO tb_user (id,nama,username,password,role)
                                    VALUES  ('$id',
                                            '$nama',
                                            '$user',
                                            '$password',
                                            '$role')");
        if($simpan)//jika simpan sukses
        {
            echo"<script>
                alert('simpan data sukses!');
                document.location='datakasir.php';
            </script>";
        }
        else {
            echo"<script> 
                alert('simpan data Gagal!');
                document.location='datakasir.php';
            </script>";
        }
                               
}
if (isset($_POST['dsimpan'])) {
    $id = $_POST['idd'];
    $nama = $_POST['namak'];
    $user= $_POST['userk'];
    $password= $_POST['pask'];
    $role= $_POST['editrole'];
    $queryEdit = "UPDATE `tb_user` SET `id` = '$id', `nama` = '$nama', `username` = '$user', `password`= '$password', `role`= '$role' WHERE id = $id";
    $execEdit = mysqli_query($koneksi, $queryEdit);
    if ($execEdit) {
        // $login = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah mengubah paket dengan id($id) dengan jenis($jenis) pada daftar paket";
        // logger($login, "../../../");
        header("location: datakasir.php");
    }
}
if (isset($_POST['delete'])) {
    $id = $_POST['idhapus'];
    $queryDeleteUser = "DELETE FROM tb_user WHERE id = $id";
    $execDeleteUser = mysqli_query($koneksi, $queryDeleteUser);
    if ($execDeleteUser) {
        // $login = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah menghapus paket dengan id($id) pada daftar paket";
        // logger($login, "../../../");
        header("location: datakasir.php");
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
        <a href="admin.php" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>  
<div class="page-heading">
    <h3>Daftar Member</h3>
    <div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h4 class="card-title">Daftar Paket</h4>
            <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $no = 1;

                                        $sql = $koneksi->query("select * from tb_user");
                                        while ($data = $sql->fetch_assoc()) { 
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $data['id'] ?></td>
                                        <td><?php echo $data['nama'] ?></td>
                                        <td><?php echo $data['username'] ?></td>
                                        <td><?php echo $data['password'] ?></td>
                                        <td><?php echo $data['role'] ?></td>
                                        <td>
                                        <?php include "edit_datakasir.php"; ?>
                                        </td>
                                    </tr>
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
                                <!-- Button trigger for login form modal -->
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#inlineForm">
                                    TAMBAH DATA
                                </button>

                                <!-- form tambah  -->
                                <div class="modal fade text-left" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">Maskan data</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                </button>
                                            </div>
                                            <form  method="post">
                                                
                                                <div class="modal-body">
                                                    <label>ID</label>
                                                    <div class="form-group">
                                                        <input type="text" name="idd"  placeholder="masukan id"  class="form-control" required>
                                                    </div>
                                                    <label>Nama</label>
                                                    <div class="form-group">
                                                        <input type="text" name="namak"  placeholder="masukan nama"  class="form-control" required>
                                                    </div>
                                                    <label>Username</label>
                                                    <div class="form-group">
                                                        <input type="text" name="userk"  placeholder="Username"  class="form-control" required>
                                                    </div>
                                                    <label>Password</label>
                                                    <div class="form-group">
                                                        <input type="text" name="pask"  placeholder="password"  class="form-control" required>
                                                    </div>
                                                    <div class="col-sm">
                                                    <label>Masukkan Role</label>
                                                    <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect" name="editrole">
                                                    <option value="kasir">kasir</option>
                                                    <option value="admin">admin</option>
                                                    </select>
                                                    </fieldset>
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
