<?php
// Login Page
    require_once "../../connect.php";
    if(isset($_SESSION['nrp_admin']) && $_SESSION['nrp_admin'] != ""){
        header("Location: home.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--ICON -->
    <link rel="icon" type="image/png" href="assets/img/logo%20ic.png">
    
    <!-- LINK -->
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="assets/style/style.css">
    <title>Admin IC 2023</title>
</head>
<body>
<div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <div class="sign-in-form" style="display: flex; align-items: center; justify-content: center; flex-direction: column; padding: 0rem 5rem; transition: all 0.2s 0.7s; overflow: hidden; grid-column: 1 / 2; grid-row: 1 / 2;">
          <h2 class="title">LOGIN</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input id="nrp" type="text" placeholder="NRP" />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" placeholder="Password" />
          </div>
          <div class="capt" style="margin-bottom: 0.2rem; margin-top: 1.2rem;">
            <div id="recaptcha" class="g-recaptcha" data-sitekey="6LfOy-gnAAAAAO3tBSuIAH8vhgRhCYyepZ6d971V"></div>
          </div>
          <input type="submit" value="Login" id="btn-login" class="btn solid" />
        </div>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h1>Industrial Competition 2023</h1>
          <h3>
            Admin Page
          </h3>
        </div>
        <img src="assets/img/logo%20ic.png" class="image" alt="" />
      </div>
    </div>
  </div>

<!--Script -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<!-- swal -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
 $(document).ready(function() {
      function scaleCaptcha(elementWidth) {
        // Width of the reCAPTCHA element, in pixels
        var reCaptchaWidth = 398;
        // Get the containing element's width
        var containerWidth = $('.sign-in-form').width();
        // Only scale the reCAPTCHA if it won't fit
        // inside the container
        if(reCaptchaWidth > containerWidth) {
          // Calculate the scale
          var captchaScale = containerWidth / reCaptchaWidth;
          captchaScale = captchaScale - (0.5 * captchaScale);
          // Apply the transformation
          $('.g-recaptcha').css({
            'transform':'scale('+captchaScale+')'
          });
        }
      }

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
      })
               
      $(document).on('click', '#btn-login', function() {
        $('#btn-login').prop('disabled', true);
        var nrp = $("#nrp").val();
        var password = $("#password").val();
        var rrf = grecaptcha.getResponse();

        if (nrp != "" && password != "" && rrf != "") {
        // if (nrp != "" && password != "" ) {
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
                document.location.href = "home.php";       
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
