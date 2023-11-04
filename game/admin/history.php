<?php
require_once("api/receive.php"); 
if(!isset($_SESSION['nrp_admin']) || $_SESSION['nrp_admin'] == ""){
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <!-- fav icon -->
    <link rel="icon" type="image/png" href="../../assets/logo%20ic.png">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" rel="stylesheet"
        integrity="sha384-PRrgQVJ8NNHGieOA1grGdCTIt4h21CzJs6SnWH4YMQ6G5F5+IEzOHz67L4SQaF0o" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Ion Icon -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js">
    </script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js">
    </script>

    <!-- Css Bootstrap Select -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <!-- My CSS -->
    <link rel="stylesheet" href="asset/style_history.css">
    <title>History</title>
    

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand col-2" href="#">
                <img src="asset/img/logo_petra.jpg" alt="" width="55" height="55">
                <span style="padding-left: 10px;">Input Website</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="row w-100">
                    <div class="col-9 d-flex justify-content-left">
                        <ul class="navbar-nav">

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="input_material.php">Input</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="history.php">History</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#">Home</a>
                            </li> -->

                        </ul>
                    </div>
                    <div class="col-3 d-flex justify-content-center">
                        <a class="navbar-brand" href="api/logout.php"> Log Out
                            <ion-icon name="exit-outline" id="exit"></ion-icon>
                        </a>
                        <!-- <ul class="navbar-nav">
                            <li class="nav-item">
                                log out
                            </li>
                        </ul> -->
                    </div>
                </div>


            </div>
        </div>
    </nav>
    <br> <br>

    <label for="kelompok1" class="keterangan full-container" style="text-align: center;"> NAMA KELOMPOK : </label>
    <div class="full-container">
        <select class="selectpicker" id="kelompok1" data-live-search="true">
            <option value="-akdfuerhhdaer">
                <?php echo "Show All"; ?>
            </option>
        <?php if (is_array($dataKelompok)) {
            foreach ($dataKelompok as $kelompok) { ?>

                <option value="<?php echo $kelompok["id"]; ?>">
                    <?php echo $kelompok["nama"]; ?>
                </option>
            <?php }
        } ?>
        </select>
    </div>



    <div class="container" id="container" style="height: 100%; padding: 10px 5px;">
        <table id="kelompok1Table" class="cell-border-black pt-3" style="width:100%">
            <thead style="justify-content: center; text-align: center;">
                <tr>
                <th scope="col" style="display: none;">#</th>
                <th scope="col">Nama kelompok</th>
                <th scope="col">Post</th>
                <th scope="col">Status</th>
                <th scope="col">Time</th>

                </tr>
            </thead>
            <tbody>
            <?php
                if (is_array($fetchData)) {
                    $i = 1;
                    foreach ($fetchData as $data) {

                        ?>
                        <tr>
                            <td style="display: none;">
                                <?php echo $data['id_kelompok'] ?>
                            </td>
                            <td>
                                <?php echo $data['namaKelompok'] ?>
                            </td>
                            <td>
                                <?php echo $data['namaPost'] ?>
                            </td>
                            <td>
                                <?php echo $data['status'] ?>
                            </td>
                            <td>
                                <?php echo $data['timestamp'] ?>
                            </td>
                        </tr>
                    <?php }
                } ?>

            </tbody>
            
        </table>

    </div>

    


    

    <!-- Tambahkan link ke jQuery (diperlukan oleh Bootstrap dan Bootstrap-select) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Tambahkan link ke Bootstrap JS (diperlukan oleh Bootstrap-select) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.min.js"></script>
    <!-- Tambahkan link ke Bootstrap-select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
    <!-- datatable -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <script>$(document).ready(function() {
        $('#example').DataTable();
    } );
    </script>    

    <!-- Data Tables -->
    <script>
        $(document).ready(function () {
            $('#kelompok1Table').DataTable({
                "paging": false, // Disable pagination
                "scrollY": "250px", // Enable vertical scrolling
                "scrollX": true, // Enable horizontal scrolling
                "autoWidth": false, // Disable automatic column width calculation
                "lengthChange": false, // Hide the length change control
                "searching": false, // Disable searching
                "order": [],
            });
        });


    </script>
    <!-- Search  -->
    <script>
        const dropDown1 = document.getElementById('kelompok1');
        const table1 = document.getElementById('kelompok1Table').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        dropDown1.addEventListener('change', function () {
            const selectedValue = this.value.trim().toLowerCase(); // Trim and convert to lowercase
            for (let i = 0; i < table1.length; i++) {
                const kelompok1Cell = table1[i].getElementsByTagName('td')[0];
                const cellContent = kelompok1Cell.textContent.trim().toLowerCase(); // Trim and convert to lowercase
                if (cellContent === selectedValue) {
                    table1[i].style.display = '';
                } else {
                    table1[i].style.display = 'none';
                }

                if(selectedValue == "-akdfuerhhdaer"){
                    table1[i].style.display = '';
                }
            }
        });
    </script>

</body>

</html>