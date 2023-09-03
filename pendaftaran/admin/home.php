<?php
require_once "../../connect.php";
if(!isset($_SESSION['nrp_admin']) || $_SESSION['nrp_admin'] == ""){
    header("Location: index.php");
    exit();
}

    $nrp_panit = $_SESSION['nrp_admin'];

    //GET DIVISI & NAMA PANITIA
    $getIDSql = "SELECT a.nama AS namaku, d.nama AS divisiku FROM panitia a JOIN divisi d ON a.id_divisi = d.id WHERE nrp = ?";
    $getIDAction = $conn->prepare($getIDSql);
    $getIDAction->execute([$nrp_panit]);
    $getIDRow = $getIDAction->fetch();
    $divisiPanit = $getIDRow['divisiku'];    
    $namaPanit = $getIDRow['namaku'];

    $icon = '';
    if ($divisiPanit == 'BPH') { $icon .= '<i class="fas fa-key"></i>'; }
    else if ($divisiPanit == 'IT') { $icon .= '<i class="fas fa-tv"></i>'; } 
    else if ($divisiPanit == 'Acara') { $icon .= '<i class="fas fa-microphone-alt"></i>'; }
    else if ($divisiPanit == 'Creative') { $icon .= '<i class="fas fa-camera-retro"></i>' ; }
    else if ($divisiPanit == 'Humas') { $icon .= '<i class="fas fa-phone-square"></i>'; }
    else if ($divisiPanit == 'Materi') { $icon .= '<i class="fas fa-book"></i>'; }
    else if ($divisiPanit == 'Perlengkapan') { $icon .= '<i class="fas fa-tools"></i>'; }
    else if ($divisiPanit == 'Sekretariat') { $icon .= '<i class="fas fa-scroll"></i>'; }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "partials/header.php"; ?>
    <title>Admin IC 2023 - Home</title>

    <style>
        @font-face {
            font-family: Poppins-Medium;
            src: url(assets/fonts/Poppins-Medium.ttf);
        }

        body {
            background-color: rgb(236 232 232);
            background-repeat: no-repeat;
            min-height: 100vh;
            font-family: Poppins-Medium;
        }

        @-webkit-keyframes tracking-in-expand-fwd{0%{letter-spacing:-.5em;-webkit-transform:translateZ(-700px);transform:translateZ(-700px);opacity:0}40%{opacity:.6}100%{-webkit-transform:translateZ(0);transform:translateZ(0);opacity:1}}@keyframes tracking-in-expand-fwd{0%{letter-spacing:-.5em;-webkit-transform:translateZ(-700px);transform:translateZ(-700px);opacity:0}40%{opacity:.6}100%{-webkit-transform:translateZ(0);transform:translateZ(0);opacity:1}}

        @-webkit-keyframes tracking-in-expand-fwd{0%{letter-spacing:-.5em;-webkit-transform:translateZ(-700px);transform:translateZ(-700px);opacity:0}40%{opacity:.6}100%{-webkit-transform:translateZ(0);transform:translateZ(0);opacity:1}}@keyframes tracking-in-expand-fwd{0%{letter-spacing:-.5em;-webkit-transform:translateZ(-700px);transform:translateZ(-700px);opacity:0}40%{opacity:.6}100%{-webkit-transform:translateZ(0);transform:translateZ(0);opacity:1}}
        @-webkit-keyframes tracking-in-expand-fwd-bottom{0%{letter-spacing:-.5em;-webkit-transform:translateZ(-700px) translateY(500px);transform:translateZ(-700px) translateY(500px);opacity:0}40%{opacity:.6}100%{-webkit-transform:translateZ(0) translateY(0);transform:translateZ(0) translateY(0);opacity:1}}@keyframes tracking-in-expand-fwd-bottom{0%{letter-spacing:-.5em;-webkit-transform:translateZ(-700px) translateY(500px);transform:translateZ(-700px) translateY(500px);opacity:0}40%{opacity:.6}100%{-webkit-transform:translateZ(0) translateY(0);transform:translateZ(0) translateY(0);opacity:1}}

        #nama {
            font-size: 60px;
            position: relative;
        }

        #div {
            font-size: 45px;
            position: relative;
            font-style: italic;
        }

        @media only screen and (max-width: 768px){
            #nama {
                font-size: 40px;
            }
            #div {
                font-size: 33px;
            }
        }
    </style>
</head>
<body>
    <?php include "partials/navbar.php"; ?>
    <div class="container" style="margin-top: 220px;">
        <h1 id="nama" class="text-center" style="animation: 1.5s cubic-bezier(0.215, 0.61, 0.355, 1) 0s 1 normal none running tracking-in-expand-fwd; margin-bottom: 10px;">
            <?= $namaPanit; ?>
        </h1>

        <h2 class="text-center" id="div" style="animation: 1s cubic-bezier(0.215, 0.61, 0.355, 1) 1.6s 1 normal both running tracking-in-expand-fwd-bottom;">
            Divisi <?= $divisiPanit; ?> &nbsp;<?= $icon; ?>
        </h2>
    </div>

    <script>
        $(document).ready(function() {
            $(".homeNavbar").addClass("active disabled");
        });
    </script>
</body>
</html>