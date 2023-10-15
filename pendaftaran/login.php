<?php
include '../connect.php';
$error_mess = false;

if ( isset($_POST["login"]) ) {

    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $stmt = $conn->prepare('SELECT * FROM kelompok where nama_kelompok=?');
    $stmt->execute([$username]);
    if($stmt->rowCount() == 1){
        $data = $stmt->fetch();
        if(password_verify($pass, $data['password'])){
            $msg = 'success';
            $_SESSION['nama_kelompok'] = $username;
            header("Location: editregist.php");
        }else{
            $msg =  'wrong';
            $error_mess = true;
        }
    }else{
        $msg = 'register';
        $error_mess = true;
    }
    echo $msg;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industrial Competition 2023</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&display=swap" rel="stylesheet">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="keywords" content="ic, ic 2023, industrial competition, industrial, competition, industrial competition 2023, teknik industri, petra, ukp, petranesian, uk petra">
    <meta name="description" content="Industrial Competition (IC) merupakan salah satu acara tahunan yang dilaksanakan untuk memfasilitasi siswa-siswi SMA yang memiliki keinginan untuk mengetahui lebih lanjut lagi mengenai program studi teknik industri yang ada di Universitas Kristen Petra.">
    <meta name="author" content="Universitas Kristen Petra">

    <!-- Bootstrap5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,400;1,600&display=swap" rel="stylesheet">
    
    <!--FAVICON -->
    <link rel="icon" type="image/png" href="../assets/logo%20ic.png">

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <!-- SWEET ALERT -->
    <!-- <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">   -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>


    <div class="container container-login mb-3" style="width: 50%;">

        <?php if ($error_mess == true) { ?>
            <div class="error-mess alert alert-danger" role="alert">
                nama kelompok atau password salah!
            </div>
        <?php } ?>

        <form action="" method="post">
            <div class="container-form">
                <div class="mt-3">
                    <label class="labells form-label" for="username">Nama kelompok</label>
                    <input class="form-control" type="text"  name="username" id="username">
                </div>
                <div class="mt-3">
                    <label class="labells form-label" for="pass" >Password</label>
                    <input class="form-control" type="password"  name="pass" id="pass">
                </div>
            </div>

            <button  class="btn btn-primary" type="submit" name="login">Login</button>
            <!-- ubah ke landing -->
            <a class="btn btn-secondary" href="index.php" role="button">Back</a>
        </form>
    </div>

    <style>
        body {
            background-image: url('../assets/Artboard_6.png');
        }

        .container-login {
            margin-top: 9em;
        }

        .btn{
            align-items: center;
            margin-top: 20px;
        }

        #back {
            margin-left: 8px;
        }

        .labells {
            color: white;
        }


    </style>

</body>

</html>