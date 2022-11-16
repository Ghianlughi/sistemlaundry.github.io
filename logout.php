<?php
session_start();
if (isset($_SESSION['logadmin'])) {
    $nama = $_SESSION['nama'];
    $role = $_SESSION['role'];
    session_destroy();
}
if (isset($_SESSION['logkasir'])) {
    $nama = $_SESSION['nama'];
    $role = $_SESSION['role'];
    session_destroy();
}
header('location: login.php');