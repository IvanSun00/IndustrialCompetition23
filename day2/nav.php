 <?php 
require_once __DIR__."/../connect.php";

// ambil uang
$sql = "SELECT * FROM day2_kelompok WHERE nama = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION['nama_kelompok']]);
$uang = $stmt->fetch()['uang'];

 ?>
 <!-- Judul -->
  <header>
        <!-- Navbar -->
        <nav id="myNav" >
            <div class="judul">       
                <a href="./chart.php" class="poin-nav <?= ($title == "forecast")? "active": "" ?> ">Forecast</a>
                <a href="./demandTable.php" class="poin-nav <?= ($title == "demand")? "active": "" ?> ">Demand</a>
                <a href="./news.php" class="poin-nav <?= ($title == "news")? "active": "" ?> ">News</a>
                <a href="./B2B/" class="poin-nav <?= ($title == "bid")? "active": "" ?> ">Deals</a>
                <a href="./api/logout.php" class="poin-nav bg-danger">Logout</a>
            </div>
        </nav>

        <nav class="navbar navbar-dark navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Industrial Game</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link <?= ($title == "forecast")? "active": "" ?>" href="./chart.php">forecast</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link <?= ($title == "demand")? "active": "" ?> " href="./demandTable.php">Demand</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link <?= ($title == "news")? "active": "" ?>" href="./news.php">News</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link <?= ($title == "bid")? "active": "" ?>" href="./B2B/" >Deals</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-danger " href="./api/logout.php" >Logout</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

        <!-- uang -->
        <!-- <div class="uang text-end ">
                <span class="uang-text">Uang: <span class="uang-value"><?= $uang ?></span></span>
            </div> -->
    </header>