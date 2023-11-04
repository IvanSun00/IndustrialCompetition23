<?php
require_once "../../../connect.php";
header("Content-Type: application/json");


// informasi:
// 0 = bid tidak ditemukan
// 1 = bid sudah selesai tidak ada yang menang
// 2 = ada pemenang
    //return: data, status, msg, sudahPernah, (bid, bidData)/(fixed, fixedData)


if($_SERVER['REQUEST_METHOD']== "POST"){

    if(isset($_POST['for']) && $_POST['for']=="bid"){
        $response;
        $idBid = $_POST["idBid"];

        //ambil data day2_win
        $sql = "SELECT * from day2_win where no_bid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$idBid]);
        $data = $stmt->fetch();
        $response['data'] = $data;

        if($data){
            if($data['id_kelompok']== -1){
                // bid sudah selesai tidak ada yang menang
                $response['status'] = 1;
                $response['msg'] = "Tidak ada pemenang di bid ini";

            }else{
                // ada pemenang
                $response['status'] = 2;

                //check apakah sudah pernah di isi late
                if($data["late"] !== NULL){
                    $response['sudahPernah'] = "Bid sudah Pernah di isi Late";
                }
        
                //cari data kelompok 
                $sql = "SELECT nama from day2_kelompok where id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$data['id_kelompok']]);
                $namakelompok = $stmt->fetch(PDO::FETCH_COLUMN);
                $response['msg'] = "Pemenang bid ini adalah kelompok: ".$namakelompok;
                
                //check jika bid atau fixed
                if($data['type']== 0){
                    // ambil data bid
                    $sql = "SELECT * from day2_bid where no= ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$data['no_bid']]);
                    $databid = $stmt->fetch();
                    if($databid){
                        $response['bid'] = true;
                        $response['bidData'] = $databid;
                    }

                }elseif($data['type']== 1){
                    // ambil data fixed
                    $sql = "SELECT * from day2_fixed where no= ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$data['no_bid']]);
                    $datafixed = $stmt->fetch();
                    if($datafixed){
                        $response['fixed'] = true;
                        $response['fixedData'] = $datafixed;
                    }
                }
            }

        }else{
            //kalo ga ditemukan no bidnya
            $response['status'] = 0;
            $response['msg'] = "Bid tidak ditemukan";

        }

        $response = json_encode($response,JSON_PRETTY_PRINT);
        echo $response;
    }

    if(isset($_POST['for']) && $_POST['for']=="late"){
        $idBid = $_POST["idBid"];
        $late = $_POST["late"];

        $sql = "UPDATE day2_win set late = ? where id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$late,$idBid]);
        if($stmt->rowCount()>0){
            $response['status'] = 1;
            $response['msg'] = "Telat ".$late;
        }else{
            $response['status'] = 0;
            $response['msg'] = "Gagal update late";
        }

        echo json_encode($response,JSON_PRETTY_PRINT);

    }
}else{
    echo "error not allowed";
}




?>