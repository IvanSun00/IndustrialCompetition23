<?php
include '../../../connect.php';

    if (isset($_POST["ckel"])) {
        $_SESSION['namekel_day2'] = $_POST["select_kelompok"];

        if (isset($_SESSION['namekel_day2']) && $_SESSION['namekel_day2'] != 'Pilih Kelompok') {

            $kd2 = $_SESSION['namekel_day2'];
            $qbalance = $conn->prepare("SELECT uang FROM day2_kelompok where nama='$kd2'");
            $qbalance->execute();
            $balancenow = $qbalance->fetch();
            $_SESSION['balance_now'] = $balancenow['uang'];
            
        }
        header("Location: index.php");
    }