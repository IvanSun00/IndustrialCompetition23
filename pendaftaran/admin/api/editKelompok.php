<?php
require_once "../../../connect.php";
// session_start();
$output = "";
    error_reporting(E_ALL); ini_set('display_errors', 1);





if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // EDIT DATA YANG KURANG
        $email = $_POST['email'];
        $namaCol = $_POST['col-name'];

        if($namaCol == 'nomerwa'){
            $nomerwa = $_POST['nomerwa'];
            $insert_data = $conn->prepare("UPDATE `kelompok` SET nomerwa = ? where email = ?");
            if($insert_data->execute([$nomerwa,$email])){
                $output .= 'success//';
            }else {
                $output .= 'error//';
            }

        }else{
            $stmt = $conn->prepare("select * from kelompok where email = ?");
            $stmt->execute([$email]);
            $row = $stmt->fetch();
            $namaketua = $row['nama_ketua'];
            $namatim = $row['nama_kelompok'];

            $filename = ($_FILES['"'.$namaCol.'"']['name']);
            

            if($namaCol == 'foto_diri_ketua' || $namaCol == 'foto_diri_peserta2' || $namaCol == 'foto_diri_peserta3'){
                // Foto Diri 1
                $fileExt1 = explode('.', $filename);
                $filetype1 = strtolower(end($fileExt1));
                $filetmpname1 = $_FILES['"'.$namaCol.'"']['tmp_name'];

                $fileDestination =   '../../uploads/foto3x4';
                $filenamenew1 = $namaketua.$namatim.'.'.$filetype1;
                $targetDir1 = $fileDestination.$filenamenew1;
                $moveLD1 = move_uploaded_file($filetmpname1, $targetDir1);

                if(!$moveLD1)
                    $message = 'An Error occured while uploading "Foto 3x4 Peserta 1".';


            }
            
            // else if($namaCol == 'foto_pelajar_ketua' || $namaCol == 'foto_pelajar2' || $namaCol == 'foto_pelajar3'){
            //     $fileDestination = 'uploads/fotokartupelajar/';
            // }else if($namaCol == 'buktitrf'){
            //     $fileDestination ='buktitransfer';
            // }
            // //Leader Foto Diri
            // $filenamenew1 = $namaketua.$namatim.'.'.$filetype1;
            
            // $targetDir1 = $fileDestination3x4.$filenamenew1;
            // if(file_exists("uploads/foto3x4/$filenamenew1")) unlink("uploads/foto3x4/$filenamenew1");
            // $moveLD1 = move_uploaded_file($filetmpname1, $targetDir1);
                
            //     if(!$moveLD1){
            //         $output .= 'error';
            //         ini_set('display_errors', 1);
            //         ini_set('display_startup_errors', 1);
            //         error_reporting(E_ALL);
            //     }else{
            //         $output .= 'success';
            //     }
                    
            
        }        
        echo $output;

}


?>