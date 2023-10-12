<?php
include '../../connect.php';
if(isset($_SESSION['nrp_admin']) && $_SESSION['nrp_admin'] != ""){
    header("Location: input_material.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <link rel="stylesheet" href="style.css">
    <!-- swal cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

    <section>

    <div class="login-box"> 
        <form  method="post">
            <h2>Login Admin Game</h2>
            <div class="input-box">
                <span class = "icon"> <ion-icon name="person-circle"></ion-icon>
                </ion-icon></span>
                <input type="text" id="nrp" placeholder="NRP" name="nrp" 
                required>
            </div>

            <div class="input-box">
                <span class = "icon"> <ion-icon name="lock-closed"></ion-icon>
                </span>
                <input type= "password" placeholder="Password" name="pass" id="password"
                required>
            </div>

            <button id="btn-login" > <h3>Submit</h3> </button>

        </form>
    </div>
</section>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script>
    $(document).ready(function() {
         // Swall toaster
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });
        $(document).on('click', '#btn-login', function() {
        $('#btn-login').prop('disabled', true);
        var nrp = $("#nrp").val();
        var password = $("#password").val();

        if (nrp != "" && password != "") {
          $.ajax({
            url: "api/loginAdmin.php",
            method: "POST",
            data: {
              nrp: nrp,
              password: password
            },
            success: function(data) {
              console.log(data)
              if (data == 'success') {
                document.location.href = "input_material.php";       
              }
              else if (data == 'error1') {
                Toast.fire({
                  icon: 'error',
                  title: 'Anda Bukan Admin, Login Gagal'
                })
              }
              else {
                Toast.fire({
                  icon: 'error',
                  title: 'NRP/ Password Salah, Login Gagal'
                })
              }
              $('#btn-login').prop('disabled', false);
            },
            error: function() {
              Toast.fire({
                icon: 'error',
                title: 'Login Gagal'
              })
              $('#btn-login').prop('disabled', false);
            }
          });
        }
        else {
          Toast.fire({
            icon: 'warning',
            title: 'Data Belum Lengkap'
          })
          $('#btn-login').prop('disabled', false);
        }
      });
    });
    </script>
</body>
</html>