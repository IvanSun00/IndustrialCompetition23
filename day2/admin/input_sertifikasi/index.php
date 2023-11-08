<?php
include '../../../connect.php';
if(!isset($_SESSION['nrp_admin']) || $_SESSION['nrp_admin'] == ""){
    header("Location: ../index.php");
    exit();
}
$error_mess = false;

$query = $conn->prepare('SELECT * FROM day2_kelompok');
$query->execute();

$listKelompok = $query->fetchAll();

//late
if(isset($_SESSION['namekel_day2'])){
    $bid;
    $fixed;

    // data kelompok dan bid
    $sql = "SELECT w.*,k.nama FROM day2_win w JOIN
    day2_kelompok k on w.id_kelompok = k.id
    where k.nama = ? and late is not null;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION['namekel_day2']]);

    while($data = $stmt->fetch()){
        // jika bid
        if($data['type']==0){
            $stmt2 = $conn->prepare("SELECT * FROM `day2_bid` b JOIN day2_kelompok_bid kb on b.id = kb.id_bid WHERE no = ? AND id_kelompok = ?;");
            $stmt2->execute([$data['no_bid'], $data['id_kelompok']]);
            $databid = $stmt2->fetch();
            $databid['data'] = $data;
            $bid[] = $databid;

        }
        // jika fixed
        else if($data['type']==1){
            $stmt2 = $conn->prepare("SELECT * FROM day2_fixed where no = ?");
            $stmt2->execute([$data['no_bid']]);
            $datafixed = $stmt2->fetch();
            $datafixed['data'] = $data;
            $fixed[] = $datafixed;
        }
    }
}
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

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js">
    </script>

    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js">
    </script>
    <!-- FavIcon -->
    <link rel="icon" href="../../../assets/logo ic.png" type="image/png">

    <title>Admin Page Day2</title>
    <style>
        table input[type="checkbox"] {
            width: 15px;
            height: 15px;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <!-- <section>
        <div class="p-3 container justify-content-start text-end">
            <div>
                <a type="button" class="btn btn-outline-secondary" href="../super_admin/index.php">Back to Superadmin</a>
                
            </div>
        </div>
    </section> -->
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container-fluid">
            <a class="navbar-brand m-0" href="#">
                <img src="../../../assets/Logo Putih.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
                <span class="">Admin Page</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse me-5" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 p-0 ">
            <li class="nav-item">
                    <a class="nav-link" href="../super_admin/">Super Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active " href="../input_sertifikasi/">Input Sertifikasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../delivery.php">Delivery</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="../news.php">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../DealAdmin/">Deal</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link " href="../demand.php">DemandTable</a>
                    </li>
                <li class="nav-item">
                        <a class="nav-link " href="../rank.php">Rank</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger " href="../api/logout.php">Logout</a>
                </li>
            </ul>
            </div>
        </div>

    </nav>


    <div class="container">
        <div>
            <?php
            if (!isset($_SESSION['namekel_day2']) && !isset($_SESSION['balance_now'])) {
                echo '<h3>Login di kelompok none</h3>';
            } elseif (isset($_SESSION['namekel_day2']) && isset($_SESSION['balance_now'])) {
                if ($_SESSION['namekel_day2'] != 'Pilih Kelompok') {

                    $kd2 = $_SESSION['namekel_day2'];
                    $qbalance = $conn->prepare("SELECT uang FROM day2_kelompok where nama='$kd2'");
                    $qbalance->execute();
                    $balancenow = $qbalance->fetch();
                    $_SESSION['balance_now'] = $balancenow['uang'];
                }
                echo '<h3> Login di Kelompok ' . $_SESSION['namekel_day2'] . '</h3>';
                echo "<h3> Balance now : " . $_SESSION['balance_now'] . "</h3>";
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
                <form action="setkelompok.php" method="post">
                    <div>
                        <select class="form-select form-select-lg mb-3" name="select_kelompok" id="select_kelompok" aria-label=".form-select-lg example">
                            <option selected>Pilih Kelompok</option>
                            <?php foreach ($listKelompok as $value) { 
                                if($value["id"]==-1){
                                    continue;
                                }
                                ?>
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

            <div>
                <?php
                if (isset($_SESSION['alert'])) {
                    if ($_SESSION['alert'] = "berhasil") {
                        unset($_SESSION['alert']);
                        echo '<div class="alert alert-success" role="alert">
                            Input uang berhasil
                        </div>';
                    } else if ($_SESSION['alert'] = "gagal") {
                        unset($_SESSION['alert']);
                        echo '<div class="alert alert-danger" role="alert">
                            Input uang gagal
                        </div>';
                    }
                }

                ?>
                <h5><label for="input-balance">Balance:</label></h5>
            </div>

            <form action="inputuang.php" method="post">
                <div>
                    <input type="number" step=any class="form-control" id="input-balance" name="input-balance">
                    <button type="submit" value="submit" class="btn btn-primary mt-3" name="submit-balance" id="submit-balance">Submit</button>
                </div>
            </form>
            <?php if (isset($_SESSION['input_uang_success']) && $_SESSION['input_uang_success'] = "success") { ?> 
                <script>
                Swal.fire("Input uang berhasil");
                </script>
                <?php unset($_SESSION['input_uang_success']) ?>
            <?php } ?>
        </div>
    </section>


    <!-- Input Sertifikasi -->
    <section>
        <div class="container p-3 justify-content-start text-end mt-3">
            <div>
                <h5><label>Sertifikasi:</label></h5>
            </div>
            <br>

            <form action="sertifikasi.php" method="post">
                <div class="col-md-6">
                    <?php
                    if (isset($_SESSION['namekel_day2']) && $_SESSION['namekel_day2'] != 'Pilih Kelompok') {
                        $ks2 = $_SESSION['namekel_day2'];

                        $stmt_serti = $conn->prepare("SELECT sertifikasi FROM day2_kelompok WHERE nama='$ks2'");
                        $stmt_serti->execute();
                        $check_serti = $stmt_serti->fetch();
                        $_SESSION['quan_serti'] = $check_serti['sertifikasi'];

                        if (isset($_SESSION['quan_serti']) && $_SESSION['quan_serti'] == 1) {
                            echo '<div class="alert alert-primary" role="alert">
                        Kelompok telah tersertifikasi
                      </div>';
                        } elseif (isset($_SESSION['quan_serti']) && $_SESSION['quan_serti'] == 0) {
                            echo '<div class="alert alert-secondary" role="alert">
                        Kelompok BELUM tersertifikasi
                      </div>';
                        }
                    }
                    ?>
                    <div>
                        <button type="submit" value="submit" class="btn btn-outline-primary" name="acc" id="acc">Sertifikasi</button>
                        <button type="submit" value="submit" class="btn btn-outline-danger" name="undo" id="undo">Batalkan sertifikasi</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- informasi late -->
    <section>
        <div class="container p-3 justify-content-start text-end mt-3">
            <div>
                <h5><label>Informasi Late:</label></h5>
            </div>
            <br>

                <div class="">
                    
                    <!-- show -->
                    <div >
                        <?php
                        if(isset($bid)){
                            // bid
                            foreach($bid as $data1){
                                if($data1['data']['status']== 1){
                                echo "
                                <h3 class='text-center mt-4' >Bid Tabel</h3>
                                <table class='table table-bordered border-dark-subtle  shadow-lg  mt-2 ' style='font-size:small;' >
                                    <tr>
                                        <th class='table-success'>Pemenang</th>
                                        <td colspan='2' class='text-center'>".$data1['data']['nama']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Day Published</th>
                                        <td colspan='2' class='text-center'>".$data1['day']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Bid Number</th>
                                        <td colspan='2' class='text-center'>".$data1['no']."</td>
                                        
                            
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Client</th>
                                        <td class='text-center col-4'>".$data1['client']."</td>
                                        <td class='text-center col-4'>".$data1['kota']."</td>
                            
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Product</th>
                                        <td class='text-center'>".$data1['product']."</td>
                                        <td class='text-center'>".$data1['jumlah']."</td>
                            
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Late Penalty</th>
                                        <td colspan='2' class='text-center'>".$data1['late_penalty']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Result Day</th>
                                        <td colspan='2' class='text-center'>".$data1['result_day']."</td>
                            
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Need Day</th>
                                        <td colspan='2' class='text-center'>".$data1['need_day']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Harga</th>
                                        <td colspan='2' class='text-center'>".$data1['harga']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Archieve</th>

                                        <form action='lateInfo.php' method='post'>
                                        <input type='hidden' name='idBid' value='".$data1['data']['id']."'>
                                        <td colspan='2' class='text-center'> <button type='submit' value='archieve' class='btn btn-outline-secondary' name='kondisi'>Archieve</button> </td>
                                        </form>
                                    </tr>
                                </table>
                                <div class='alert alert-primary' role='alert'>Terlambat: ".
                                    $data1['data']['late'].
                                " hari</div>";
                                }
                            }
                        }

                        if(isset($fixed)){
                            // fixed
                            foreach($fixed as $data2){
                                if($data2['data']['status']== 1){
                                echo "
                                <h3 class='text-center mt-4'>Fixed Tabel</h3>
                                <table class='table table-bordered border-dark-subtle  shadow-lg  mt-2 ' style='font-size:small;' >
                                    <tr>
                                        <th class='table-danger'>Pemenang</th>
                                        <td colspan='2' class='text-center'>".$data2['data']['nama']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-danger'>Day Published</th>
                                        <td colspan='2' class='text-center'>".$data2['day']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-danger'>Bid Number</th>
                                        <td colspan='2' class='text-center'>".$data2['no']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-danger'>Client</th>
                                        <td class='text-center col-4'>".$data2['client']."</td>
                                        <td class='text-center col-4'>".$data2['kota']."</td>
                            
                                    </tr>
                                    <tr>
                                        <th class='table-danger'>Product</th>
                                        <td class='text-center'>".$data2['product']."</td>
                                        <td class='text-center'>".$data2['jumlah']."</td>
                            
                                    </tr>
                                    <tr>
                                        <th class='table-danger'>Late Penalty</th>
                                        <td colspan='2' class='text-center'>".$data2['late_penalty']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-danger'>Result Day</th>
                                        <td colspan='2' class='text-center'>".$data2['result_day']."</td>
                            
                                    </tr>
                                    <tr>
                                        <th class='table-danger'>Need Day</th>
                                        <td colspan='2' class='text-center'>".$data2['need_day']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-danger'>Harga</th>
                                        <td colspan='2' class='text-center'>".$data2['bid']."</td>
                                    </tr>   
                                    <tr>
                                        <th class='table-danger'>Archieve</th>
                                        <form action='lateInfo.php' method='post'>
                                        <input type='hidden' name='idBid' value='".$data2['data']['id']."'>
                                        <td colspan='2' class='text-center'> <button type='submit' value='kondisi' class='btn btn-outline-secondary' name='kondisi'>Archieve</button> </td>
                                        </form>
                                    </tr>
                                </table>
                                <div class='alert alert-primary' role='alert'>Terlambat: ".
                                    $data2['data']['late']." hari</div>";
                                }
                            }

                        }
                        ?>
                    </div>
                    <!-- archive -->
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Archive Late
                            </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                                <div class="accordion-body row row-cols-1 row-cols-md-2 row-cols-lg-3 gx-4 gy-3 ">
                                    <!-- <div class="col">
                                         <h3 class="text-center mt-4" >Delivery Fixed</h3>
                                        <table class="table table-sm table-bordered border-dark-subtle mt-2" style="font-size: small;">
                                            <tr>
                                                <th class="col-4 table-danger">Day Published</th>
                                                <td colspan="2" class="text-center col-8">${info.day}</td>
                                            </tr>
                                            <tr>
                                                <th class="table-danger">Bid Number</th>
                                                <td colspan="2" class="text-center">${info.no}</td>
                                                
                                    
                                            </tr>
                                            <tr>
                                                <th class="table-danger">Client</th>
                                                <td class="text-center col-4">${info.client}</td>
                                                <td class="text-center col-4">${info.kota}</td>
                                    
                                            </tr>
                                            <tr>
                                                <th class="table-danger">Product</th>
                                                <td class="text-center">${info.product}</td>
                                                <td class="text-center">${info.jumlah}</td>
                                    
                                            </tr>
                                            <tr>
                                                <th class="table-danger">Each</th>
                                                <td colspan="2" class="text-center">${info.bid}</td>
                                            </tr>
                                            <tr>
                                                <th class="table-danger">Late Penalty</th>
                                                <td colspan="2" class="text-center">${info.late_penalty}</td>
                                            </tr>
                                            <tr>
                                                <th class="table-danger">Result Day</th>
                                                <td colspan="2" class="text-center">${info.result_day}</td>
                                    
                                            </tr>
                                            <tr>
                                                <th class="table-danger">Need Day</th>
                                                <td colspan="2" class="text-center">${info.need_day}</td>
                                            </tr>
                                            <tr>
                                                <th class="table-danger">Harga</th>
                                                <td colspan="2" class="text-center">${info.need_day}</td>
                                            </tr>
                                            <tr>
                                                <th class="table-danger">Archieve</th>
                                                <td colspan="2" class="text-center"><input type="checkbox" name="check" id="" width="100%" checked></td>
                                            </tr>
                                            
                                        </table>
                                        <div class="alert alert-primary" role="alert">
                                            ${res.msg}
                                        </div>
                                     
                                    </div> -->

                                    <?php
                        if(isset($bid)){
                            // bid
                            foreach($bid as $data1){
                                if($data1['data']['status']== 0){
                                echo "
                                <div class='col'>
                                <h3 class='text-center mt-4' >Bid Tabel</h3>
                                <table class='table table-bordered border-dark-subtle  shadow-lg  mt-2 ' style='font-size:small;' >
                                    <tr>
                                        <th class='table-success'>Pemenang</th>
                                        <td colspan='2' class='text-center'>".$data1['data']['nama']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Day Published</th>
                                        <td colspan='2' class='text-center'>".$data1['day']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Bid Number</th>
                                        <td colspan='2' class='text-center'>".$data1['no']."</td>
                                        
                            
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Client</th>
                                        <td class='text-center col-4'>".$data1['client']."</td>
                                        <td class='text-center col-4'>".$data1['kota']."</td>
                            
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Product</th>
                                        <td class='text-center'>".$data1['product']."</td>
                                        <td class='text-center'>".$data1['jumlah']."</td>
                            
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Late Penalty</th>
                                        <td colspan='2' class='text-center'>".$data1['late_penalty']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Result Day</th>
                                        <td colspan='2' class='text-center'>".$data1['result_day']."</td>
                            
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Need Day</th>
                                        <td colspan='2' class='text-center'>".$data1['need_day']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Harga</th>
                                        <td colspan='2' class='text-center'>".$data1['harga']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-success'>Archieve</th>
                                        <input type='hidden' name='idBid' value='".$data1['data']['id']."'>
                                    </tr>
                                </table>

                                <div class='alert alert-primary' role='alert'>Terlambat: ".
                                    $data1['data']['late'].
                                " hari</div>
                                </div>";
                                }
                            }
                        }


                        if(isset($fixed)){
                            // fixed
                            foreach($fixed as $data2){
                                if($data2['data']['status']== 0){
                                echo "
                                <div class='col'>
                                <h3 class='text-center mt-4'>Fixed Tabel</h3>
                                <table class='table table-bordered border-dark-subtle  shadow-lg  mt-2 ' style='font-size:small;' >
                                    <tr>
                                        <th class='table-danger'>Pemenang</th>
                                        <td colspan='2' class='text-center'>".$data2['data']['nama']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-danger'>Day Published</th>
                                        <td colspan='2' class='text-center'>".$data2['day']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-danger'>Bid Number</th>
                                        <td colspan='2' class='text-center'>".$data2['no']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-danger'>Client</th>
                                        <td class='text-center col-4'>".$data2['client']."</td>
                                        <td class='text-center col-4'>".$data2['kota']."</td>
                            
                                    </tr>
                                    <tr>
                                        <th class='table-danger'>Product</th>
                                        <td class='text-center'>".$data2['product']."</td>
                                        <td class='text-center'>".$data2['jumlah']."</td>
                            
                                    </tr>
                                    <tr>
                                        <th class='table-danger'>Late Penalty</th>
                                        <td colspan='2' class='text-center'>".$data2['late_penalty']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-danger'>Result Day</th>
                                        <td colspan='2' class='text-center'>".$data2['result_day']."</td>
                            
                                    </tr>
                                    <tr>
                                        <th class='table-danger'>Need Day</th>
                                        <td colspan='2' class='text-center'>".$data2['need_day']."</td>
                                    </tr>
                                    <tr>
                                        <th class='table-danger'>Harga</th>
                                        <td colspan='2' class='text-center'>".$data2['bid']."</td>
                                    </tr>   
                                    <tr>
                                        <th class='table-danger'>Archieve</th>
                                            <td colspan='2' class='text-center'> 
                                                <input type='hidden' name='idBid' value='".$data2['data']['id']."'>
                                            </td>

                                    </tr>
                                </table>

                                <div class='alert alert-primary' role='alert'>Terlambat: ".
                                    $data2['data']['late']." hari</div>
                                    </div>";
                                }
                            }
                        }
                        ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>


</body>

</html>