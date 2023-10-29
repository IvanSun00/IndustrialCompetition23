<?php
include '../../../connect.php';
if (isset($_POST["acc"])) {
    $ks2 = $_SESSION['namekel_day2'];
    
    $stmt2 = $conn->prepare("UPDATE day2_kelompok SET sertifikasi=1 WHERE nama='$ks2'");
    $stmt2->execute();

    $_SESSION['quan_serti'] == 1;
}elseif(isset($_POST["undo"])){
    $ks2 = $_SESSION['namekel_day2'];
    
    $stmt2 = $conn->prepare("UPDATE day2_kelompok SET sertifikasi=0 WHERE nama='$ks2'");
    $stmt2->execute();

    $_SESSION['quan_serti'] == 0;
}
header("Location: index.php");
