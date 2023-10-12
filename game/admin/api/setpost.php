<?php
include '../../../connect.php';
$error_mess = false;

if (isset($_POST["submitpos"])) {
    $_SESSION['nama_poss'] = $_POST['poss'];
}

    header("Location: ../input_material.php");
?>