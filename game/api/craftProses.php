<?php
require_once '../../connect.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $output;
    // check apakah sudah login
    if(!isset($_SESSION['nama_kelompok']) || $_SESSION['nama_kelompok'] == ""){
        header('Location: ../login.php');
        exit;
    }


    //ajax response for crafting(parameter: id_bom and id_kelompok)
    //output status and msg
    //Contoh output {"status":"success","msg":"Crafting berhasil"}
    //Contoh output {"status":"error","msg":"Crafting gagal, terjadi error saat memasukkan data"}
    if(isset($_POST['id_bom']) && $_POST['id_bom'] != "" && isset($_POST['id_kelompok']) && $_POST['id_kelompok'] != ""){
        try{
            $conn->beginTransaction();
            $id_bom = $_POST['id_bom'];
            $id_kelompok = $_POST['id_kelompok'];

            //validasi apa sudah pernah craft
            $sql = "SELECT * FROM game_crafting WHERE id_bom = ? AND id_kelompok = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_bom, $id_kelompok]);
            if($stmt->rowCount() > 0){
                $output['status'] = "error";
                $output['msg']= "Sudah pernah craft";
                echo json_encode($output);
                exit;
            }

            //validasi apakah cukup bahan untuk craft 
            $sql = "SELECT * FROM game_bomcost WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_bom]);
            $dataBom = $stmt->fetch();
            $sql = "SELECT * FROM game_kelompok WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_kelompok]);
            $dataKelompok = $stmt->fetch();

            // Ferumi,Lateks,Timbal,Cuprite,Karbon,Uvarovite,Titanium,Sylvite,Silikon,Copper,Nitrogen,Poliisoprena,Fluorit,Hematit
            if($dataKelompok['qty_Ferumi'] < $dataBom['qty_Ferumi'] || $dataKelompok["qty_Lateks"] < $dataBom["qty_Lateks"] || $dataKelompok["qty_Timbal"] < $dataBom["qty_Timbal"] || $dataKelompok["qty_Cuprite"] < $dataBom["qty_Cuprite"] || $dataKelompok["qty_Karbon"] < $dataBom["qty_Karbon"] || $dataKelompok["qty_Uvarovite"] < $dataBom["qty_Uvarovite"] || $dataKelompok["qty_Titanium"] < $dataBom["qty_Titanium"] || $dataKelompok["qty_Sylvite"] < $dataBom["qty_Sylvite"] || $dataKelompok["qty_Silikon"] < $dataBom["qty_Silikon"] || $dataKelompok["qty_Copper"] < $dataBom["qty_Copper"] || $dataKelompok["qty_Nitrogen"] < $dataBom["qty_Nitrogen"] || $dataKelompok["qty_Poliisoprena"] < $dataBom["qty_Poliisoprena"] || $dataKelompok["qty_Fluorit"] < $dataBom["qty_Fluorit"] || $dataKelompok["qty_Hematit"] < $dataBom["qty_Hematit"]){
                $output['status'] = "error";
                $output['msg']= "Bahan tidak cukup";
                echo json_encode($output);
                exit;
            }

            //potong bahan untuk craft
            $sql = "UPDATE game_kelompok SET qty_Ferumi = qty_Ferumi - ?, qty_Lateks = qty_Lateks - ?, qty_Timbal = qty_Timbal - ?, qty_Cuprite = qty_Cuprite - ?, qty_Karbon = qty_Karbon - ?, qty_Uvarovite = qty_Uvarovite - ?, qty_Titanium = qty_Titanium - ?, qty_Sylvite = qty_Sylvite - ?, qty_Silikon = qty_Silikon - ?, qty_Copper = qty_Copper - ?, qty_Nitrogen = qty_Nitrogen - ?, qty_Poliisoprena = qty_Poliisoprena - ?, qty_Fluorit = qty_Fluorit - ?, qty_Hematit = qty_Hematit - ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$dataBom['qty_Ferumi'], $dataBom['qty_Lateks'], $dataBom['qty_Timbal'], $dataBom['qty_Cuprite'], $dataBom['qty_Karbon'], $dataBom['qty_Uvarovite'], $dataBom['qty_Titanium'], $dataBom['qty_Sylvite'], $dataBom['qty_Silikon'], $dataBom['qty_Copper'], $dataBom['qty_Nitrogen'], $dataBom['qty_Poliisoprena'], $dataBom['qty_Fluorit'], $dataBom['qty_Hematit'], $id_kelompok]);
            
         
            //melakukan craft
            $sql = "INSERT INTO game_crafting (id_kelompok, id_bom) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_kelompok, $id_bom]);
            $conn->commit();
            $output['status'] = "success";
            $output['msg']= "Crafting berhasil";
            echo json_encode($output);

        }catch(\Throwable $e){
            if($conn->inTransaction()){
                $conn->rollback();
            }
            $output['status'] = "error";
            $output['msg']= "Crafting gagal, terjadi error saat memasukkan data";
            echo json_encode($output);

        }
        exit;
    }


}
?>