<?php
include '../../../connect.php';
$error_mess = false;

$query = $conn->prepare('SELECT * FROM day2_kelompok');
$query->execute();

$listKelompok = $query->fetchAll();
$_SESSION['alert'] = "netral";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" rel="stylesheet" integrity="sha384-PRrgQVJ8NNHGieOA1grGdCTIt4h21CzJs6SnWH4YMQ6G5F5+IEzOHz67L4SQaF0o" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js">
    </script>

    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js">
    </script>

    <title>Document</title>
</head>

<body>

    <!-- HEADER -->
    <section>
        <div class="p-3 container justify-content-start text-end">
            <div>
                <a type="button" class="btn btn-light" href="../super_admin/index.php">Back to Superadmin</a>
            </div>
        </div>
    </section>



    <div class="container">
        <?php
        if (isset($_POST["ckel"])) {
            $_SESSION['namekel_day2'] = $_POST["select_kelompok"];
        }
        ?>

        <div>
            <?php if (isset($_SESSION['namekel_day2'])) {
                $kd2 = $_SESSION['namekel_day2'];
                $qbalance = $conn->prepare("SELECT uang FROM day2_kelompok where nama='$kd2'");
                $qbalance->execute();
                $balancenow = $qbalance->fetch();


                echo '<h3> Login di Kelompok ' . $_SESSION['namekel_day2'] . '</h3>';
                echo "<h3> Balance now : " . $balancenow['uang'] . "</h3>";
            }
            ?>
        </div>
    </div>
    <!--Pilih Kelompok-->
    <section>
        <div class="p-3 container justify-content-start text-end mt-4">
            <div>
                <div>
                    <h5><label>Kelompok:</label></h5>
                </div>
                <form method="post">
                    <div>
                        <select class="form-select form-select-lg mb-3" name="select_kelompok" id="select_kelompok" aria-label=".form-select-lg example">
                            <option selected>Pilih Kelompok</option>
                            <?php foreach ($listKelompok as $value) { ?>
                                <option value="<?= $value['nama'] ?>"><?= $value['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <button type="submit" value="submit" class="btn btn-primary" name="ckel" id="ckel">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </section>



    <!-- Input Balance -->
    <section>
        <div class="p-3 container justify-content-start text-end mt-1">
            <?php 
            if ($_SESSION['alert'] = "berhasil") {
                echo '<div class="alert alert-success" role="alert">
                        Input uang berhasil
                    </div>';
            }elseif($_SESSION['alert'] = "netral"){
                echo '';
            }
            ?>

            <div>
                <div>
                    <h5><label for="input-balance">Balance:</label></h5>
                </div>

                <form action="inputuang.php" method="post">
                    <div class="d-flex flex-row">
                        <input type="text" class="form-control" id="input-balance" name="input-balance" style="margin-right:20px">
                        <button type="submit" value="submit" class="btn btn-primary" name="submit-balance" id="submit-balance">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <!-- Input Sertifikasi -->
    <section>
        <div class="container p-3 justify-content-start text-end mt-3">
            <div>
                <h5><label>Sertifikasi:</label></h5>
            </div>
            <br>

            <form method="post">
                <div class="col-md-6">
                    <p>Display text here</p>
                    <div class="">
                        <button type="button" class="btn btn-outline-primary" name="acc" id="acc">Sertifikasi</button>
                        <button type="button" class="btn btn-outline-danger" name="undo" id="undo">Batalkan sertifikasi</button>
                    </div>
                </div>
            </form>
        </div>
    </section>


</body>

</html>