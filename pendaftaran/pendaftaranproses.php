    <?php 

    require "../connect.php";

    $success_regist = false;
    $message = '';
    $verifikasi = 3;

    //error_reporting(E_ALL); ini_set('display_errors', 1);

  if($_SERVER["REQUEST_METHOD"] == "POST"){

        header('Content-Type: application/json');

       
        $asalsekolah = trim($_POST['asalsekolah']);
        $namatim = trim($_POST['namatim']);
        $emailketua = $_POST['email'];

        $emailketua = $_POST["email"];
        $pass = $_POST['password'];
        

        $namaketua = ($_POST['namaketua']);
        $nomerwa = ($_POST['nomerwa']);
        $idline1 = ($_POST['idline1']);
        $fotodiri1 = ($_FILES['fotodiri1']['name']);
        $fotopelajar1 = ($_FILES['fotopelajar1']['name']);
        $namapeserta2 = ($_POST['namapeserta2']);
        $idline2 = ($_POST['idline2']);
        $fotodiri2 = ($_FILES['fotodiri2']['name']);
        $fotopelajar2 = ($_FILES['fotopelajar2']['name']);
        $namapeserta3 = ($_POST['namapeserta3']);
        $idline3 = ($_POST['idline3']);
        $fotodiri3 = ($_FILES['fotodiri3']['name']);
        $fotopelajar3 = ($_FILES['fotopelajar3']['name']);
        $buktitrf = (($_FILES['buktitrf']['name']));
        //bukti trf
        $filetmpname7 = $_FILES['buktitrf']['tmp_name'];
        

        // Foto Diri 1
        $fotodiri1_name = $_FILES['fotodiri1']['name'];
        $fileExt1 = explode('.', $fotodiri1_name);
        $filetype1 = strtolower(end($fileExt1));
        $filetmpname1 = $_FILES['fotodiri1']['tmp_name'];

        // Foto Pelajar 1
        $fotopelajar1_name = $_FILES['fotopelajar1']['name'];
        $fileExt2 = explode('.', $fotopelajar1_name);
        $filetype2 = strtolower(end($fileExt2));
        $filetmpname2 = $_FILES['fotopelajar1']['tmp_name'];
        
        // Foto Diri 2
        $fotodiri2_name = $_FILES['fotodiri2']['name'];
        $fileExt3 = explode('.', $fotodiri2_name);
        $filetype3 = strtolower(end($fileExt3));
        $filetmpname3 = $_FILES['fotodiri2']['tmp_name'];

        //Foto Pelajar 2
        $fotopelajar2_name = $_FILES['fotopelajar2']['name'];
        $fileExt4 = explode('.', $fotopelajar2_name);
        $filetype4 = strtolower(end($fileExt4));
        $filetmpname4 = $_FILES['fotopelajar2']['tmp_name'];

        //Foto Diri 3
        $fotodiri3_name = $_FILES['fotodiri3']['name'];
        $fileExt5 = explode('.', $fotodiri3_name);
        $filetype5 = strtolower(end($fileExt5));
        $filetmpname5 = $_FILES['fotodiri3']['tmp_name'];

        //Foto Pelajar 3
        $fotopelajar3_name = $_FILES['fotopelajar3']['name'];
        $fileExt6 = explode('.', $fotopelajar3_name);
        $filetype6 = strtolower(end($fileExt6));
        $filetmpname6 = $_FILES['fotopelajar3']['tmp_name'];

        //Bukti Trf
        $buktitrf_name = $_FILES['fotodiri1']['name'];
        $fileExt7 = explode('.', $buktitrf_name);
        $filetype7 = strtolower(end($fileExt7));

        $allowed = array('jpg', 'png', 'jpeg');

        

        $cek_namatim = $conn->prepare("SELECT nama_kelompok FROM `kelompok` WHERE nama_kelompok = :namatim");
        $cek_namatim->bindParam(':namatim', $namatim);
        $cek_namatim->execute();

        $cek_email = $conn->prepare("SELECT * FROM kelompok where email =?");
        $cek_email->execute([$emailketua]);

        if(empty($namaketua) || empty($idline1) || empty($nomerwa) || empty($fotodiri1) || empty($fotopelajar1) || empty($namapeserta2) || empty($idline2) || empty($fotodiri2) || empty($fotopelajar2) || empty($namapeserta3) || empty($idline3) || empty($fotodiri3) || empty($fotopelajar3))
        {
            $message = 'Data diri masih ada yang kosong! Silahkan mengisi semua data!';
        }
            else if(empty($asalsekolah))
        {
            $message = 'Asal sekolah masih kosong!';
        }
            else if (empty($namatim))
        {
            $message = 'Nama tim masih kosong!';
        }
            else if(empty($emailketua))
        {
            $message = "Email Ketua Tim masih kosong!";
        }
        else if (mb_strlen($namatim) < 3 || mb_strlen($namatim) > 20)
        {
            $message = 'Nama tim tidak boleh kurang dari 3 dan lebih dari 20';
        }
        else if (mb_strlen($asalsekolah) < 5 || mb_strlen($asalsekolah) > 50)
        {
            $message = 'Asal sekolah tidak boleh kurang dari 5 dan lebih dari 50';
        }
        else if ($cek_namatim->rowCount() > 0)
        {
            $message = 'Nama tim sudah digunakan!';
        }
        else if($cek_email->rowCount() > 0){
            $message = 'Email Ketua telah digunakan';
        } 
        else if (!filter_var($emailketua, FILTER_VALIDATE_EMAIL)) 
        {
            $message = "Format Email Ketua tidak valid";
        }
        else if(!in_array($filetype1, $allowed) || !in_array($filetype2, $allowed) || !in_array($filetype3, $allowed) || !in_array($filetype4, $allowed) || !in_array($filetype5, $allowed) || !in_array($filetype6, $allowed))
        {
            $message = 'Tipe file yang dapat digunakan adalah (.jpg, .png, .jpeg)';
        }else if(strlen($pass) < 8){
            $message = 'Password minimal memiliki 8 karakter';
        }
        else
        {
            $success_regist = true;

            // $newFolder = mkdir('uploads/'.$namatim);

            //Leader Foto Diri
            $filenamenew1 = $namaketua.$namatim.'.'.$filetype1;
            $fileDestination3x4 = 'uploads/foto3x4/';
            $targetDir1 = $fileDestination3x4.$filenamenew1;
            $moveLD1 = move_uploaded_file($filetmpname1, $targetDir1);
            
            if(!$moveLD1)
                $message = 'An Error occured while uploading "Foto 3x4 Peserta 1".';

            //Leader Foto Kartu Pelajar
            $filenamenew2 = $namaketua.$namatim.'.'.$filetype2;
            $fileDestinationkp = 'uploads/fotokartupelajar/';
            $targetDir2 = $fileDestinationkp.$filenamenew2;
            $moveLD2 = move_uploaded_file($filetmpname2, $targetDir2);

            if(!$moveLD2)
                $message = 'An Error occured while uploading "Foto Kartu Pelajar Peserta 1".';

            //Peserta 2 Foto Diri
            $filenamenew3 = $namapeserta2.$namatim.'.'.$filetype3;
            $targetDir3 = $fileDestination3x4.$filenamenew3;
            $moveSM1 = move_uploaded_file($filetmpname3, $targetDir3);
            
            if(!$moveSM1)
                $message = 'An Error occured while uploading "Foto 3x4 Peserta 2".';

            //Peserta 2 Kartu Pelajar
            $filenamenew4 = $namapeserta2.$namatim.'.'.$filetype4;
            $targetDir4 = $fileDestinationkp.$filenamenew4;
            $moveSM2 = move_uploaded_file($filetmpname4, $targetDir4);

            if(!$moveSM2)
                $message = 'An Error occured while uploading "Foto Kartu Pelajar Peserta 2".';

            //Peserta 3 Foto Diri
            $filenamenew5 = $namapeserta3.$namatim.'.'.$filetype5;
            $targetDir5 = $fileDestination3x4.$filenamenew5;
            $moveTM1 = move_uploaded_file($filetmpname5, $targetDir5);
            
            if(!$moveTM1)
                $message = 'An Error occured while uploading "Foto 3x4 Peserta 3".';

            //Peserta 3 Kartu Pelajar
            $filenamenew6 = $namapeserta3.$namatim.'.'.$filetype6;
            $targetDir6 = $fileDestinationkp.$filenamenew6;
            $moveTM2 = move_uploaded_file($filetmpname6, $targetDir6);

            if(!$moveTM2)
                $message = 'An Error occured while uploading "Foto Kartu Pelajar Peserta 3".';

            //Bukti Trf
            $filenamenew7 = 'buktitransfer'.$namatim.'.'.$filetype6;
            $fileDestinationtrf = 'uploads/buktitransfer/';
            $targetDir7 = $fileDestinationtrf.$filenamenew7;
            $moveTR = move_uploaded_file($filetmpname7, $targetDir7);

            if(!$moveTR)
                $message = 'An Error occured while uploading "Foto Kartu Pelajar Peserta 2".';

            $insert_data = $conn->prepare("INSERT INTO `kelompok` SET asal_sekolah = ?, nama_kelompok =?, nama_ketua = ?, nomerwa = ?, id_line_ketua = ?, foto_diri_ketua = ?, foto_pelajar_ketua = ?, nama_peserta2 = ?, id_line2 = ?, foto_diri_peserta2 = ?, foto_pelajar2 = ?, nama_peserta3 = ?, id_line3 = ?, foto_diri_peserta3 = ?, foto_pelajar3 = ?, verify = ?, buktitrf = ?, email = ?, `password` = ?");
            // password hash
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $insert_data->execute([$asalsekolah,$namatim,$namaketua,$nomerwa,$idline1,$filenamenew1,$filenamenew2,$namapeserta2,$idline2,$filenamenew3,$filenamenew4,$namapeserta3,$idline3,$filenamenew5,$filenamenew6,$verifikasi,$filenamenew7,$emailketua,$hash]);

            if($insert_data)
            {
                $message = 'Data berhasil dimasukkan, silahkan tunggu sebentar!';
            } else 
            {
                $message = "Terjadi kesalahaan saat memasukkan data, silahkan ulangi kembali!";
            }

            }

            echo json_encode([
                'success_regist' => $success_regist,
                'message' => $message
            ]);
  }
    ?>