  <!-- Judul -->
  <header>
        <!-- Navbar -->
        <nav>
            <div class="judul">       
                <a href="./chart.php" class="poin-nav <?= ($title == "forecast")? "active": "" ?> ">Forecast</a>
                <a href="./demandTable.php" class="poin-nav <?= ($title == "demand")? "active": "" ?> ">Demand</a>
                <a href="./news.php" class="poin-nav <?= ($title == "news")? "active": "" ?> ">News</a>
                <a href="./B2B/" class="poin-nav <?= ($title == "bid")? "active": "" ?> ">Bid/Fixed</a>
                <a href="./api/logout.php" class="poin-nav bg-danger">Logout</a>
            
            </div>
        </nav>
    </header>