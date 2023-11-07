<?php
require_once "../connect.php";
if(!isset($_SESSION['nama_kelompok']) || $_SESSION['nama_kelompok'] == ""){
    header("Location: login.php");
    exit;
}
//get data kelompok & material
$sql = "SELECT id FROM game_kelompok WHERE nama = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION['nama_kelompok']]);
$dataKelompok = $stmt->fetch();
$idKelompok = $dataKelompok['id'];

// query untuk mendapatkan data history kelompok, pada pos tersebut status menang,kalah, mendaptkan apa
$sql = "SELECT * FROM game_historykelompok h 
JOIN game_hadiahmenang m ON h.status = 'menang' && h.id_post = m.id_post
JOIN game_post p ON h.id_post = p.id
WHERE id_kelompok = ?
UNION ALL
SELECT * FROM `game_historykelompok` h 
JOIN game_hadiahseri s on h.status = 'seri' && h.id_post = s.id_post
JOIN game_post p ON h.id_post = p.id
WHERE id_kelompok = ?
UNION ALL
SELECT * FROM `game_historykelompok` h 
JOIN game_hadiahkalah k on h.status = 'kalah' && h.id_post = k.id_post  
JOIN game_post p ON h.id_post = p.id
WHERE id_kelompok = ?
ORDER BY `timestamp` DESC";
$stmt = $conn->prepare($sql);
$stmt->execute(([$idKelompok,$idKelompok,$idKelompok]));
$dataHistory = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyHistory</title>
    <!-- fav icon ic-->
    <link rel="icon" type="image/png" href="../assets/logo%20ic.png">
    <!-- datatable cdn css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
     <!-- Bootstrap CDN -->
 
    <style>
        html{
            scroll-behavior: smooth;
        }
        body {
            margin: 0;
            background-image: url("https://images.unsplash.com/photo-1592093474530-86874167e896?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1901&q=80");
            /* background-image: url(""); */
            /* background-color: #ffffff; */
            background-size: cover;
            background-attachment: fixed;
            min-height: 100vh;
            
        
        }
        .luaran{
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10%; 
            margin-bottom: 100px;
        }
        .container{
            background-color: rgba(168, 162, 158,0.9);
            padding: 0.5% 2.5% 0.5% 2.5%;
            width: 95%;
            
        }
        
        .nav {
            background-color: rgb(106, 4, 4);
            position: sticky;
            top: 0px;
            box-sizing: border-box;    
            display: flex;
            height: 1.5cm;
            z-index: 6;
            float: both;
            /* justify-content: start; */
            align-items: center; 
        }

        .nav a {
            padding: 15px 15px;
            text-decoration: none;
            color: rgb(249, 174, 117);
            font-weight: bolder;
            text-transform: capitalize;
            box-sizing: border-box;
            /* vertical-align: middle; */
        }

        .nav a:hover {
            background-color: rgb(249, 174, 117); 
            color: rgb(95, 0, 19);
            box-shadow: 0px 0px 20px chocolate;
        }

        @media(max-width: 500px){
             .luaran{
                width: 98%;
                margin-left: auto;
                margin-right: auto;
                margin-top: 10%; 
            }
            .container{
                font-size: 13px;
                padding: 2% 1% 2% 1%;
                width: 98%;

            }
        }
    </style>
    
</head>
<body>
    <div class="nav">
        <a href="craft.php">Home</a>
        <a href="myhistory.php">History</a>
        <a href="./logout.php">Logout</a>
    </div>
    <div class="luaran">
        <div class="container">
            <h1 style="text-align: center;">My History</h1>
            <table id="history"  class="display" style="width: 100%;" >
                <thead>
                    <tr>
                        <th>Nama Post</th>
                        <th>Status</th>
                        <th>Poin</th>
                        <th>Material</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $no = 1;
                        foreach($dataHistory as $data):
                    ?>
                            <tr>
                                <td><?= $data['nama']; ?></td>
                                <td><?= $data['status']; ?></td>
                                <td><?= $data['poin']; ?></td>
                                <td><?php
                                    if($data['id_post'] == 1){
                                        echo "Timbal:{$data['qty_Timbal']}x, Karbon:{$data['qty_Karbon']}x ";
                                    }
                                    // 2: Nitrogen Poliisoprena
                                    elseif($data['id_post'] == 2){
                                        echo "Nitrogen:{$data['qty_Nitrogen']}x, Poliisoprena:{$data['qty_Poliisoprena']}x ";
                                    }
                                    // 3: curprite poliisoprena
                                    elseif($data['id_post'] == 3){
                                        echo "Cuprite:{$data['qty_Cuprite']}x, Poliisoprena:{$data['qty_Poliisoprena']}x ";
                                    }
                                    // 4: ferumi silikon
                                    elseif($data['id_post'] == 4){
                                        echo "Ferumi:{$data['qty_Ferumi']}x, Silikon:{$data['qty_Silikon']}x ";
                                    }
                                    // 5:Lateks timbal
                                    elseif($data['id_post'] == 5){
                                        echo "Lateks:{$data['qty_Lateks']}x, Timbal:{$data['qty_Timbal']}x ";
                                    }
                                    // 6: uvarovite nitrogen
                                    elseif($data['id_post'] == 6){
                                        echo "Uvarovite:{$data['qty_Uvarovite']}x, Nitrogen:{$data['qty_Nitrogen']}x ";
                                    }
                                    // 7:ferumi fluorit
                                    elseif($data['id_post'] == 7){
                                        echo "Ferumi:{$data['qty_Ferumi']}x, Fluorit:{$data['qty_Fluorit']}x ";
                                    }
                                    // 8: titanium lateks
                                    elseif($data['id_post'] == 8){
                                        echo "Titanium:{$data['qty_Titanium']}x, Lateks:{$data['qty_Lateks']}x ";
                                    }
                                    
                                    // 9: cuprite sylvite
                                    elseif($data['id_post'] == 9){
                                        echo "Cuprite:{$data['qty_Cuprite']}x, Sylvite:{$data['qty_Sylvite']}x ";
                                    }
                                    // 10: karbon sylvite
                                    elseif($data['id_post'] == 10){
                                        echo "Karbon:{$data['qty_Karbon']}x, Sylvite:{$data['qty_Sylvite']}x ";
                                    }
                                    // 11:uvarovite silikon
                                    elseif($data['id_post'] == 11){
                                        echo "Uvarovite:{$data['qty_Uvarovite']}x, Silikon:{$data['qty_Silikon']}x ";
                                    }
                                    // 12:nitrogen poliisoprena
                                    elseif($data['id_post'] == 12){
                                        echo "Nitrogen:{$data['qty_Nitrogen']}x, Poliisoprena:{$data['qty_Poliisoprena']}x ";
                                    }
                                    // 13:copper silikon
                                    elseif($data['id_post'] == 13){
                                        echo "Copper:{$data['qty_Copper']}x, Silikon:{$data['qty_Silikon']}x ";
                                    }
                                    // 14: timbal hematit
                                    elseif($data['id_post'] == 14){
                                        echo "Timbal:{$data['qty_Timbal']}x, Hematit:{$data['qty_Hematit']}x ";
                                    }
                                    // 15:ferumi copper
                                    elseif($data['id_post'] == 15){
                                        echo "Ferumi:{$data['qty_Ferumi']}x, Copper:{$data['qty_Copper']}x ";
                                    }
                                    // 16:fluorit hematit
                                    elseif($data['id_post'] == 16){
                                        echo "Fluorit:{$data['qty_Fluorit']}x, Hematit:{$data['qty_Hematit']}x ";
                                    }else{
                                        echo "Error silahkan menghubungi penpos";
                                    }

                                    ?></td>
                            </tr>
                    <?php
                        endforeach;

                    ?>
                </tbody>
            </table>
        </div>
    </div>

        

<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- datatable cdn js -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#history').DataTable({
        // "pagingType": "full_numbers",
        "searching":false,
        "order": [],
        "scrollX": true, // Enable horizontal scrolling
        responsive: true,
    });
} );
</script>
</body>
</html