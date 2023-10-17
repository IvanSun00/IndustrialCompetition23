<?php
include '../../../connect.php';

//POS MENANG
if (isset($_POST["submitseri"])) {
    if ($_SESSION['pickpos'] == true) {
        $nama_kelompok = $_POST["fruitselectseri"];
        $_SESSION["kelompokseri"] = $nama_kelompok;
    }



    //POS 1
    if ($_SESSION["nama_poss"] == "Remember Me") {

        $stmt = $conn->prepare('SELECT * FROM game_hadiahseri WHERE id_post=1');
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $insertdatamenang = $stmt->fetch();

            $timbal = $insertdatamenang['qty_Timbal'];
            $karbon = $insertdatamenang['qty_Karbon'];


            $stmt2 = $conn->prepare("SELECT * FROM game_kelompok WHERE nama='$nama_kelompok'");
            $stmt2->execute();
            $insertdatakelompok = $stmt2->fetch();
            $quan_timbal = $insertdatakelompok['qty_Timbal'];
            $quan_karbon = $insertdatakelompok['qty_Karbon'];

            $rewardtimbal = $timbal + $quan_timbal;
            $rewardkarbon = $karbon + $quan_karbon;

            //INSERT POIN
            $quan_poin = $insertdatakelompok['poin'];
            $stmtpoin = $conn->prepare("SELECT poin FROM game_hadiahseri WHERE id_post=1");
            $stmtpoin->execute();
            $poin = $stmtpoin->fetch();
            $insertpoint = $poin['poin'];

            $rewardpoint = $insertpoint + $quan_poin;

            //poin='$rewardpoint',


            $stmt3 = $conn->prepare("UPDATE game_kelompok SET poin='$rewardpoint', qty_Timbal='$rewardtimbal', qty_Karbon='$rewardkarbon' WHERE nama='$nama_kelompok'");
            $stmt3->execute();

            //INSERT HISTORY
            $queryKelompok = $conn->prepare("SELECT id FROM `game_kelompok` WHERE nama='$nama_kelompok'");
            $queryKelompok->execute();
            $take_id = $queryKelompok->fetch();
            $get_id = $take_id['id'];

            $stmt4 = $conn->prepare("INSERT INTO `game_historykelompok`(`id_post`, `id_kelompok`, `status`) VALUES ('1','$get_id','seri')");
            $stmt4->execute();

            if ($stmt3->rowCount() > 0) {
                $_SESSION['msg_successseri'] = true;
            }
        }
    }


    //POS 2
    elseif ($_SESSION["nama_poss"] == "Kompak Please") {

        $stmt = $conn->prepare('SELECT * FROM game_hadiahseri WHERE id_post=2');
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $insertdatamenang = $stmt->fetch();

            $nitrogen = $insertdatamenang['qty_Nitrogen'];
            $poliisoprena = $insertdatamenang['qty_Poliisoprena'];


            $stmt2 = $conn->prepare("SELECT * FROM game_kelompok WHERE nama='$nama_kelompok'");
            $stmt2->execute();
            $insertdatakelompok = $stmt2->fetch();
            $quan_nitrogen = $insertdatakelompok['qty_Nitrogen'];
            $quan_poliisoprena = $insertdatakelompok['qty_Poliisoprena'];

            $rewardnitrogen = $nitrogen +  $quan_nitrogen;
            $rewardpoliisoprena = $poliisoprena + $quan_poliisoprena;

            //INSERT POIN
            $quan_poin = $insertdatakelompok['poin'];
            $stmtpoin = $conn->prepare("SELECT poin FROM game_hadiahseri WHERE id_post=2");
            $stmtpoin->execute();
            $poin = $stmtpoin->fetch();
            $insertpoint = $poin['poin'];

            $rewardpoint = $insertpoint + $quan_poin;

            //poin='$rewardpoint',


            $stmt3 = $conn->prepare("UPDATE game_kelompok SET poin='$rewardpoint', qty_Nitrogen='$rewardnitrogen', qty_Poliisoprena='$rewardpoliisoprena' WHERE nama='$nama_kelompok'");
            $stmt3->execute();

            //INSERT HISTORY
            $queryKelompok = $conn->prepare("SELECT id FROM `game_kelompok` WHERE nama='$nama_kelompok'");
            $queryKelompok->execute();
            $take_id = $queryKelompok->fetch();
            $get_id = $take_id['id'];

            $stmt4 = $conn->prepare("INSERT INTO `game_historykelompok`(`id_post`, `id_kelompok`, `status`) VALUES ('2','$get_id','seri')");
            $stmt4->execute();

            if ($stmt3->rowCount() > 0) {
                $_SESSION['msg_successseri'] = true;
            }
        }
    }



    //POS 3
    elseif ($_SESSION["nama_poss"] == "Mind The Mines") {

        $stmt = $conn->prepare('SELECT * FROM game_hadiahseri WHERE id_post=3');
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $insertdatamenang = $stmt->fetch();

            $Cuprite  = $insertdatamenang['qty_Cuprite'];
            $Poliisoprena  = $insertdatamenang['qty_Poliisoprena'];


            $stmt2 = $conn->prepare("SELECT * FROM game_kelompok WHERE nama='$nama_kelompok'");
            $stmt2->execute();
            $insertdatakelompok = $stmt2->fetch();
            $quan_Cuprite = $insertdatakelompok['qty_Cuprite'];
            $quan_Poliisoprena = $insertdatakelompok['qty_Poliisoprena'];

            $rewardCuprite = $Cuprite +  $quan_Cuprite;
            $rewardPoliisoprena = $Poliisoprena + $quan_Poliisoprena;

            //INSERT POIN
            $quan_poin = $insertdatakelompok['poin'];
            $stmtpoin = $conn->prepare("SELECT poin FROM game_hadiahseri WHERE id_post=3");
            $stmtpoin->execute();
            $poin = $stmtpoin->fetch();
            $insertpoint = $poin['poin'];

            $rewardpoint = $insertpoint + $quan_poin;

            //poin='$rewardpoint',

            $stmt3 = $conn->prepare("UPDATE game_kelompok SET poin='$rewardpoint', qty_Cuprite='$rewardCuprite', qty_Poliisoprena='$rewardPoliisoprena' WHERE nama='$nama_kelompok'");
            $stmt3->execute();


            //INSERT HISTORY
            $queryKelompok = $conn->prepare("SELECT id FROM `game_kelompok` WHERE nama='$nama_kelompok'");
            $queryKelompok->execute();
            $take_id = $queryKelompok->fetch();
            $get_id = $take_id['id'];

            $stmt4 = $conn->prepare("INSERT INTO `game_historykelompok`(`id_post`, `id_kelompok`, `status`) VALUES ('3','$get_id','seri')");
            $stmt4->execute();

            if ($stmt3->rowCount() > 0) {
                $_SESSION['msg_successseri'] = true;
            }
        }
    }



    //POS 4
    elseif ($_SESSION["nama_poss"] == "Pass My Way") {

        $stmt = $conn->prepare('SELECT * FROM game_hadiahseri WHERE id_post=4');
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $insertdatamenang = $stmt->fetch();

            $Sylvite = $insertdatamenang['qty_Sylvite'];
            $Silikon  = $insertdatamenang['qty_Silikon'];


            $stmt2 = $conn->prepare("SELECT * FROM game_kelompok WHERE nama='$nama_kelompok'");
            $stmt2->execute();
            $insertdatakelompok = $stmt2->fetch();
            $quan_Sylvite = $insertdatakelompok['qty_Sylvite'];
            $quan_Silikon = $insertdatakelompok['qty_Silikon'];

            $rewardSylvite = $Sylvite +  $quan_Sylvite;
            $rewardSilikon = $Silikon + $quan_Silikon;

            //INSERT POIN
            $quan_poin = $insertdatakelompok['poin'];
            $stmtpoin = $conn->prepare("SELECT poin FROM game_hadiahseri WHERE id_post=4");
            $stmtpoin->execute();
            $poin = $stmtpoin->fetch();
            $insertpoint = $poin['poin'];

            $rewardpoint = $insertpoint + $quan_poin;

            //poin='$rewardpoint',


            $stmt3 = $conn->prepare("UPDATE game_kelompok SET poin='$rewardpoint', qty_Sylvite='$rewardSylvite', qty_Silikon='$rewardSilikon' WHERE nama='$nama_kelompok'");
            $stmt3->execute();

            //INSERT HISTORY
            $queryKelompok = $conn->prepare("SELECT id FROM `game_kelompok` WHERE nama='$nama_kelompok'");
            $queryKelompok->execute();
            $take_id = $queryKelompok->fetch();
            $get_id = $take_id['id'];

            $stmt4 = $conn->prepare("INSERT INTO `game_historykelompok`(`id_post`, `id_kelompok`, `status`) VALUES ('4','$get_id','seri')");
            $stmt4->execute();

            if ($stmt3->rowCount() > 0) {
                $_SESSION['msg_successseri'] = true;
            }
        }
    }




    //POS 5
    elseif ($_SESSION["nama_poss"] == "Toss tic tac tumble") {

        $stmt = $conn->prepare('SELECT * FROM game_hadiahseri WHERE id_post=5');
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $insertdatamenang = $stmt->fetch();

            $Lateks = $insertdatamenang['qty_Lateks'];
            $Timbal = $insertdatamenang['qty_Timbal'];


            $stmt2 = $conn->prepare("SELECT * FROM game_kelompok WHERE nama='$nama_kelompok'");
            $stmt2->execute();
            $insertdatakelompok = $stmt2->fetch();
            $quan_Lateks = $insertdatakelompok['qty_Lateks'];
            $quan_Timbal = $insertdatakelompok['qty_Timbal'];
            $get_id = $insertdatakelompok['id'];

            $rewardLateks = $Lateks +  $quan_Lateks;
            $rewardTimbal = $Timbal + $quan_Timbal;

            //INSERT POIN
            $quan_poin = $insertdatakelompok['poin'];
            $stmtpoin = $conn->prepare("SELECT poin FROM game_hadiahseri WHERE id_post=5");
            $stmtpoin->execute();
            $poin = $stmtpoin->fetch();
            $insertpoint = $poin['poin'];

            $rewardpoint = $insertpoint + $quan_poin;

            //poin='$rewardpoint',


            $stmt3 = $conn->prepare("UPDATE game_kelompok SET poin='$rewardpoint', qty_Lateks='$rewardLateks', qty_Timbal='$rewardTimbal' WHERE nama='$nama_kelompok'");
            $stmt3->execute();

            //INSERT HISTORY
            $stmt4 = $conn->prepare("INSERT INTO `game_historykelompok`(`id_post`, `id_kelompok`, `status`) VALUES ('5','$get_id','seri')");
            $stmt4->execute();

            if ($stmt3->rowCount() > 0) {
                $_SESSION['msg_successseri'] = true;
            }
        }
    }



    //POS 6
    elseif ($_SESSION["nama_poss"] == "Blow For victory") {

        $stmt = $conn->prepare('SELECT * FROM game_hadiahseri WHERE id_post=6');
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $insertdatamenang = $stmt->fetch();

            $Uvarovite = $insertdatamenang['qty_Uvarovite'];
            $Nitrogen = $insertdatamenang['qty_Nitrogen'];


            $stmt2 = $conn->prepare("SELECT * FROM game_kelompok WHERE nama='$nama_kelompok'");
            $stmt2->execute();
            $insertdatakelompok = $stmt2->fetch();
            $quan_Uvarovite = $insertdatakelompok['qty_Uvarovite'];
            $quan_Nitrogen = $insertdatakelompok['qty_Nitrogen'];
            $get_id = $insertdatakelompok['id'];

            $rewardUvarovite = $Uvarovite +  $quan_Uvarovite;
            $rewardNitrogen = $Nitrogen + $quan_Nitrogen;

            //INSERT POIN
            $quan_poin = $insertdatakelompok['poin'];
            $stmtpoin = $conn->prepare("SELECT poin FROM game_hadiahseri WHERE id_post=6");
            $stmtpoin->execute();
            $poin = $stmtpoin->fetch();
            $insertpoint = $poin['poin'];

            $rewardpoint = $insertpoint + $quan_poin;

            //poin='$rewardpoint',


            $stmt3 = $conn->prepare("UPDATE game_kelompok SET poin='$rewardpoint', qty_Uvarovite='$rewardUvarovite', qty_Nitrogen='$rewardNitrogen' WHERE nama='$nama_kelompok'");
            $stmt3->execute();

            //INSERT HISTORY
            $stmt4 = $conn->prepare("INSERT INTO `game_historykelompok`(`id_post`, `id_kelompok`, `status`) VALUES ('6','$get_id','seri')");
            $stmt4->execute();

            if ($stmt3->rowCount() > 0) {
                $_SESSION['msg_successseri'] = true;
            }
        }
    }


    //POS 7
    if ($_SESSION["nama_poss"] == "Whos fast?") {

        $stmt = $conn->prepare('SELECT * FROM game_hadiahseri WHERE id_post=7');
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $insertdatamenang = $stmt->fetch();

            $Fluorit = $insertdatamenang['qty_Fluorit'];
            $Ferumi = $insertdatamenang['qty_Ferumi'];


            $stmt2 = $conn->prepare("SELECT * FROM game_kelompok WHERE nama='$nama_kelompok'");
            $stmt2->execute();
            $insertdatakelompok = $stmt2->fetch();
            $quan_Fluorit = $insertdatakelompok['qty_Fluorit'];
            $quan_Ferumi = $insertdatakelompok['qty_Ferumi'];

            $rewardFluorit = $Fluorit +  $quan_Fluorit;
            $rewardFerumi = $Ferumi + $quan_Ferumi;

            //INSERT POIN
            $quan_poin = $insertdatakelompok['poin'];
            $stmtpoin = $conn->prepare("SELECT poin FROM game_hadiahseri WHERE id_post=7");
            $stmtpoin->execute();
            $poin = $stmtpoin->fetch();
            $insertpoint = $poin['poin'];

            $rewardpoint = $insertpoint + $quan_poin;

            //poin='$rewardpoint',

            $stmt3 = $conn->prepare("UPDATE game_kelompok SET poin='$rewardpoint', qty_Fluorit='$rewardFluorit', qty_Ferumi='$rewardFerumi' WHERE nama='$nama_kelompok'");
            $stmt3->execute();

            //INSERT HISTORY
            $queryKelompok = $conn->prepare("SELECT id FROM `game_kelompok` WHERE nama='$nama_kelompok'");
            $queryKelompok->execute();
            $take_id = $queryKelompok->fetch();
            $get_id = $take_id['id'];

            $stmt4 = $conn->prepare("INSERT INTO `game_historykelompok`(`id_post`, `id_kelompok`, `status`) VALUES ('7','$get_id','seri')");
            $stmt4->execute();

            if ($stmt3->rowCount() > 0) {
                $_SESSION['msg_successseri'] = true;
            }
        }
    }



    //POS 8
    if ($_SESSION["nama_poss"] == "Run and Run") {

        $stmt = $conn->prepare('SELECT * FROM game_hadiahseri WHERE id_post=8');
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $insertdatamenang = $stmt->fetch();

            $Titanium = $insertdatamenang['qty_Titanium'];
            $Lateks = $insertdatamenang['qty_Lateks'];


            $stmt2 = $conn->prepare("SELECT * FROM game_kelompok WHERE nama='$nama_kelompok'");
            $stmt2->execute();
            $insertdatakelompok = $stmt2->fetch();
            $quan_Titanium = $insertdatakelompok['qty_Titanium'];
            $quan_Lateks = $insertdatakelompok['qty_Lateks'];

            $rewardTitanium = $Titanium +  $quan_Titanium;
            $rewardLateks = $Lateks + $quan_Lateks;

            //INSERT POIN
            $quan_poin = $insertdatakelompok['poin'];
            $stmtpoin = $conn->prepare("SELECT poin FROM game_hadiahseri WHERE id_post=8");
            $stmtpoin->execute();
            $poin = $stmtpoin->fetch();
            $insertpoint = $poin['poin'];

            $rewardpoint = $insertpoint + $quan_poin;

            //poin='$rewardpoint',


            $stmt3 = $conn->prepare("UPDATE game_kelompok SET poin='$rewardpoint', qty_Titanium='$rewardTitanium', qty_Lateks='$rewardLateks' WHERE nama='$nama_kelompok'");
            $stmt3->execute();

            //INSERT HISTORY
            $queryKelompok = $conn->prepare("SELECT id FROM `game_kelompok` WHERE nama='$nama_kelompok'");
            $queryKelompok->execute();
            $take_id = $queryKelompok->fetch();
            $get_id = $take_id['id'];

            $stmt4 = $conn->prepare("INSERT INTO `game_historykelompok`(`id_post`, `id_kelompok`, `status`) VALUES ('8','$get_id','seri')");
            $stmt4->execute();

            if ($stmt3->rowCount() > 0) {
                $_SESSION['msg_successseri'] = true;
            }
        }
    }



    //POS 9
    if ($_SESSION["nama_poss"] == "A glimpse of hope") {

        $stmt = $conn->prepare('SELECT * FROM game_hadiahseri WHERE id_post=9');
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $insertdatamenang = $stmt->fetch();

            $Sylvite = $insertdatamenang['qty_Sylvite'];
            $karbon = $insertdatamenang['qty_Karbon'];


            $stmt2 = $conn->prepare("SELECT * FROM game_kelompok WHERE nama='$nama_kelompok'");
            $stmt2->execute();
            $insertdatakelompok = $stmt2->fetch();
            $quan_Sylvite = $insertdatakelompok['qty_Sylvite'];
            $quan_Cuprite = $insertdatakelompok['qty_Cuprite'];

            $rewardSylvite = $Sylvite + $quan_Sylvite;
            $rewardCuprite = $Cuprite + $quan_Cuprite;

            //INSERT POIN
            $quan_poin = $insertdatakelompok['poin'];
            $stmtpoin = $conn->prepare("SELECT poin FROM game_hadiahseri WHERE id_post=9");
            $stmtpoin->execute();
            $poin = $stmtpoin->fetch();
            $insertpoint = $poin['poin'];

            $rewardpoint = $insertpoint + $quan_poin;

            //poin='$rewardpoint',


            $stmt3 = $conn->prepare("UPDATE game_kelompok SET poin='$rewardpoint', qty_Sylvite='$rewardSylvite', qty_Cuprite='$rewardCuprite' WHERE nama='$nama_kelompok'");
            $stmt3->execute();

            //INSERT HISTORY
            $queryKelompok = $conn->prepare("SELECT id FROM `game_kelompok` WHERE nama='$nama_kelompok'");
            $queryKelompok->execute();
            $take_id = $queryKelompok->fetch();
            $get_id = $take_id['id'];

            $stmt4 = $conn->prepare("INSERT INTO `game_historykelompok`(`id_post`, `id_kelompok`, `status`) VALUES ('9','$get_id','seri')");
            $stmt4->execute();

            if ($stmt3->rowCount() > 0) {
                $_SESSION['msg_successseri'] = true;
            }
        }
    }


    //POS 10
    if ($_SESSION["nama_poss"] == "Binding Tower") {

        $stmt = $conn->prepare('SELECT * FROM game_hadiahseri WHERE id_post=10');
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $insertdatamenang = $stmt->fetch();

            $Karbon = $insertdatamenang['qty_Karbon'];
            $Sylvite = $insertdatamenang['qty_Sylvite'];


            $stmt2 = $conn->prepare("SELECT * FROM game_kelompok WHERE nama='$nama_kelompok'");
            $stmt2->execute();
            $insertdatakelompok = $stmt2->fetch();
            $quan_Karbon = $insertdatakelompok['qty_Karbon'];
            $quan_Sylvite = $insertdatakelompok['qty_Sylvite'];

            $rewardKarbon = $Karbon + $quan_Karbon;
            $rewardkarbon = $Sylvite + $quan_Sylvite;

            //INSERT POIN
            $quan_poin = $insertdatakelompok['poin'];
            $stmtpoin = $conn->prepare("SELECT poin FROM game_hadiahseri WHERE id_post=10");
            $stmtpoin->execute();
            $poin = $stmtpoin->fetch();
            $insertpoint = $poin['poin'];

            $rewardpoint = $insertpoint + $quan_poin;

            //poin='$rewardpoint',


            $stmt3 = $conn->prepare("UPDATE game_kelompok SET poin='$rewardpoint', qty_Karbon='$rewardKarbon', qty_Sylvite='$rewardSylvite' WHERE nama='$nama_kelompok'");
            $stmt3->execute();

            //INSERT HISTORY
            $queryKelompok = $conn->prepare("SELECT id FROM `game_kelompok` WHERE nama='$nama_kelompok'");
            $queryKelompok->execute();
            $take_id = $queryKelompok->fetch();
            $get_id = $take_id['id'];

            $stmt4 = $conn->prepare("INSERT INTO `game_historykelompok`(`id_post`, `id_kelompok`, `status`) VALUES ('10','$get_id','seri')");
            $stmt4->execute();

            if ($stmt3->rowCount() > 0) {
                $_SESSION['msg_successseri'] = true;
            }
        }
    }


    //POS 11
    if ($_SESSION["nama_poss"] == "Flowing Ball") {

        $stmt = $conn->prepare('SELECT * FROM game_hadiahseri WHERE id_post=11');
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $insertdatamenang = $stmt->fetch();

            $Silikon = $insertdatamenang['qty_Silikon'];
            $Uvarovite = $insertdatamenang['qty_Uvarovite'];


            $stmt2 = $conn->prepare("SELECT * FROM game_kelompok WHERE nama='$nama_kelompok'");
            $stmt2->execute();
            $insertdatakelompok = $stmt2->fetch();
            $quan_Silikon = $insertdatakelompok['qty_Silikon'];
            $quan_Uvarovite = $insertdatakelompok['qty_Uvarovite'];

            $rewardSilikon = $Silikon + $quan_Silikon;
            $rewardUvarovite = $Uvarovite + $quan_Uvarovite;

            //INSERT POIN
            $quan_poin = $insertdatakelompok['poin'];
            $stmtpoin = $conn->prepare("SELECT poin FROM game_hadiahseri WHERE id_post=11");
            $stmtpoin->execute();
            $poin = $stmtpoin->fetch();
            $insertpoint = $poin['poin'];

            $rewardpoint = $insertpoint + $quan_poin;

            //poin='$rewardpoint',


            $stmt3 = $conn->prepare("UPDATE game_kelompok SET poin='$rewardpoint', qty_Silikon='$rewardSilikon', qty_Uvarovite='$rewardUvarovite' WHERE nama='$nama_kelompok'");
            $stmt3->execute();

            //INSERT HISTORY
            $queryKelompok = $conn->prepare("SELECT id FROM `game_kelompok` WHERE nama='$nama_kelompok'");
            $queryKelompok->execute();
            $take_id = $queryKelompok->fetch();
            $get_id = $take_id['id'];

            $stmt4 = $conn->prepare("INSERT INTO `game_historykelompok`(`id_post`, `id_kelompok`, `status`) VALUES ('11','$get_id','seri')");
            $stmt4->execute();

            if ($stmt3->rowCount() > 0) {
                $_SESSION['msg_successseri'] = true;
            }
        }
    }


    //POS 12
    if ($_SESSION["nama_poss"] == "Multi drawers") {

        $stmt = $conn->prepare('SELECT * FROM game_hadiahseri WHERE id_post=12');
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $insertdatamenang = $stmt->fetch();

            $Nitrogen = $insertdatamenang['qty_Nitrogen'];
            $Poliisoprena = $insertdatamenang['qty_Poliisoprena'];


            $stmt2 = $conn->prepare("SELECT * FROM game_kelompok WHERE nama='$nama_kelompok'");
            $stmt2->execute();
            $insertdatakelompok = $stmt2->fetch();
            $quan_Nitrogen = $insertdatakelompok['qty_Nitrogen'];
            $quan_Poliisoprena = $insertdatakelompok['qty_Poliisoprena'];

            $rewardNitrogen = $Nitrogen + $quan_Nitrogen;
            $rewardPoliisoprena = $Poliisoprena + $quan_Poliisoprena;

            //INSERT POIN
            $quan_poin = $insertdatakelompok['poin'];
            $stmtpoin = $conn->prepare("SELECT poin FROM game_hadiahseri WHERE id_post=12");
            $stmtpoin->execute();
            $poin = $stmtpoin->fetch();
            $insertpoint = $poin['poin'];

            $rewardpoint = $insertpoint + $quan_poin;

            //poin='$rewardpoint',


            $stmt3 = $conn->prepare("UPDATE game_kelompok SET poin='$rewardpoint', qty_Nitrogen='$rewardNitrogen', qty_Poliisoprena='$rewardPoliisoprena' WHERE nama='$nama_kelompok'");
            $stmt3->execute();

            //INSERT HISTORY
            $queryKelompok = $conn->prepare("SELECT id FROM `game_kelompok` WHERE nama='$nama_kelompok'");
            $queryKelompok->execute();
            $take_id = $queryKelompok->fetch();
            $get_id = $take_id['id'];

            $stmt4 = $conn->prepare("INSERT INTO `game_historykelompok`(`id_post`, `id_kelompok`, `status`) VALUES ('12','$get_id','seri')");
            $stmt4->execute();

            if ($stmt3->rowCount() > 0) {
                $_SESSION['msg_successseri'] = true;
            }
        }
    }


    //POS 13
    if ($_SESSION["nama_poss"] == "Tactile Whispers") {

        $stmt = $conn->prepare('SELECT * FROM game_hadiahseri WHERE id_post=13');
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $insertdatamenang = $stmt->fetch();

            $Hematit = $insertdatamenang['qty_Hematit'];
            $Sylvite = $insertdatamenang['qty_Sylvite'];


            $stmt2 = $conn->prepare("SELECT * FROM game_kelompok WHERE nama='$nama_kelompok'");
            $stmt2->execute();
            $insertdatakelompok = $stmt2->fetch();
            $quan_Hematit = $insertdatakelompok['qty_Hematit'];
            $quan_Sylvite = $insertdatakelompok['qty_Sylvite'];

            $rewardHematit = $Hematit + $quan_Hematit;
            $rewardSylvite = $Sylvite + $quan_Sylvite;

            //INSERT POIN
            $quan_poin = $insertdatakelompok['poin'];
            $stmtpoin = $conn->prepare("SELECT poin FROM game_hadiahseri WHERE id_post=13");
            $stmtpoin->execute();
            $poin = $stmtpoin->fetch();
            $insertpoint = $poin['poin'];

            $rewardpoint = $insertpoint + $quan_poin;

            //poin='$rewardpoint',


            $stmt3 = $conn->prepare("UPDATE game_kelompok SET poin='$rewardpoint', poin='$rewardpoint', qty_Hematit='$rewardHematit', qty_Sylvite='$rewardSylvite' WHERE nama='$nama_kelompok'");
            $stmt3->execute();

            //INSERT HISTORY
            $queryKelompok = $conn->prepare("SELECT id FROM `game_kelompok` WHERE nama='$nama_kelompok'");
            $queryKelompok->execute();
            $take_id = $queryKelompok->fetch();
            $get_id = $take_id['id'];

            $stmt4 = $conn->prepare("INSERT INTO `game_historykelompok`(`id_post`, `id_kelompok`, `status`) VALUES ('13','$get_id','seri')");
            $stmt4->execute();

            if ($stmt3->rowCount() > 0) {
                $_SESSION['msg_successseri'] = true;
            }
        }
    }



    //POS 14
    if ($_SESSION["nama_poss"] == "Rubber Bond") {

        $stmt = $conn->prepare('SELECT * FROM game_hadiahseri WHERE id_post=14');
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $insertdatamenang = $stmt->fetch();

            $Hematit = $insertdatamenang['qty_Hematit'];
            $Timbal = $insertdatamenang['qty_Timbal'];


            $stmt2 = $conn->prepare("SELECT * FROM game_kelompok WHERE nama='$nama_kelompok'");
            $stmt2->execute();
            $insertdatakelompok = $stmt2->fetch();
            $quan_Hematit = $insertdatakelompok['qty_Hematit'];
            $quan_Timbal = $insertdatakelompok['qty_Timbal'];

            $rewardHematit = $Hematit + $quan_Hematit;
            $rewardTimbal = $Timbal + $quan_Timbal;

            //INSERT POIN
            $quan_poin = $insertdatakelompok['poin'];
            $stmtpoin = $conn->prepare("SELECT poin FROM game_hadiahseri WHERE id_post=14");
            $stmtpoin->execute();
            $poin = $stmtpoin->fetch();
            $insertpoint = $poin['poin'];

            $rewardpoint = $insertpoint + $quan_poin;

            //poin='$rewardpoint',


            $stmt3 = $conn->prepare("UPDATE game_kelompok SET poin='$rewardpoint', qty_Hematit='$rewardHematit', qty_Timbal='$rewardTimbal' WHERE nama='$nama_kelompok'");
            $stmt3->execute();

            //INSERT HISTORY
            $queryKelompok = $conn->prepare("SELECT id FROM `game_kelompok` WHERE nama='$nama_kelompok'");
            $queryKelompok->execute();
            $take_id = $queryKelompok->fetch();
            $get_id = $take_id['id'];

            $stmt4 = $conn->prepare("INSERT INTO `game_historykelompok`(`id_post`, `id_kelompok`, `status`) VALUES ('14','$get_id','seri')");
            $stmt4->execute();

            if ($stmt3->rowCount() > 0) {
                $_SESSION['msg_successseri'] = true;
            }
        }
    }


    //POS 15
    if ($_SESSION["nama_poss"] == "Lets Have Fun") {

        $stmt = $conn->prepare('SELECT * FROM game_hadiahseri WHERE id_post=15');
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $insertdatamenang = $stmt->fetch();

            $Copper = $insertdatamenang['qty_Copper'];
            $Ferumi = $insertdatamenang['qty_Ferumi'];


            $stmt2 = $conn->prepare("SELECT * FROM game_kelompok WHERE nama='$nama_kelompok'");
            $stmt2->execute();
            $insertdatakelompok = $stmt2->fetch();
            $quan_Copper = $insertdatakelompok['qty_Copper'];
            $quan_Ferumi = $insertdatakelompok['qty_Ferumi'];

            $rewardCopper = $Copper + $quan_Copper;
            $rewardFerumi = $Ferumi + $quan_Ferumi;

            //INSERT POIN
            $quan_poin = $insertdatakelompok['poin'];
            $stmtpoin = $conn->prepare("SELECT poin FROM game_hadiahseri WHERE id_post=15");
            $stmtpoin->execute();
            $poin = $stmtpoin->fetch();
            $insertpoint = $poin['poin'];

            $rewardpoint = $insertpoint + $quan_poin;

            //poin='$rewardpoint',


            $stmt3 = $conn->prepare("UPDATE game_kelompok SET poin='$rewardpoint', qty_Copper='$rewardCopper', qty_Ferumi='$rewardFerumi' WHERE nama='$nama_kelompok'");
            $stmt3->execute();

            //INSERT HISTORY
            $queryKelompok = $conn->prepare("SELECT id FROM `game_kelompok` WHERE nama='$nama_kelompok'");
            $queryKelompok->execute();
            $take_id = $queryKelompok->fetch();
            $get_id = $take_id['id'];

            $stmt4 = $conn->prepare("INSERT INTO `game_historykelompok`(`id_post`, `id_kelompok`, `status`) VALUES ('15','$get_id','seri')");
            $stmt4->execute();

            if ($stmt3->rowCount() > 0) {
                $_SESSION['msg_successseri'] = true;
            }
        }
    }



    //POS 16
    if ($_SESSION["nama_poss"] == "Find My Pair") {

        $stmt = $conn->prepare('SELECT * FROM game_hadiahseri WHERE id_post=16');
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $insertdatamenang = $stmt->fetch();

            $Hematit = $insertdatamenang['qty_Hematit'];
            $Fluorit = $insertdatamenang['qty_Fluorit'];


            $stmt2 = $conn->prepare("SELECT * FROM game_kelompok WHERE nama='$nama_kelompok'");
            $stmt2->execute();
            $insertdatakelompok = $stmt2->fetch();
            $quan_Hematit = $insertdatakelompok['qty_Hematit'];
            $quan_Fluorit = $insertdatakelompok['qty_Fluorit'];

            $rewardHematit = $Hematit + $quan_Hematit;
            $rewardFluorit = $Fluorit + $quan_Fluorit;

            //INSERT POIN
            $quan_poin = $insertdatakelompok['poin'];
            $stmtpoin = $conn->prepare("SELECT poin FROM game_hadiahseri WHERE id_post=16");
            $stmtpoin->execute();
            $poin = $stmtpoin->fetch();
            $insertpoint = $poin['poin'];

            $rewardpoint = $insertpoint + $quan_poin;

            //poin='$rewardpoint',


            $stmt3 = $conn->prepare("UPDATE game_kelompok SET poin='$rewardpoint', qty_Hematit='$rewardHematit', qty_Fluorit='$rewardFluorit' WHERE nama='$nama_kelompok'");
            $stmt3->execute();

            //INSERT HISTORY
            $queryKelompok = $conn->prepare("SELECT id FROM `game_kelompok` WHERE nama='$nama_kelompok'");
            $queryKelompok->execute();
            $take_id = $queryKelompok->fetch();
            $get_id = $take_id['id'];

            $stmt4 = $conn->prepare("INSERT INTO `game_historykelompok`(`id_post`, `id_kelompok`, `status`) VALUES ('16','$get_id','seri')");
            $stmt4->execute();

            if ($stmt3->rowCount() > 0) {
                $_SESSION['msg_successseri'] = true;
            }
        }
    }


    header("Location: ../input_material.php");
}
