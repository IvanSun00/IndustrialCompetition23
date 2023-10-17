<?php 
// require_once '../connect.php';
// $_SESSION['nama_kelompok'] = "iniAdmin";

?>
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
            header("Location: craft.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="stylesheet" href="style.css">
    
    <!-- fav icon -->
    <link rel="icon" type="image/png" href="../assets/logo%20ic.png">
</head>
<body>

    <section>

    <div class="login-box"> 
        <form action="" method="post">
            <h2>Login Peserta</h2>
            <div class="input-box">
                <span class = "icon"> <ion-icon name="person-circle"></ion-icon>
                </ion-icon></span>
                <input type="text" placeholder="NamaKelompok" name="username" 
                required>
            </div>

            <div class="input-box">
                <span class = "icon"> <ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type= "password" placeholder="Password" name="pass"
                required>
            </div>

            <button type="submit" name="login"> <h3>Submit</h3> </button>

        </form>
    </div>
</section>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>