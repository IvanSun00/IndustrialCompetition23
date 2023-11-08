<?php 
require_once("../../connect.php");
$title = "demand";

if(!isset($_SESSION['nrp_admin']) || $_SESSION['nrp_admin'] == ""){
    header("Location: index.php");
    exit();
}
?>

<?php
$sql = "SELECT * FROM day2_demandtable dt
JOIN day2_day dd ON dt.day=dd.day";
$stmt = $conn->prepare($sql);
$stmt->execute();
$data = $stmt->fetch();
//var_dump($data);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Demand Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">  
    <!-- favicon -->
    <link rel="icon" href="../../assets/logo ic.png" type="image/png">

<style>
    html{
        scroll-behavior: smooth;
    }
    body{
        /* background: linear-gradient(13deg, rgba(99, 3, 148, 1) 17%, rgba(9, 23, 55, 1) 100%); */
        background-color: whitesmoke;
        min-height: 100vh;
        padding-bottom: 25vw;
        /* background-color: #202731; */
    }
    .table {
        font-family: 'PT Serif', serif;
        width: 100%;
        /* background-color: rgba(255, 255, 255, 0) !important; */
    }
    #judul{
        /* font-family: 'Gentium Book Plus', serif; */
        font-family: 'PT Serif', serif;
    }
    /* .thead{
        height: 100px;
        justify-content: center;
        text-align: center;
        padding-bottom: 10px;
        vertical-align: center; }*/

        .container{
            /* background: linear-gradient(13deg, rgba(99, 3, 148, 1) 17%, rgba(9, 23, 55, 1) 100%); */
            background-color: var(--bs-dark);
            box-shadow: 0px 1px 2px 0px rgba(255,255,255,0.2),
            1px 2px 4px 0px rgba(255,255,255,0.2),
            2px 2px 8px 0px rgba(255,255,255,0.2),
            2px 2px 8px 0px rgba(255,255,255,0.2);
        }

        .isi{
            position: relative;
            top: 7vw;
        }
        /* th, td{
            background-color: rgba(255, 255, 255, 0) !important;
            color: white !important;
        }
        td{
            border-bottom: 1px solid rgba(255, 255, 255, 0.5) !important;
        } */
    
</style>
<link rel="stylesheet" href="./assets/nav.css">
</head>
<body class="">  
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
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
                        <a class="nav-link " href="news.php">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="DealAdmin/">Deal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active " href="./demand.php">DemandTable</a>
                    </li>
                <li class="nav-item">
                        <a class="nav-link" href="rank.php">Rank</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger " href="api/logout.php">Logout</a>
                </li>
                </ul>
                </div>
            </div>
            </nav>

    <div class="isi">
    <section class= " px-3" id="sec-top">
        <div class="container p-4 mt-3 text-light text-center rounded-4" id="judul">
            <h1 >STARLIGHT ODYSSEY</h1>
        <!-- </div> -->
        <!-- <div class="container bg-dark py-4 px-4 text-light text-center" id="tabel"> -->
        <table class="table table-striped  mt-5">
            <thead class="thead">
                <tr>
                    <th>Cruiser</th>
                    <th>Stellar</th>
                    <th>Cyclone</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                    <td> <?= $data['starlight_cruiser']; ?></td>
                    <td> <?= $data['starlight_stellar']; ?></td>
                    <td> <?php echo $data['starlight_cyclone']; ?></td>
        
                </tr>
            </tbody>
        </table>
  </tbody>
</table>
        </div>

    </section>

    <section class= "px-3 pt-5">
        <div class="container bg-dark p-4 text-light text-center rounded-4" id="judul">
            <h1 >CELESTIAL FLARE</h1>
        <!-- </div> -->
        <!-- <div class="container bg-dark py-4 px-4 text-light text-center" id="tabel"> -->
        <table class="table table-bordered table-striped table-hover mt-5">
            <thead class="thead">
                <tr>
                    
                    <th>Cruiser</th>
                    <th>Stellar</th>
                    <th>Cyclone</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $data['celestial_cruiser'];?></td>
                    <td><?= $data['celestial_stellar'];?></td>
                    <td><?= $data['celestial_cyclone'];?></td>
                </tr>
            </tbody>
        </table>
  </tbody>
</table>
        </div>

    </section>

    <section class= " px-3 pt-5">
        <div class="container bg-dark p-4 text-light text-center rounded-4 " id="judul">
            <h1 >STARRY TWILIGHT</h1>
        <!-- </div> -->
        <!-- <div class="container bg-dark py-4 px-4 text-light text-center" id="tabel"> -->
        <table class="table table-bordered table-striped table-hover mt-5">
            <thead>
                <tr>
                    
                    <th>Cruiser</th>
                    <th>Stellar</th>
                    <th>Cyclone</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $data['starry_cruiser'];?></td>
                    <td><?= $data['starry_stellar'];?></td>
                    <td><?= $data['starry_cyclone'];?></td>
                </tr>
            </tbody>
        </table>
  </tbody>
</table>
        </div>

    </section>
    </div>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>