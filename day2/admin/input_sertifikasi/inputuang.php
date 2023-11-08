<?php
include '../../../connect.php';

if (isset($_POST['submit-balance']) && isset($_SESSION['balance_now']) && isset($_SESSION['namekel_day2'])) {
    $ku2 = $_SESSION['namekel_day2'];
    $quan_uang = $_SESSION['balance_now'];

    $balance = $_POST['input-balance'];
    $rewarduang = $balance + $quan_uang;

    $quang4 = $conn->prepare("UPDATE day2_kelompok SET uang=$rewarduang WHERE nama='$ku2'");
    $quang4->execute();

    
    if($quang4->rowCount() == 1){
        $_SESSION['balance'] = $balance;
        $_SESSION['alert'] = "berhasil";
        $_SESSION['input_uang_success'] = "success";
    }else{
        $_SESSION['alert'] = "gagal";
    }

}
header("Location: index.php");
