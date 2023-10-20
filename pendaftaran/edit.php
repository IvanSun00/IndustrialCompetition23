<?php 

require "../connect.php";

$success_regist = false;
$success_data = false;
// $insert_data =false;
$message = '';
$verifikasi = 3;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    header('Content-Type: application/json');

    $allowed = array('jpg', 'png', 'jpeg');

    $nama_kelompok = $_SESSION['nama_kelompok'];

    $stmt =$conn->prepare('SELECT * FROM kelompok where nama_kelompok=?');
    $stmt->execute([$nama_kelompok]);
    $data = $stmt->fetch();
        
   

    $email = $data['email'];

    $namaketua = ($_POST['namaketua']);
    $nomerwa = ($_POST['nomerwa']);
    $idline1 = ($_POST['idline1']);
    $namapeserta2 = ($_POST['namapeserta2']);
    $idline2 = ($_POST['idline2']);
    $namapeserta3 = ($_POST['namapeserta3']);
    $idline3 = ($_POST['idline3']);
    $fileDestinationkp = 'uploads/fotokartupelajar/';
    $fileDestination3x4 = 'uploads/foto3x4/';


    //Edit Data Yang Lain
    if(empty($namaketua) || empty($idline1) || empty($nomerwa) || empty($namapeserta2) || empty($idline2) || empty($namapeserta3) || empty($idline3) )
    {
        $message = 'Data diri masih ada yang kosong! Silahkan mengisi semua data!';
    }else{
     
        //insert data
        $sqlInsert = "UPDATE `kelompok` SET nama_ketua = ?, nomerwa = ?, id_line_ketua = ?, nama_peserta2 = ?, id_line2 = ?, nama_peserta3 = ?, id_line3 = ? where nama_kelompok = ?";
        $insertStmt = $conn->prepare($sqlInsert);
        $insertStmt->execute([$namaketua,$nomerwa,$idline1,$namapeserta2,$idline2,$namapeserta3,$idline3,$nama_kelompok]);
       
    
       
        if(!$insertStmt){
            $message = 'Gagal mengubah data';
        }else{
            $success_data = true;
            // Masukan File
            //Ketua (Foto Diri)
            $fotodiri1 = ($_FILES['fotodiri1']['name']);
            if($fotodiri1){ 
            
                $fotodiri1_name = $_FILES['fotodiri1']['name'];
                $fileExt1 = explode('.', $fotodiri1_name);
                $filetype1 = strtolower(end($fileExt1));
                $filetmpname1 = $_FILES['fotodiri1']['tmp_name'];
            
                if(!in_array($filetype1, $allowed))
                {
                    $message = 'Tipe file yang dapat digunakan adalah (.jpg, .png, .jpeg)';
                }else{
                    //Leader Foto Diri
                    $filenamenew1 = $namaketua.$nama_kelompok.'.'.$filetype1;
                    $targetDir1 = $fileDestination3x4.$filenamenew1;
                    $moveLD1 = move_uploaded_file($filetmpname1, $targetDir1);
                    
                    if(!$moveLD1){
                        $message = 'Error saat mengupload foto';
                    }else{
                        $insert_data = $conn->prepare("UPDATE `kelompok` SET foto_diri_ketua = ?,verify = ? where email = ?");
                        $insert_data->execute([$filenamenew1,3,$email]);
                        if($insert_data){
                            $message = 'Berhasil mengubah data';
                            $success_regist = true;

                        }else{
                            $message = 'Gagal mengubah data';
                        }
                    }
                }
            }

            //foto kartu pelajar ketua
            $fotopelajar1 =($_FILES['fotopelajar1']['name']);
            
            if($fotopelajar1){
                // Foto pelajar 1
                $fotopelajar1_name = $_FILES['fotopelajar1']['name'];
                $fileExt2 = explode('.', $fotopelajar1_name);
                $filetype2 = strtolower(end($fileExt2));
                $filetmpname2 = $_FILES['fotopelajar1']['tmp_name'];
                if(!in_array($filetype2, $allowed))
                {
                    $message = 'Tipe file yang dapat digunakan adalah (.jpg, .png, .jpeg)';
                }else{
                    //Foto pelajar 1
                    $filenamenew2 = $namaketua.$nama_kelompok.'.'.$filetype2;
                
                    $targetDir2 = $fileDestinationkp.$filenamenew2;
                    $moveLD2 = move_uploaded_file($filetmpname2, $targetDir2);
                
                    if(!$moveLD2){
                        $message = 'Error saat mengupload foto';
                    }else{
                        $insert_data = $conn->prepare("UPDATE `kelompok` SET foto_pelajar_ketua = ?,verify = ? where email=?");
                        $insert_data->execute([$filenamenew2,3,$email]);
                        if($insert_data){
                                $message = 'Berhasil mengubah data';
                                $success_regist = true;
                            }else{
                                $message = 'Gagal mengubah data';
                            }
                    }
                    
                }
            }

            //foto peserta 2
            
            $fotodiri2 = ($_FILES['fotodiri2']['name']);
            
            if($fotodiri2){
                // Foto Diri 2
                $fotodiri2_name = $_FILES['fotodiri2']['name'];
                $fileExt2 = explode('.', $fotodiri2_name);
                $filetype2 = strtolower(end($fileExt2));
                $filetmpname3 = $_FILES['fotodiri2']['tmp_name'];
                if(!in_array($filetype2, $allowed))
                {
                    $message = 'Tipe file yang dapat digunakan adalah (.jpg, .png, .jpeg)';
                }else{

                    $filenamenew3 = $namapeserta2.$nama_kelompok.'.'.$filetype2;
                    $targetDir2 = $fileDestination3x4.$filenamenew3;
                    $moveLD3 = move_uploaded_file($filetmpname3, $targetDir2);
                    
                    if(!$moveLD3){
                        $message = 'Error saat mengupload foto';
                    }else{
                        $insert_data = $conn->prepare("UPDATE `kelompok` SET foto_diri_peserta2 = ?,verify = ? where email=?");
                        $insert_data->execute([$filenamenew3,3,$email]);
                        if($insert_data){
                            $message = 'Berhasil mengubah data';
                            $success_regist = true;
                        }else{
                            $message = 'Gagal mengubah data';
                        }
                    }
                    
                }

            }

            //foto kartu peljar peserta 2
            $fotopelajar2 = ($_FILES['fotopelajar2']['name']);
        
            if($fotopelajar2){
                $fotopelajar2_name = $_FILES['fotopelajar2']['name'];
                $fileExt4 = explode('.', $fotopelajar2_name);
                $filetype4 = strtolower(end($fileExt4));
                $filetmpname4 = $_FILES['fotopelajar2']['tmp_name'];
                if(!in_array($filetype4, $allowed))
            {
                $message = 'Tipe file yang dapat digunakan adalah (.jpg, .png, .jpeg)';
            }else{
                //Peserta 2 Kartu Pelajar
                $filenamenew4 = $namapeserta2.$nama_kelompok.'.'.$filetype4;
                $targetDir4 = $fileDestinationkp.$filenamenew4;
                $moveSM2 = move_uploaded_file($filetmpname4, $targetDir4);
                if(!$moveSM2){
                    $message = 'An Error occured while uploading "Foto Kartu Pelajar Peserta 2';
                }else{
                    $insert_data = $conn->prepare("UPDATE `kelompok` SET foto_pelajar2 = ?,verify = ? where email =?");
                    $insert_data->execute([$filenamenew4,3,$email]);
                    if($insert_data){
                        $message = 'Berhasil mengubah data';
                        $success_regist = true;
                    }else{
                        $message = 'Gagal mengubah data';
                    }
                }
            }
            }
            

            //foto peserta 3
            $fotodiri3 = ($_FILES['fotodiri3']['name']);
            if($fotodiri3){
                
                $fotodiri3_name = $_FILES['fotodiri3']['name'];
                $fileExt5 = explode('.', $fotodiri3_name);
                $filetype5 = strtolower(end($fileExt5));
                $filetmpname5 = $_FILES['fotodiri3']['tmp_name'];
                    if(!in_array($filetype5, $allowed))
                {
                    $message = 'Tipe file yang dapat digunakan adalah (.jpg, .png, .jpeg)';
                }else{
                    //Peserta 3 Foto Diri
                    $filenamenew5 = $namapeserta3.$nama_kelompok.'.'.$filetype5;
                    $targetDir5 = $fileDestination3x4.$filenamenew5;
                    $moveTM1 = move_uploaded_file($filetmpname5, $targetDir5);
                    
                    if(!$moveTM1){
                        $message = 'An Error occured while uploading "Foto 3x4 Peserta 3".';
                    }else{
                        $insert_data = $conn->prepare("UPDATE `kelompok` SET foto_diri_peserta3 = ?,verify = ? where email=?");
                        $insert_data->execute([$filenamenew5,3,$email]);
                        if($insert_data){
                            $message = 'Berhasil mengubah data';
                            $success_regist = true;
                        }else{
                            $message = 'Gagal mengubah data';
                        }
                    }
                }
            }

            //foto kartu pelajar peserta 3
            $fotopelajar3 = ($_FILES['fotopelajar3']['name']);
            if($fotopelajar3){
                $fotopelajar3_name = $_FILES['fotopelajar3']['name'];
                $fileExt6 = explode('.', $fotopelajar3_name);
                $filetype6 = strtolower(end($fileExt6));
                $filetmpname6 = $_FILES['fotopelajar3']['tmp_name'];
                if(!in_array($filetype6, $allowed)){
                    $message = 'Tipe file yang dapat digunakan adalah (.jpg, .png, .jpeg)';
                }else{
                    //Peserta 3 Kartu Pelajar
                    $filenamenew6 = $namapeserta3.$nama_kelompok.'.'.$filetype6;
                    $targetDir6 = $fileDestinationkp.$filenamenew6;
                    $moveTM2 = move_uploaded_file($filetmpname6, $targetDir6);
            
                    if(!$moveTM2){
                        $message = 'An Error occured while uploading "Foto Kartu Pelajar Peserta 3".';
                    }else{
                        $insert_data = $conn->prepare("UPDATE `kelompok` SET foto_pelajar3 = ?,verify = ? where email=?");
                        $insert_data->execute([$filenamenew6,3,$email]);
                        if($insert_data){
                            $message = 'Berhasil mengubah data';
                            $success_regist = true;
                        }else{
                            $message = 'Gagal mengubah data';
                        }
                    }
                }
            }

            //buktitrf
            $buktitrf = (($_FILES['buktitrf']['name']));
            if($buktitrf){
                $filetmpname7 = $_FILES['buktitrf']['tmp_name'];
                $buktitrf_name = $_FILES['buktitrf']['name'];
                $fileExt7 = explode('.', $buktitrf_name);
                $filetype7 = strtolower(end($fileExt7));
            
                if(!in_array($filetype7, $allowed))
                {
                    $message = 'Tipe file yang dapat digunakan adalah (.jpg, .png, .jpeg)';
                }else{
                    //Bukti Trf
               
                    $filenamenew7 = 'buktitransfer'.$nama_kelompok.'.'.$filetype7;
                    $fileDestinationtrf = 'uploads/buktitransfer/';
                    $targetDir7 = $fileDestinationtrf.$filenamenew7;
                    $moveTR = move_uploaded_file($filetmpname7, $targetDir7);
                  
                    if(!$moveTR){
                        $message = 'An Error occured while uploading "Bukti Transfer".';
                    }else{
                            $insert_data = $conn->prepare("UPDATE `kelompok` SET buktitrf = ?,verify = ? where email=?");
                            $insert_data->execute([$filenamenew7,3,$email]);
                            if($insert_data){
                                $message = 'Berhasil mengubah data';
                                $success_regist = true;
                            }else{
                                $message = 'Gagal mengubah data';
                            }
                    }
                
                }
            }


        }
    }

    echo json_encode([
        'success_data' => $success_data,
        'success_regist' => $success_regist,
        'message' => $message,
    ]);
    exit() ;


}
?>