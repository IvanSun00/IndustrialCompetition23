<?php
require_once("../../connect.php");
$title = "news";
if(!isset($_SESSION['nrp_admin']) || $_SESSION['nrp_admin'] == ""){
    header("Location: index.php");
    exit();
}
// fetch day
$sql = "SELECT * from day2_day where id =1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$data = $stmt->fetch();
$day = $data['day'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.5.2/sweetalert2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.5.2/sweetalert2.all.min.js"></script>

    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">

        <!-- favicon -->
        <link rel="icon" href="../../assets/logo ic.png" type="image/png">
    <style>

        body {
            /* background-color: #202731; */
            overflow-x: hidden;
            margin: 0;
        }

        .flip {
            transform: rotate(180deg);
        }

        h2 {
            font-family: 'Playfair Display', serif;
            font-weight: 300;
            /* animation: lights 5s 750ms linear infinite; */
            font-size: 3.5rem;
        }

        @keyframes lights {
            0% {
                color: hsl(230, 40%, 80%);
                text-shadow:
                    0 0 1em hsla(320, 100%, 50%, 0.2),
                    0 0 0.125em hsla(320, 100%, 60%, 0.3),
                    -1em -0.125em 0.5em hsla(40, 100%, 60%, 0),
                    1em 0.125em 0.5em hsla(200, 100%, 60%, 0);
            }

            30% {
                color: hsl(230, 80%, 90%);
                text-shadow:
                    0 0 1em hsla(320, 100%, 50%, 0.5),
                    0 0 0.125em hsla(320, 100%, 60%, 0.5),
                    -0.5em -0.125em 0.25em hsla(40, 100%, 60%, 0.2),
                    0.5em 0.125em 0.25em hsla(200, 100%, 60%, 0.4);
            }

            40% {
                color: hsl(230, 100%, 95%);
                text-shadow:
                    0 0 1em hsla(320, 100%, 50%, 0.5),
                    0 0 0.125em hsla(320, 100%, 90%, 0.5),
                    -0.25em -0.125em 0.125em hsla(40, 100%, 60%, 0.2),
                    0.25em 0.125em 0.125em hsla(200, 100%, 60%, 0.4);
            }

            70% {
                color: hsl(230, 80%, 90%);
                text-shadow:
                    0 0 1em hsla(320, 100%, 50%, 0.5),
                    0 0 0.125em hsla(320, 100%, 60%, 0.5),
                    0.5em -0.125em 0.25em hsla(40, 100%, 60%, 0.2),
                    -0.5em 0.125em 0.25em hsla(200, 100%, 60%, 0.4);
            }

            100% {
                color: hsl(230, 40%, 80%);
                text-shadow:
                    0 0 1em hsla(320, 100%, 50%, 0.2),
                    0 0 0.125em hsla(320, 100%, 60%, 0.3),
                    1em -0.125em 0.5em hsla(40, 100%, 60%, 0),
                    -1em 0.125em 0.5em hsla(200, 100%, 60%, 0);
            }

        }

        .card-title {
            font-size: 20px;
            color: white;
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
        }

        .card-text {
            font-size: 15px;
            color: white;
            font-family: 'Poppins', sans-serif;

        }

        .card {
            display: block;
            top: 0px;
            position: relative;
            max-width: 262px;
            padding: 32px 24px;
            margin: 12px;
            text-decoration: none;
            z-index: 0;
            overflow: hidden;
            border: 1px solid;
            border-radius: 13px;
            background: rgb(99, 3, 148);
            background: linear-gradient(13deg, rgba(99, 3, 148, 1) 17%, rgba(9, 23, 55, 1) 100%);
            transition: all 0.5s ease-in-out;
        }

        .card:hover {
            box-shadow: 7px 10px 10px rgba(255, 255, 255, 0.2);
            top: -4px;
            border: 1px solid #cccccc;
            border-radius: 13px;
            background-color: white;
            transform: scale(1.05);
        }

        .card:hover:before {
            transform: scale(2.15);
        }

        /* .container-fluid {
            bottom: 50vw;
        } */
        .content {
            /* min-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
            position: relative; */
            /* min-height: 100%; */
            /* position: relative; */
            min-height: 100vh;
        }


    </style>
    <link rel="stylesheet" href="./assets/nav.css">
</head>
<body class="news m-0 p-0">
   
        <header>
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
                        <a class="nav-link active " href="news.php">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="DealAdmin/">Deal</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link " href="demand.php">DemandTable</a>
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
        </header>

        <main>
            <div class="mt-3 mb-2">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid m-0 p-0">
                        <h2 class=" me-auto ms-auto">NEWS</h2>
                    </div>
                </nav>
            </div>
            <div style="margin-left: 2vw; margin-right: 2vw; position: relative" class="p-2">
                <!-- <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4"> -->
                <div>
                    <?php
                        $sql = "SELECT * 
                        FROM day2_news N where day<= $day
                        ORDER BY N.day DESC";
                    $result = $con->query($sql);
                    $previousDay = 0; // Membuat variabel untuk melacak hari sebelumnya
                    while ($row = $result->fetch_assoc()) {
                        $currentDay = $row['day'];
                        // Memeriksa jika hari saat ini berbeda dari hari sebelumnya
                        if ($currentDay != $previousDay) {
                            // Tutup baris sebelumnya (jika ada)
                            if ($previousDay != 0) {
                                echo '</div>';
                            }
                            // Mulai baris baru
                            ?>
                            <div class="row text-center ">
                                <h3 class=" col-12">DAY <?php echo $row['day'] ?></h3>
                            <!-- </div> -->
                            <?php
                        }
                    ?>
                        <div class="col-12 col-md-4">
                            <div class="card mb-3 mx-auto mx-md-0 " style="max-width: 540px;">
                                <div class="row g-0">
                                    <!-- <div class="col-md-4">
                                <img src="..." class="img-fluid rounded-start" alt="...">
                                </div> -->
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <h5 class="card-title text-center"><?php echo $row['judul'] ?></h5>
                                            <p class="card-text text-center"><?php echo $row['content'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        $previousDay = $currentDay;

                    }
                    ?>
                </div>
            </div>

        </main>

</body>



</html>