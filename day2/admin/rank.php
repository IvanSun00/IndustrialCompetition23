<?php
require_once ("../../connect.php");
$sql = "SELECT * FROM `day2_kelompok` ORDER BY uang DESC,sertifikasi DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rank = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rank Peserta</title>

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gloock&family=Montserrat:wght@400;800&family=Roboto:ital,wght@0,100;1,100&display=swap" rel="stylesheet">
    <!-- bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- favicon -->
    <link rel="icon" href="../../assets/logo ic.png" type="image/png">
    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        .utama{
            border: 1px solid black;
        }

       
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="../../assets/Logo Putih.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
                <span class="ms-2">Admin Page</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-4" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 p-0 ">
            <li class="nav-item">
                    <a class="nav-link" href="super_admin/">Super Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="input_sertifikasi/">Input Sertifikasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="delivery.php">Delivery</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="news.php">News</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="DealAdmin/">Deal</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link " href="demand.php">DemandTable</a>
                    </li>
                <li class="nav-item">
                        <a class="nav-link active" href="rank.php">Rank</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger " href="api/logout.php">Logout</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

<div class="container text-center mb-3 ">
    <h2>Ranking Uang Peserta</h2>
</div>
<div class="container mt-2 p-3 utama">
<table id="rank"  class="display" style="width:100%;" >
    <thead>
        <tr>

            <th>Nama Kelompok</th>
            <th>Uang</th>
            <th>Sertifikasi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($rank as $key => $value){
                if($value['nama'] == "dummy"){
                    continue;
                }
                echo "<tr>";
                echo "<td>" . $value['nama'] . "</td>";
                echo "<td>" . $value['uang'] . "</td>";
                echo "<td>" . $value['sertifikasi'] . "</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>
    
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#rank').DataTable({
            ordering: false,
            paging:false,
            responsive: true,
            "scrollX": true, // Enable horizontal scrolling
            
        });
    } );
</script>

</body>
</html>