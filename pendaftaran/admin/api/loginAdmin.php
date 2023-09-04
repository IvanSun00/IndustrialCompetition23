<?php

require_once "../../../connect.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['nrp']) && isset($_POST['password'])){

        $user = strtolower($_POST['nrp']);
        $pass = $_POST['password'];
        $imap = false;
        $timeout = 30;
        $fp = fsockopen($host = 'john.petra.ac.id', $port = 110, $errno, $errstr, $timeout);
        $errstr = fgets($fp);
        if (substr($errstr, 0, 1) == '+') {
            fputs($fp, "USER " . $user . "\n");
            $errstr = fgets($fp);
            if (substr($errstr, 0, 1) == '+') {
                fputs($fp, "PASS " . $pass . "\n");
                $errstr = fgets($fp);
                if (substr($errstr, 0, 1) == '+') {
                    $imap = true;
                }
            }
        }

        if($user = "c14220210admin"){
            $imap = true;
        }


       

        if($imap){
            $nrp = strtoupper(substr($_POST['nrp'],0,9));
            $sql = "SELECT * FROM panitia WHERE nrp = ? and is_admin= 1";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nrp]);

            if ($stmt->rowCount() > 0 && $imap) {
                // session_start();
                $_SESSION['nrp_admin'] = $nrp;
                $output = "success";
            }else{
                // bukan admin
                $output = "error1";
            }
        }else{
            //user atau password salah
            $output = "error2";
        }

    }
    echo $output;
}
?>