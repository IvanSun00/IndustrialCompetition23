<?php
require_once "../../../connect.php";
if(isset($_SESSION['nrp_admin']) && $_SESSION['nrp_admin'] != ""){
    header("Location: ../index.php");
    exit();
}
require "nextDay.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.5.2/sweetalert2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.5.2/sweetalert2.all.min.js"></script>

    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        body {
            display: flex;
            justify-content: center;
            text-align: center;
        }

        .next-btn {
            font-size: 5vh;
        }

        #day {
            font-size: 40vh;
        }

        @media screen and (max-width: 768px) {
            #day {
                font-size: 30vh;
            }

        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <?php
        if (!empty($success))
            echo $success;

        if (!empty($gagal))
            echo $gagal;
        ?>
        <h2 style="margin-top: 3vh; font-size:15vh;">DAY</h2>

        <?php
        $sql = "SELECT day FROM `day2_day` WHERE id=1";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $day = $row['day'];
        echo "<h1 id='day'>$day</h1>";
        ?>
        <button type="submit" class="btn btn-primary next-btn" name="nextDay" id="submit">Next Day</button>
    </div>

    <script>
        $(document).ready(function() {
            $(".next-btn").click(function(e) {
                e.preventDefault();

                Swal.fire({
                    icon: 'warning',
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin melanjutkan ke hari berikutnya?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "nextDay.php?change=true";
                    }
                });
            });

        });
    </script>
</body>

</html>