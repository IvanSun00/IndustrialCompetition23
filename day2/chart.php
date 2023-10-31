<?php
require_once "../connect.php";
$sql = "SELECT * FROM `day2_day` WHERE `id` = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$day = $result['day'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- favicon -->
    <link rel="icon" href="../assets/logo ic.png" type="image/png">
    
 

    <style>
        body{
          /* background: rgb(166,136,203); */
          /* background: linear-gradient(180deg, rgba(166,136,203,1) 0%, rgba(92,70,156,1) 35%, rgba(29,38,125,1) 67%, rgba(12,19,79,1) 98%); */
          /* background-position:center ; */
          /* background: linear-gradient(
            50deg,
            hsl(234deg 74% 18%) 0%,
            hsl(234deg 70% 21%) 20%,
            hsl(234deg 67% 25%) 29%,
            hsl(234deg 63% 29%) 36%,
            hsl(238deg 57% 33%) 43%,
            hsl(244deg 49% 37%) 50%,
            hsl(250deg 42% 41%) 57%,
            hsl(256deg 36% 46%) 64%,
            hsl(260deg 34% 53%) 71%,
            hsl(263deg 36% 59%) 80%,
            hsl(267deg 39% 66%) 100%
            ); */
            background: rgb(99, 3, 148);
            background: linear-gradient(13deg, rgba(99, 3, 148, 1) 17%, rgba(9, 23, 55, 1) 100%);

        background-size: cover;
        background-repeat: no-repeat;   
        background-attachment: fixed;
        height: auto;
        


        }
        #Starlight, #Celestial, #Starry, #Starlight2, #Celestial2, #Starry2{
            /* background-color: white; */
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 2%;
            margin-top: 5%;
            margin-bottom: 5%;
        }

        .container{
            height: 500px;
        }

        @media screen and (max-width: 600px) {
            #Starlight, #Celestial, #Starry, #Starlight2, #Celestial2, #Starry2{
                margin-top: 10%;
                margin-bottom: 10%;
            }

            .container{
                height: 300px;
            }   
        }

        @media screen and (max-width: 1200px) and (min-width: 600px) {
            #Starlight, #Celestial, #Starry, #Starlight2, #Celestial2, #Starry2{
                margin-top: 10%;
                margin-bottom: 10%;
            }

            .container{
                height: 450px;
            }   
        }

        nav{
            /* background-color: burlywood; */
            display: flex;
            justify-content: center;
            

        }
        .judul{
            color: whitesmoke;
            background: rgba(50, 10, 100,0.5);
            /* background: linear-gradient(13deg, rgba(99, 3, 148, 1) 17%, rgba(9, 23, 55, 1) 100%); */
            width: 40vw;
            backdrop-filter: blur(3px);

            padding: 0.7% 0;
            display: flex;
            justify-content: center;
            gap:10px;
            border-radius: 100vw;
            position: fixed;


        }
      
        .poin-nav{
            text-decoration: none;
            color: black; 
            background-color: rgba(143, 220, 194 , 0.5);
            border-radius: 100vw;
            backdrop-filter: blur(1px);
            padding: 2% 3%;
            min-width: 5vw;
            text-align: center;
            color: whitesmoke;
            font-weight: bold;
            font-size: 13pt;
        }

        .judul .active{
            background-color: red;
        }
        

     
    </style>
</head>
<body>
    <!-- Judul -->
    <header>
        <!-- Navbar -->
        <nav>
            <div class="judul">       
                <a href="./chart.php" class="poin-nav active ">Forecast</a>
                <a href="./demandTable.php" class="poin-nav">Demand</a>
                <a href="./news.php" class="poin-nav">News</a>
                <a href="./B2B/" class="poin-nav">Bid/Fixed</a>
            
            </div>
        </nav>
    </header>
    <!-- cara solvenya bisa maintainaspectration =false atau kasik height:500px !important; pilih salah satu -->
    <div style=" padding: 2%;" class="container">

        <?php
        if($day < 14):
        ?>
        <canvas width="600px" height="250px" id="Starlight"></canvas>
        <canvas width="600px" height="250px" id="Celestial"></canvas>   
        <canvas width="600px" height="250px" id="Starry"></canvas>
        <?php
        elseif($day >= 14):
        ?>
        
        <canvas width="600px" height="250px" id="Starlight2"></canvas>
        <canvas width="600px" height="250px" id="Celestial2"></canvas>
        <canvas width="600px" height="250px" id="Starry2"></canvas>
        <?php
        endif;
        ?>
    </div>      


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var isPhone = false;
    function detectPhone() {
            if (navigator.userAgent.match(/Android/i)
            || navigator.userAgent.match(/webOS/i)
            || navigator.userAgent.match(/iPhone/i)
            || navigator.userAgent.match(/iPad/i)
            || navigator.userAgent.match(/iPod/i)
            || navigator.userAgent.match(/BlackBerry/i)
            || navigator.userAgent.match(/Windows Phone/i)) {
            isPhone = true ;
        } else {
            isPhone = false ;
        }
        }
        detectPhone();

// Setup (4-14,15-34)
// day1,day2,day3,...,day30,day31,day32,day33,day34
// create data
function data(labels,data1, data2, data3){
    const data = {
        labels: labels,
        datasets: [
            {
            label: 'Cyclone',
            data: data1, 
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            pointHoverBackgroundColor: 'red',
            pointHoverBorderColor: 'red',
            // tension: 0.1
            
        },
            {
            label: 'Stellar',
            data: data2, 
            fill: false,
            borderColor: 'red',
            // tension: 0.1
        },
            {
            label: 'Cruiser',
            data: data3, 
            fill: false,
            borderColor: 'blue',
            // tension: 0.1
        }
    ]
    }
    return data;

}

// configuration
function config(label, data){
    const config = {
        type: 'line',
        data: data,
        options: {
            hoverRadius: 6,
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                position: 'top',
                },
                title: {
                display: true,
                text: "Forecast "+label
                },
                crosshair: {
                    mode: 'x', // You can use 'x' for a vertical crosshair, 'y' for horizontal, or 'xy' for both
                },
            },
            interaction: {
                intersect: isPhone,
                mode: 'index',
            },
            // tooltips: {
            //     mode: 'index',
            //     intersect: false,
            // },
            hover: {
                mode: 'index',
                intersect: isPhone,
                animationDuration: 0,
            },
        },
    };
    return config;
}

</script>

<!-- bagian 1 -->
<?php
        if($day < 14):
?>
<script>
const labels = ["day4","day5","day6","day7","day8","day9","day10","day11","day12","day13","day14"];

//separuh pertama
const Starlight_Cyclone1 = [5,5,9,4,8,5,10,7,5,6,7];
const Starlight_Stellar1 = [2,3,3,3,2,4,5,2,5,4,4];
const Starlight_Cruiser1 = [1,9,6,1,1,1,3,4,2,3,3];

const Celestial_Cyclone1 = [5,11,11,11,8,6,7,5,5,6,9];
const Celestial_Stellar1 = [5,3,4,3,3,3,6,4,3,4,6];
const Celestial_Cruiser1 = [9,4,1,4,5,9,4,1,2,4,4];

const Starry_Cyclone1 = [5,4,8,4,8,3,7,9,4,5,3];
const Starry_Stellar1 = [2,4,1,2,2,4,3,1,1,1,3];
const Starry_Cruiser1 = [5,1,2,1,9,1,2,8,6,13,8];

// isi data
const dataStarlight1 = data(labels, Starlight_Cyclone1, Starlight_Stellar1, Starlight_Cruiser1);
const dataCelestial1 = data(labels, Celestial_Cyclone1, Celestial_Stellar1, Celestial_Cruiser1);
const dataStarry1 = data(labels, Starry_Cyclone1, Starry_Stellar1, Starry_Cruiser1);

//isi config
const configStarlight1 = config("Starlight Odyssey", dataStarlight1);
const configCelestial1 = config("Celestial Flare", dataCelestial1);
const configStarry1 = config("Starry Twilight", dataStarry1);

// render chart part1
var myChart = new Chart(
    document.getElementById('Starlight'),
    configStarlight1
);
var myChart = new Chart(
    document.getElementById('Celestial'),
    configCelestial1
);
var myChart = new Chart(
    document.getElementById('Starry'),
    configStarry1
);
</script>

<!--bagian 2 -->
<?php
        elseif($day >= 14):
?>
<script>
const labels2 = ["day15","day16","day17","day18","day19","day20","day21","day22","day23","day24","day25","day26","day27","day28","day29","day30","day31","day32","day33","day34"];
    
//separuh kedua
const Starlight_Cyclone2 = [5,8,5,4,7,5,6,5,10,5,5,5,6,9,4,7,6,5,7,5];
const Starlight_Stellar2 = [5,3,2,6,3,4,2,6,3,3,5,2,3,5,5,2,3,2,5,2];
const Starlight_Cruiser2 = [5,2,1,10,1,9,1,1,3,2,5,1,2,6,2,4,2,1,8,1];

const Celestial_Cyclone2 = [5,6,7,11,10,7,5,5,9,5,10,7,10,6,7,11,5,8,10,7];
const Celestial_Stellar2 = [4,3,6,3,4,5,5,3,3,3,3,3,4,3,6,3,3,4,6,4];
const Celestial_Cruiser2 = [3,7,5,2,6,3,2,1,7,1,6,2,6,10,2,2,1,2,2,1];

const Starry_Cyclone2 = [3,7,5,5,3,6,9,9,9,5,9,6,9,3,7,4,9,7,7,6];
const Starry_Stellar2 = [3,4,4,4,2,3,3,4,1,3,1,2,1,2,3,1,4,2,2,1];
const Starry_Cruiser2 = [11,6,4,11,9,2,5,3,2,6,5,7,6,2,8,10,3,8,10,13];

// isi data
const dataStarlight2 = data(labels2, Starlight_Cyclone2, Starlight_Stellar2, Starlight_Cruiser2);
const dataCelestial2 = data(labels2, Celestial_Cyclone2, Celestial_Stellar2, Celestial_Cruiser2);
const dataStarry2 = data(labels2, Starry_Cyclone2, Starry_Stellar2, Starry_Cruiser2);

// isi config
const configStarlight2 = config("Starlight Odyssey", dataStarlight2);
const configCelestial2 = config("Celestial Flare", dataCelestial2);
const configStarry2 = config("Starry Twilight", dataStarry2);

// render chart part2
var myChart = new Chart(
    document.getElementById('Starlight2'),
    configStarlight2
);
var myChart = new Chart(
    document.getElementById('Celestial2'),
    configCelestial2
);
var myChart = new Chart(
    document.getElementById('Starry2'),
    configStarry2
);
</script>
<?php
        endif;
?>
</body>
</html>