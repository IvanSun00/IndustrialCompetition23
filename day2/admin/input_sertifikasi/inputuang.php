<?php
include '../../../connect.php';
if (isset($_POST["submit-balance"])) {
    $balance = $_POST["input-balance"];
    $kd2 = $_SESSION['namekel_day2'];

    $stmt1 = $conn->prepare("SELECT * FROM day2_kelompok WHERE nama='$kd2'");
    $stmt1->execute();
    $insertdatakelompok = $stmt1->fetch();
    $quan_uang = $insertdatakelompok['uang'];

    $rewarduang = $balance + $quan_uang;

    $stmt2 = $conn->prepare("UPDATE day2_kelompok SET uang='$rewarduang' WHERE nama='$kd2'");
    $stmt2->execute();

    $_SESSION['alert'] = "berhasil";
}
header("Location: index.php");
