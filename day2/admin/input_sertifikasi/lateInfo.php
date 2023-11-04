<?php
require_once "../../../connect.php";


// ambil seluruh table yg kelompoknya sesuai session
// 

// belum pengecekan kalau masih late = null biarin aja
// if(isset($_SESSION['namekel_day2'])){
//     $bid;
//     $fixed;
//     $kaa;
//     // data kelompok dan bid
//     $sql = "SELECT w.*,k.nama FROM day2_win w JOIN
//     day2_kelompok k on w.id_kelompok = k.id
//     where k.nama = ? and late is not null;";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute([$_SESSION['namekel_day2']]);

//     while($data = $stmt->fetch()){
//         // jika bid
//         if($data['type']==0){
//             $stmt2 = $conn->prepare("SELECT * FROM `day2_bid` b JOIN day2_kelompok_bid kb on b.id = kb.id_bid WHERE no = ? AND id_kelompok = ?;");
//             $stmt2->execute([$data['no_bid'], $data['id_kelompok']]);
//             $databid = $stmt2->fetch();
//             $databid['data'] = $data;

//             $bid[] = $databid;

//         }
//         // jika fixed
//         else if($data['type']==1){
//             $stmt2 = $conn->prepare("SELECT * FROM day2_fixed where no = ?");
//             $stmt2->execute([$data['no_bid']]);
//             $datafixed = $stmt2->fetch();
//             $datafixed['data'] = $data;
//             $fixed[] = $datafixed;
//         }
//     }

  
//     echo "<pre>";
//     var_dump($bid);
//     echo "</pre>";
//     echo "<br>";
//     echo "<pre>";
//     var_dump($fixed);
//     echo "</pre>";
//     // print
//     echo "<table class='table table-bordered'>";
//     foreach($bid as $data1){
//         echo "<tr>";
//         echo "<td>".$data1['no']."</td>";
//         echo "<td>".$data1['day']."</td>";
//         echo "<td>".$data1['jumlah']."</td>";
//         echo "<td>".$data1['harga']."</td>";
//         echo "<td>".$data1['result_day']."</td>";
//         echo "<td><button class='btn btn-danger' onclick='deleteBid(".$data['no'].")'>Delete</button></td>";
//         echo "</tr>";
//     }
//     echo "</table>";
// }


if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['idBid']) && isset($_POST['kondisi'])){
        $idBid = $_POST["idBid"];
        $kondisi = $_POST["kondisi"];
        var_dump($idBid);
        var_dump($kondisi);

        $sql = "UPDATE day2_win SET status=0 where id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$idBid]);
        if($stmt->rowCount()>0){
            $_SESSION['archive'] = 1;
            echo "success";
        }else{
            $_SESSION['archive'] = 0;
            echo "failed";
        }

    }
    header("Location: index.php");

}else{
    echo "error not allowed";
    header("Location: index.php") ;   
}


?>
