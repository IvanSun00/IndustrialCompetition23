<?php
include '../connect.php';
$error_mess = false;

if (isset($_POST["login"]) ) {

    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $stmt = $conn->prepare('SELECT * FROM kelompok where nama_kelompok=?');
    $stmt->execute([$username]);
    if($stmt->rowCount() == 1){
        $data = $stmt->fetch();
        if(password_verify($pass, $data['password'])){
            $stmt = $conn->prepare('SELECT * FROM game_kelompok where nama=?');
            $stmt->execute([$username]);
            if($stmt->rowCount() == 1){
                $msg = 'success';
                $_SESSION['nama_kelompok'] = $username;
                header("Location: craft.php");
            }else{
                $msg = 'Anda belum bisa bermain di game ini!';
                $error_mess = true;
            }
        }else{
            $msg =  'Nama kelompok atau password salah!';
            $error_mess = true;
        }
    }else{
        $msg = 'Nama kelompok atau password salah!';
        $error_mess = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/login.css">
    <title>Industrial Competition 2023</title>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&display=swap" rel="stylesheet"> -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="keywords" content="ic, ic 2023, industrial competition, industrial, competition, industrial competition 2023, teknik industri, petra, ukp, petranesian, uk petra">
    <meta name="description" content="Industrial Competition (IC) merupakan salah satu acara tahunan yang dilaksanakan untuk memfasilitasi siswa-siswi SMA yang memiliki keinginan untuk mengetahui lebih lanjut lagi mengenai program studi teknik industri yang ada di Universitas Kristen Petra.">
    <meta name="author" content="Universitas Kristen Petra">

    <!-- Bootstrap5 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

    <!--FAVICON -->
    <link rel="icon" type="image/png" href="../assets/logo%20ic.png">

    <!-- Icon -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"> -->
    
    <!-- SWEET ALERT -->
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
</head>

<body>
    <section class="wrapper">
        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
    </section>
    
    <?php if ($error_mess == true) { ?>
            <script>
            Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Oops...',
            text: '<?= $msg ?>',
            });
            </script>
    <?php } ?>

    <div class="tengah-layar">
    </div>

    <div class="box">
        <div class="form">
            <h2>Game Day1</h2>
            <form action="" method="post">
                <div class="inputBox">
                    <input type="text" required="required" name="username" id="username" class="input">
                    <span>Username</span>
                    <i></i>
                </div>

                <div class="inputBox">
                    <input type="password" required="required" name="pass" id="pass" class="input">
                    <span>Password</span>
                    <i></i>
                </div>
                <input id="btn" type="submit" name="login" class="submit" value="Login">
            </form>
        </div>
    </div>


    
</body>

</html>