<?php
require("connect.php");
$success = false;
$message = '';
//dapetin id kelompok
$sql = "SELECT id FROM day2_kelompok WHERE nama = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_POST['namaKelompok']]);
$id_kelompok = ($stmt->fetch());

if(isset($_POST['bidNumber']) && isset($_POST['harga'])){
    //dapetin id bid
    $sql = "SELECT id FROM day2_bid WHERE no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST['bidNumber']]);
    $id_bid = ($stmt->fetch());
    // var_dump($_POST);


    $cek_exist = $conn->prepare(
    "SELECT id FROM `day2_kelompok_bid` 
    where id_kelompok = 
    (SELECT id from day2_kelompok where nama = \"" . $_POST['namaKelompok'] . "\") 
    AND id_bid = " . $id_bid['id'] );
    $cek_exist->execute();

    $harga = $_POST['harga'];
    //dapetin max bid
    $sql = "SELECT max_bid FROM day2_bid WHERE no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST['bidNumber']]);
    $maxBid = ($stmt->fetch());
    // var_dump($maxBid);

    if ($cek_exist->rowCount() > 0) {
        $message = "Anda sudah pernah membuat bid pada bid " . $_POST['bidNumber'];
    } elseif ($harga > $maxBid['max_bid']) {
        $message = "Maksimum harga yang bisa di bid untuk bid " . $_POST['bidNumber'] . " adalah " . $maxBid['max_bid'];
    } elseif ($harga < 0){
        $message = "Harga tidak bisa kurang dari 0!";
    } else {
    // membuat bid
        $sql = "INSERT INTO day2_kelompok_bid (id_kelompok, id_bid, harga) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_kelompok['id'],$id_bid['id'],$harga]);
        $success = true;
        $message = "Anda berhasil membuat bid!";
    }
}

if(isset($_POST['fixedID'])){
    $cek_exist = $conn->prepare(
        "SELECT id FROM `day2_kelompok_fixed` 
        where id_kelompok = 
        (SELECT id from day2_kelompok where nama = \"" . $_POST['namaKelompok'] . "\")  
        AND id_fixed = " . $_POST['fixedID']);
        $cek_exist->execute();

        if ($cek_exist->rowCount() > 0) {
            $message = "Anda sudah pernah membuat bid pada fixed " . $_POST['fixedNumber'];
        } else {
        // membuat fixed
            $sql = "INSERT INTO day2_kelompok_fixed (id_kelompok, id_fixed) VALUES (?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_kelompok['id'],$_POST['fixedID']]);
            $success = true;
            $message = "Anda berhasil membuat bid!";
        }
}

echo json_encode([
    'success' => $success,
    'message' => $message
]);
?>