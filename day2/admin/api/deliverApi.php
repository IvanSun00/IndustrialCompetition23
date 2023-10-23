<?php
require_once "../../../connect.php";


// informasi:
// 0 = bid tidak ditemukan
// 1 = bid sudah selesai tidak ada yang menang
// 2 = ada pemenang


if($_SERVER['REQUEST_METHOD']== "POST"){
    $return;
    $idBid = $_POST["idBid"];
    $sql = "SELECT * from day2_win where no_bid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idBid]);
    $data = $stmt->fetch();
    if($data){
        if($data['id_kelompok']== -1){
            // bid sudah selesai tidak ada yang menang
            $return['status'] == 1;
            $return['msg'] = "Tidak ada pemenang di bid ini";
        }else{
            // ada pemenang
            $return['status'] = 2;
            //cari data kelompok 
            $sql = "SELECT nama from day2_kelompok where id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$data['id_kelompok']]);
            $namakelompok = $stmt->fetch(PDO::FETCH_COLUMN);
            $return['msg'] = "Pemenang bid ini adalah kelompok ".$namakelompok;

            // ambil data bid
            $sql = "SELECT * from day2_bid where no= ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$data['no_bid']]);
            $databid = $stmt->fetch();
            if($databid){
                $return['bid'] = true;
                $return['bidData'] = $databid;
            }else{
                
            }

            // ambil data fixed
            $sql = "SELECT * from day2_fixed where no= ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$data['no_bid']]);
            $datafixed = $stmt->fetch();
            if($datafixed){
                $return['fixed'] = true;
                $return['fixedData'] = $datafixed;
            }else{
                $return['fixed'] = false;
            }
        }

    }else{
        //kalo ga ditemukan no bidnya
        $return['status'] = 0;
        $return['msg'] = "Bid tidak ditemukan";

    }

    $return = json_encode($return,JSON_PRETTY_PRINT);
    echo $return;
}else{
    echo "error not allowed";
}




?>