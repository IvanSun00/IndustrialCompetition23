<?php
    require_once "../../../connect.php";
    $output = '';
    
    use PHPMailer\PHPMailer\PHPMailer;
    
    
    
    require_once 'PHPMailer/PHPMailer.php';
    require_once 'PHPMailer/SMTP.php';
    require_once 'PHPMailer/Exception.php';

    if($_SERVER['REQUEST_METHOD']=="POST"){
        if (!isset($_SESSION['nrp_admin']) || $_SESSION['nrp_admin'] == "") {
            $output = "session//index.php";
            echo $output;
            exit();
        }
        $nrp_panit = $_SESSION['nrp_admin'];
        // $nrp_panit = "C14220210";

        
        //GET ID PANITIA
        $getIDSql = "SELECT * FROM `panitia` WHERE nrp = ?";
        $getIDAction = $conn->prepare($getIDSql);
        $getIDAction->execute([$nrp_panit]);
        $getIDRow = $getIDAction->fetch();
        $idPanit = $getIDRow['id'];
        
        //get data admin berdarsarkan id
        if (isset($_POST['for']) && $_POST['for'] != "" && $_POST['for'] == "getAdmin" && isset($_POST['nrp']) && $_POST['nrp'] != "" ) {
            $nrp = $_POST['nrp'];
            
            //ambil data
            $getAdminSql = "SELECT p.nama,d.nama as divisi FROM `panitia`p join divisi d on p.id_divisi = d.id WHERE nrp = ?";
            $getAdminAction = $conn->prepare($getAdminSql);
            $getAdminAction->execute([$nrp]);
            $getAdminRow = $getAdminAction->fetch(PDO::FETCH_ASSOC);

            echo json_encode($getAdminRow);
            exit();
            
        }

        // New Admin 
        if (isset($_POST['for']) && $_POST['for'] != "" && $_POST['for'] == "addAdmin" && isset($_POST['nrp']) && $_POST['nrp'] != "" && isset($_POST['nama']) && $_POST['nama'] != "" && isset($_POST['divisi']) && $_POST['divisi'] != "") {
            $nrp = $_POST['nrp'];
            $nama = $_POST['nama'];
            $divisi = $_POST['divisi'];

            //cek apakah sudah admin
            $cekAdminSql = "SELECT * FROM `panitia` WHERE nrp = ? and is_admin = 1 and nama = ?";
            $cekAdminAction = $conn->prepare($cekAdminSql);
            $cekAdminAction->execute([$nrp,$nama]);
            $checkAdminCount = $cekAdminAction->rowCount();

            if ($checkAdminCount == 1) {
                $output .= 'already//';
            }else{
                //jadikan admin
                $updateAdmin = "UPDATE panitia SET is_admin = 1 WHERE nrp = ?";
                $updateAdminAction = $conn->prepare($updateAdmin);
                $updateAdminAction->execute([$nrp]);

                if ($updateAdminAction) {
                    $output .= 'success//';
                }else{
                    $output .= 'error//';
                }
                
            }


        }
        

        //GET DATA ALL PENDAFTAR
        if (isset($_POST['for']) && $_POST['for'] != "" && $_POST['for'] == "getData") {
            $output .= "success//";
            
            //GET PENDAFTAR YANG SUDAH NDAFTAR
            $getDataSql = "SELECT * FROM `kelompok` ORDER BY tanggal_daftar DESC";
            $getDataAction = $conn->prepare($getDataSql);
            $getDataAction->execute();
            
            $i = 1;
            while ($getDataRow = $getDataAction->fetch()){
                $newDate = date("d-m-Y", strtotime($getDataRow['tanggal_daftar']));
                $output .= '<tr class="mid">
                                <td>'.$i++.'</td>
                                <td>'.$getDataRow['nama_kelompok'].'</td>
                                <td>'.$getDataRow['asal_sekolah'].'</td>
                                <td>'.$getDataRow['email'].'</td>
                                <td>'.$getDataRow['nomerwa'].'</td>
                                <td>'.$getDataRow['id_line_ketua'].'</td>
                                <td><button type="button" class="btn btn-primary detail">View</button></td>
                                <td>'.$newDate.'</td>
                                <td><button type="button" data-val="'.$getDataRow['buktitrf'].'" class="btn btn-warning bukti">View</button></td>';
                               
                

                if ($getDataRow['verify'] == 1) {
                    $getAdminSql = "SELECT * FROM `panitia` WHERE id = ?";
                    $getAdminAction = $conn->prepare($getAdminSql);
                    $getAdminAction->execute([$getDataRow['validasi_by']]);
                    $getAdminRow = $getAdminAction->fetch();
                    $namaPanit = $getAdminRow['nama'];
                    $output .= '<td style="color: red;"><i class="fas fa-times-circle"></i><br>
                                Rejected By<br><span style="font-weight: bold;">'.$namaPanit.'</span></td>';
                }
                else if ($getDataRow['verify'] == 2) {
                    $output .= '<td class="nunggu" data-val="'.$getDataRow['pesan'].'"><div id="rotate"><i class="fas fa-hourglass-half"></i></div>Waiting for Data Completion</td>';
                }
                else if ($getDataRow['verify'] == 3) {
                    $output .= '<td><button type="button" class="btn btn-success valid">Validasi</button></td>';
                }
                else if ($getDataRow['verify'] == 4) {
                    $getAdminSql = "SELECT * FROM `panitia` WHERE id = ?";
                    $getAdminAction = $conn->prepare($getAdminSql);
                    $getAdminAction->execute([$getDataRow['validasi_by']]);
                    $getAdminRow = $getAdminAction->fetch();
                    $namaPanit = $getAdminRow['nama'];
                    $output .= '<td style="color: green;"><i class="fas fa-check-circle"></i><br>
                                Validated By<br><span style="font-weight: bold;">'.$namaPanit.'</span></td>';
                }       
                $output .='<td>'. $getDataRow['pesan'].'</td>';         
                $output .= '</tr>'; 
            }
        }
        
        //GET DETAIL KELOMPOK
        if (isset($_POST['for']) && $_POST['for'] != "" && isset($_POST['email']) && $_POST['email'] != "" && $_POST['for'] == "detailAnggota") {
            $output .= "success//";
            $email = $_POST['email'];
            $satu = '';
            $dua = '';
            $tiga = '';
            $empat = '';

            //GET ID KELOMPOK
            $getIDSql = "SELECT * FROM `kelompok` WHERE email = ?";
            $getIDAction = $conn->prepare($getIDSql);
            $getIDAction->execute([$email]);
            $getIDRow = $getIDAction->fetch();
            $idKelompok = $getIDRow['id'];

            //GET SEMUA ANGGOTA KELOMPOK
            $getDataSql = "SELECT * FROM `kelompok` WHERE id = ?";
            $getDataAction = $conn->prepare($getDataSql);
            $getDataAction->execute([$idKelompok]);
            $getDataRow = $getDataAction->fetch();
            $satu .= '<div class="row justify-content-center mb-4"><div class="col-9"><label for="exampleFormControlInput'.$getDataRow['id'].'" class="form-label tebal" style="text-align: center;">Nama Lengkap</label><input type="text" class="form-control" id="exampleFormControlInput'.$getDataRow['id'].'" value="'.$getDataRow['nama_ketua'].'" disabled></div></div><div class="row justify-content-center"><div class="col-12 text-center mb-2 tebal">Pas Foto</div><div class="col-12"><img class="img-custom" src="../uploads/foto3x4/'.$getDataRow['foto_diri_ketua'].'" alt=""></div></div><span class="row justify-content-center mt-1 mb-4">Click to enlarge image</span><div class="row justify-content-center"><div class="col-12 text-center mb-2 tebal">Kartu Pelajar</div><div class="col-12"><img class="img-custom" src="../uploads/fotokartupelajar/'.$getDataRow['foto_pelajar_ketua'].'" alt=""></div></div><span class="row justify-content-center mt-1">Click to enlarge image</span>';
            $dua .= '<div class="row justify-content-center mb-4">
            <div class="col-9"><label for="exampleFormControlInput'.$getDataRow['id'].'" class="form-label tebal" style="text-align: center;">Nama Lengkap</label><input type="text" class="form-control" id="exampleFormControlInput'.$getDataRow['id'].'" value="'.$getDataRow['nama_peserta2'].'" disabled></div></div>
            <div class="row justify-content-center"><div class="col-12 text-center mb-2 tebal">Pas Foto</div>
            <div class="col-12"><img class="img-custom" src="../uploads/foto3x4/'.$getDataRow['foto_diri_peserta2'].'" alt=""></div></div><span class="row justify-content-center mt-1 mb-4">Click to enlarge image</span>
            <div class="row justify-content-center"><div class="col-12 text-center mb-2 tebal">Kartu Pelajar</div><div class="col-12"><img class="img-custom" src="../uploads/fotokartupelajar/'.$getDataRow['foto_pelajar2'].'" alt=""></div></div><span class="row justify-content-center mt-1">Click to enlarge image</span>';
            $tiga .= '<div class="row justify-content-center mb-4">
            <div class="col-9"><label for="exampleFormControlInput'.$getDataRow['id'].'" class="form-label tebal" style="text-align: center;">Nama Lengkap</label><input type="text" class="form-control" id="exampleFormControlInput'.$getDataRow['id'].'" value="'.$getDataRow['nama_peserta3'].'" disabled></div></div>
            <div class="row justify-content-center"><div class="col-12 text-center mb-2 tebal">Pas Foto</div>
            <div class="col-12"><img class="img-custom" src="../uploads/foto3x4/'.$getDataRow['foto_diri_peserta3'].'" alt=""></div></div><span class="row justify-content-center mt-1 mb-4">Click to enlarge image</span>
            <div class="row justify-content-center"><div class="col-12 text-center mb-2 tebal">Kartu Pelajar</div><div class="col-12"><img class="img-custom" src="../uploads/fotokartupelajar/'.$getDataRow['foto_pelajar3'].'" alt=""></div></div><span class="row justify-content-center mt-1">Click to enlarge image</span>';
            $output .= $satu.'//'.$dua.'//'.$tiga;
        }
        
        
        //VALIDASI KELOMPOK
        else if (isset($_POST['for']) && $_POST['for'] == 'validasi' && $_POST['for'] != "" && isset($_POST['email']) && $_POST['email'] != "") {
            error_reporting(E_ALL); ini_set('display_errors', 1);
            $emailKelompok = $_POST['email'];

            //GET ID KELOMPOK
            $getIDSql = "SELECT * FROM `kelompok` WHERE email = ?";
            $getIDAction = $conn->prepare($getIDSql);
            $getIDAction->execute([$emailKelompok]);
            $getIDRow = $getIDAction->fetch();
            $idKelompok = $getIDRow['id'];
            $namaKelompok = $getIDRow['nama_kelompok'];

            //CHECK APAKAH SUDAH DI UPDATE
            if ($getIDRow['verify'] != 3 && $getIDRow['verify'] != 2) {
                $output .= 'already//';
                echo $output;
                exit();
            }
            else {
                //EMAIL
                $mail= new PHPMailer();
                $name = 'Industrial Competition 2023';
                $subject ='Industrial Competition Registration';
		        // $email = "c14210109@john.petra.ac.id";
		        // $email = "c14220210@john.petra.ac.id";
                $email = $emailKelompok;

                //SMTP Setting
                // $mail->SMTPDebug = 2;  //untuk debugging
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                // $mail->Username = 'IndustrialCompetitionUKP@gmail.com';
                // $mail->Password = 'kxwtkecsxxilcbxc';
                $mail->Username = 'ivansunjay04@gmail.com';
                $mail->Password = 'yozjbryipyolgrfx';
                $mail->Port = 587; //465->SSL 587->TLS
                $mail->SMTPSecure = 'tls'; // 'tls'

                //Email Setting
                $mail->isHTML(true);
                $mail->setFrom($mail->Username,$name);
                $mail->addAddress($email);
                // $mail->AddCC("IndustrialCompetitionUKP@gmail.com");
                $mail->Subject = $subject;
                
                //perlu ganti path image
                $body = 
                    '<body style="background-image: linear-gradient(to bottom, #622097, #741d94, #841a91, #93188e, #a0178a); overflow:hidden; color: #223B55; padding: 25px 20px 30px 20px;">
                    <div class="wrapper" style=" width:fit-content; padding: 20px; height:fit-content; margin:0 auto; margin-top: 2%; min-width: 200px; width: 350px; background-color: #c096eb; border: 2px solid #223B55; border-radius: 10px;">
                        <img src="https://ic.petra.ac.id/ic2023/assets/logo%20ic.png" style="height: 80px;border-radius:100px; display: block;margin: auto;">
                        
                        <h2 style="text-align: center; font-weight: 300; color: #223B55;">Hello, '.$namaKelompok.'!</h2>
                        
                        <p style="text-align: center; color: #223B55;">Your team registration has been verified!</p>
                        
                        <div>
                            <img style="text-align: center; margin-top: 30px; width: 40px; display: block; margin-left: auto;  margin-right: auto;" src="https://img.icons8.com/pastel-glyph/64/ffffff/clipboard-approve--v1.png"/>
                        </div>
                        
                        <div class="container" style="padding: 16px;">
                            <h4 style="text-align: center; color: #223B55;">If you have any questions, please contact:</h4>
                            
                            <button type="submit" style="background-color: #FCCFEC; color: #223B55; border: none; cursor: pointer; width: 60%; margin: 5px auto; padding: 8px; border-radius: 50px; border: 2px solid #223B55; display:block; text-align:center;
                                                ">
                                                    <a href="https://line.me/ti/p/~654jeemx" style="color:#223B55; text-decoration: none;" target="_blank">654jeemx</a>
                                                </button>
                                            </div>
                                        </div>
                                    </body>';

                $mail->Body = $body;
                $check = $mail->send();                

                if($check) { //error di emailnya gk kekirim
                // if(true){
                
                    //UPDATE TEAM
                    $updateTeamsql = "UPDATE `kelompok` SET verify= 4, pesan = NULL, validasi_by = ? WHERE id = ?";
                    $updateTeamstmt = $conn->prepare($updateTeamsql);
                    $updateTeamstmt->execute([$idPanit, $idKelompok]);
                    if ($updateTeamstmt) {
                        $output .= 'success//';
                    }
                    else {
                        $output .= 'error!';
                    }
                }
                else{
                    $output .= 'error';
                    echo "Mailer Error: " . $mail->ErrorInfo;
                }
            }

        }

        
        //DATA KELOMPOK TIDAK VALID, UPLOAD ULANG
        else if (isset($_POST['for']) && $_POST['for'] == 'lengkapiData' && $_POST['for'] != "" && isset($_POST['email']) && $_POST['email'] != "" && isset($_POST['text']) && $_POST['text'] != "") {
            $emailKelompok = $_POST['email'];
            $kurang = $_POST['text'];

            //GET ID KELOMPOK
            $getIDSql = "SELECT * FROM `kelompok` WHERE email = ?";
            $getIDAction = $conn->prepare($getIDSql);
            $getIDAction->execute([$emailKelompok]);
            $getIDRow = $getIDAction->fetch();
            $idKelompok = $getIDRow['id'];
            $namaKelompok = $getIDRow['nama_kelompok'];

            if ($getIDRow['verify'] != 3) {
                $output .= 'already//';
                echo $output;
                exit();
            }
            else {
                //EMAIL
                $mail= new PHPMailer();
                $name = 'Industrial Competition 2023';
                $subject ='Industrial Competition Registration';
                // $email = "c14210109@john.petra.ac.id";
                $email = $emailKelompok;

                //SMTP Setting
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                // $mail->Username = 'IndustrialCompetitionUKP@gmail.com';
                // $mail->Password = 'kxwtkecsxxilcbxc';
                $mail->Username = 'ivansunjay04@gmail.com';
                $mail->Password = 'yozjbryipyolgrfx';
                $mail->Port = 587; //465->SSL 587->TLS
                $mail->SMTPSecure = 'tls'; // 'tls'

                //Email Setting
                $mail->isHTML(true);
                $mail->setFrom($mail->Username,$name);
                $mail->addAddress($email);
                // $mail->AddCC("IndustrialCompetitionUKP@gmail.com");
                $mail->Subject = $subject;

                $body = 
                    '<body style="background-image: linear-gradient(to bottom, #622097, #741d94, #841a91, #93188e, #a0178a); overflow:hidden;  color: #223B55; padding: 25px 20px 25px 20px;">
                        
                    <div class="wrapper" style=" width:fit-content; padding: 20px; height:fit-content; margin:0 auto; margin-top: 2%; min-width: 200px; width: 350px; background-color: #c096eb; border: 2px solid #223B55; border-radius: 10px;">
                        <img src="https://ic.petra.ac.id/ic2022/assets/logo%20ic.png" style="height: 70px;  border-radius:100px; display: block;margin: auto;">
                    
                            <h2 style="text-align: center; font-weight: 300; color: #2c1a47;">Hello, '.$namaKelompok.'!</h2>

                            <p style="text-align: center; color: #2c1a47;">Registration was not completed.<br>Please upload the right document!</p>

                            <p style="text-align: center; color: #2c1a47;">'.$kurang.'</p>
                            <p style="text-align: center; color: #2c1a47;">Login ke website <a href="https://ic.petra.ac.id/">ic.petra.ac.id</a>. Lalu, lihat di navbar dan pencet halaman `Edit Registration` untuk mengupload ulang document yang benar.</p>
                            
                           
                            <div class="container" style="padding: 16px;">
                                <h4 style="text-align: center; color: #2c1a47;">If you have any questions, please contact:</h4>

                                <button type="submit" style="background-color: #FCCFEC; color: #223B55; border: none; cursor: pointer; width: 60%; margin: 5px auto; padding: 8px; border-radius: 50px; border: 2px solid #223B55; display:block; text-align:center;
                                ">
                                    <a href="https://line.me/ti/p/~654jeemx" style="color:#223B55; text-decoration: none;" target="_blank">654jeemx</a>
                                </button>
                            </div>
                        </div>
                    </body>';

                $mail->Body = $body;

                if($mail->send()) {
                // if(true){
                    //UPDATE TEAM
                    $updateTeamsql = "UPDATE `kelompok` SET `verify`= 2, validasi_by = NULL, pesan = ? WHERE id = ?";
                    $updateTeamstmt = $conn->prepare($updateTeamsql);
                    $updateTeamstmt->execute([$kurang, $idKelompok]);
            
                    if ($updateTeamstmt) {
                        $output .= 'success//';
                    }
                    else {
                        $output .= 'error';
                    }
                }
                else {
                    $output .= 'error';
                }
            }
        }


        //TOLAK KELOMPOK
        else if (isset($_POST['for']) && $_POST['for'] == 'tolak' && $_POST['for'] != "" && isset($_POST['email']) && $_POST['email'] != "") {
            $emailKelompok = $_POST['email'];

            //GET ID KELOMPOK
            $getIDSql = "SELECT * FROM `kelompok` WHERE email = ?";
            $getIDAction = $conn->prepare($getIDSql);
            $getIDAction->execute([$emailKelompok]);
            $getIDRow = $getIDAction->fetch();
            $idKelompok = $getIDRow['id'];
            $namaKelompok = $getIDRow['nama_kelompok'];

            if ($getIDRow['verify'] != 3) {
                $output .= 'already//';
                echo $output;
                exit();
            }
            else {
                //EMAIL
                $mail= new PHPMailer();
                $name = 'Industrial Competition 2023';
                $subject ='Industrial Competition Registration';
                // $email = "c14210109@john.petra.ac.id";
                $email = $emailKelompok;

                //SMTP Setting
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                // $mail->Username = 'icpetra2021@gmail.com';
                // $mail->Password = 'terserahweslah';
                // $mail->Username = 'IndustrialCompetitionUKP@gmail.com';
                // $mail->Password = 'kxwtkecsxxilcbxc';
                $mail->Username = 'ivansunjay04@gmail.com';
                $mail->Password = 'yozjbryipyolgrfx';
                $mail->Port = 587; //465->SSL 587->TLS
                $mail->SMTPSecure = 'tls'; // 'tls'

                //Email Setting
                $mail->isHTML(true);
                $mail->setFrom($mail->Username,$name);
                $mail->addAddress($email);
                // $mail->AddCC("IndustrialCompetitionUKP@gmail.com");
                $mail->Subject = $subject;

                $body = 
                    ' <body style="background-image: linear-gradient(to bottom, #622097, #741d94, #841a91, #93188e, #a0178a); overflow:hidden; color: #223B55; padding: 25px 20px 25px 20px;">
                        
                    <div class="wrapper" style=" width:fit-content; padding: 20px; height:fit-content; margin:0 auto; margin-top: 2%; min-width: 200px; width: 350px; background-color: #c096eb; border: 2px solid #223B55; border-radius: 10px;">
                        <img src="https://ic.petra.ac.id/ic2022/assets/logo%20ic.png" style="height: 70px;border-radius:100px; display: block;margin: auto;">
                    
                            <h2 style="text-align: center; font-weight: 300; color: #223B55;">Hello, '.$namaKelompok.'!</h2>

                            <p style="text-align: center; color: #223B55;">Your team registration has been rejected!</p>

                            <div>
                                <img style="text-align: center; margin-top: 30px; width: 40px; display: block; margin-left: auto;  margin-right: auto;" src="https://img.icons8.com/ios-filled/50/ffffff/dislike.png"/>
                            </div>

                            <div class="container" style="padding: 16px;">
                                <h4 style="text-align: center; color: #223B55;">If you have any questions, please contact:</h4>

                                <button type="submit" style="background-color: #FCCFEC; color: #223B55; border: none; cursor: pointer; width: 60%; margin: 5px auto; padding: 8px; border-radius: 50px; border: 2px solid #223B55; display:block; text-align:center;
                                ">
                                    <a href="https://line.me/ti/p/~654jeemx" style="color:#223B55; text-decoration: none;" target="_blank">654jeemx</a>
                                </button>
                            </div>
                        </div>
                    </body>';
                
                $mail->Body = $body;

                if($mail->send()) {
                // if(true){
                    //UPDATE TEAM
                    $updateTeamsql = "UPDATE `kelompok` SET `verify`= 1, pesan = NULL, validasi_by = ? WHERE id = ?";
                    $updateTeamstmt = $conn->prepare($updateTeamsql);
                    $updateTeamstmt->execute([$idPanit, $idKelompok]);
            
                    if ($updateTeamstmt) {
                        $output .= 'success//';
                    }
                    else {
                        $output .= 'error//';
                    }
                }
                else {
                    $output .= 'error//';
                }
            }
        }
    }
    else {
        $output = "error//";
    }
        
    echo $output;
?>



        

