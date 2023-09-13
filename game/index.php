<?php
require_once '../connect.php';
//check apakah sudah login
if(!isset($_SESSION['nama_kelompok']) || $_SESSION['nama_kelompok'] == ""){
    header('Location: login.php');
    exit;
}
//get data kelompok
$sql = "SELECT * FROM game_kelompok WHERE nama_kelompok = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION['nama_kelompok']]);
$dataKelompok = $stmt->fetch();
$idKelompok = $dataKelompok['id'];



//fetch data BOM dan Crafting
$sql = "SELECT b.*, c.id as idCraft, c.id_kelompok, c.id_bom, c.timestamp from game_bomcost b
left JOIN game_crafting c ON b.id = c.id_bom AND id_kelompok =?
order by b.id;";
$stmt = $conn->prepare($sql);
$stmt->execute([$idKelompok]);
$dataCrafting = $stmt->fetchAll();


//check apakah kelompok sudah craft atau belum dan menentuukan tampilannya
$arrOutput;
foreach($dataCrafting as $craft){
    if($craft['idCraft'] != null){
        //tampilan jika sudah craft
        $arrOutput[]= "<h1> {$craft["nama"]} successfully crafted at {$craft["timestamp"]}</h1>";

    }else{
        //tampilan jika belum craft
        if($craft['id'] == 1){
            $arrOutput[]= "<h1>{$craft["nama"]}</h1>";
            $arrOutput[]= "
            <ul>
                <li>
                    Ferumi {$dataKelompok["qty_Ferumi"]} / {$craft["qty_Ferumi"]}
                </li>
            
                <li>
                    Lateks {$dataKelompok["qty_Lateks"]} / {$craft["qty_Lateks"]}
                </li>
            
                <li>
                    Timbal {$dataKelompok["qty_Timbal"]} / {$craft["qty_Timbal"]}
                </li>
            
                <li>
                    Cuprite {$dataKelompok["qty_Cuprite"]} / {$craft["qty_Cuprite"]}
                </li>
            
                <li>
                    Karbon {$dataKelompok["qty_Karbon"]} / {$craft["qty_Karbon"]}
                </li>
            </ul>";

        }else if($craft['id']==2){
            $arrOutput[]= "<h1> {$craft["nama"]} </h1>";
            $arrOutput[]= "<ul>
            <li>
                Uvarovite {$dataKelompok["qty_Uvarovite"]} / {$craft["qty_Uvarovite"]}
            </li>
        
            <li>
                Titanium {$dataKelompok["qty_Titanium"]} / {$craft["qty_Titanium"]}
            </li>
        
            <li>
                Sylvite {$dataKelompok["qty_Sylvite"]} / {$craft["qty_Sylvite"]}
            </li>
        
            <li>
                Silikon {$dataKelompok["qty_Silikon"]} / {$craft["qty_Silikon"]}
            </li>
        
            <li>
            Fluorit {$dataKelompok["qty_Fluorit"]} / {$craft["qty_Fluorit"]}
            </li>
        </ul>";
            
        }else if($craft['id']==3){
            $arrOutput[]= "<h1> {$craft["nama"]} </h1>";
            $arrOutput[]= "<ul>
            <li>
                Ferumi {$dataKelompok["qty_Ferumi"]} / {$craft["qty_Ferumi"]}
            </li>
        
            <li>
                Karbon {$dataKelompok["qty_Karbon"]} / {$craft["qty_Karbon"]}
            </li>
        
            <li>
                Titanium {$dataKelompok["qty_Titanium"]} / {$craft["qty_Titanium"]}
            </li>
        
            <li>
                Copper {$dataKelompok["qty_Copper"]} / {$craft["qty_Copper"]}
            </li>
        </ul>";
            
        }else if($craft['id']==4){
            $arrOutput[]= "<h1> {$craft["nama"]} </h1>";
            $arrOutput[]= "<ul>
            <li> 
                Timbal {$dataKelompok["qty_Timbal"]} / {$craft["qty_Timbal"]}
            </li>
        
            <li>
                Cuprite {$dataKelompok["qty_Cuprite"]} / {$craft["qty_Cuprite"]}
            </li>
        
            <li>
                Uvarovite {$dataKelompok["qty_Uvarovite"]} / {$craft["qty_Uvarovite"]}
            </li>
        
            <li>
                Copper {$dataKelompok["qty_Copper"]} / {$craft["qty_Copper"]}
            </li>
        
            <li>
                Nitrogen {$dataKelompok["qty_Nitrogen"]} / {$craft["qty_Nitrogen"]}
            </li>
        </ul>
            ";

        }else if($craft['id']==5){
            $arrOutput[]= "<h1> {$craft["nama"]} </h1>";
            $arrOutput[]= "<ul>
            <li>
                Lateks {$dataKelompok["qty_Lateks"]} / {$craft["qty_Lateks"]}
            </li> 
        
            <li>
                Silikon {$dataKelompok["qty_Silikon"]} / {$craft["qty_Silikon"]}
            </li>
        
            <li>
                Poliisoprena {$dataKelompok["qty_Poliisoprena"]} / {$craft["qty_Poliisoprena"]}
            </li>
        
            <li>
                Fluorit {$dataKelompok["qty_Fluorit"]} / {$craft["qty_Fluorit"]}
            </li>
        
            <li>
                Hematit {$dataKelompok["qty_Hematit"]} / {$craft["qty_Hematit"]}
            </li>
        </ul>
        ";
        }
    }
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<h1>Crafting</h1>

<?php
foreach($arrOutput as $output){
    echo $output;
}
?>




</body>
</html>