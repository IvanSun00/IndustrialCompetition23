<?php
include '../connect.php';
$error_mess = false;

$query = $conn->prepare('SELECT * FROM game_kelompok');
$query->execute();

$listKelompok = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Poin</title>
    <!-- fav icon -->
    <link rel="icon" type="image/png" href="../../assets/logo%20ic.png">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Datatables -->
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="container p-1 mt-3">
        <div>
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Nomer</th>
                        <th>Nama</th>
                        <th>Poin Before</th>
                        <th>Poin_aft_convert</th>
                    </tr>
                </thead>
                <?php $counter = 0; ?>
                <tbody>
                    <?php foreach ($listKelompok as $value) { ?>
                        <?php
                        $konv_Ferumi = $value['qty_Ferumi'] * 100;
                        $konv_Lateks = $value['qty_Lateks'] * 60;
                        $konv_Timbal = $value['qty_Timbal'] * 60;
                        $konv_Cuprite = $value['qty_Cuprite'] * 50;
                        $konv_Karbon = $value['qty_Karbon'] * 150;
                        $konv_Uvarovite = $value['qty_Uvarovite'] * 50;
                        $konv_Titanium = $value['qty_Titanium'] * 150;
                        $konv_Sylvite = $value['qty_Sylvite'] * 70;
                        $konv_Silikon = $value['qty_Silikon'] * 70;
                        $konv_Copper = $value['qty_Copper'] * 100;
                        $konv_Nitrogen = $value['qty_Nitrogen'] * 60;
                        $konv_Poliisoprena = $value['qty_Poliisoprena'] * 60;
                        $konv_Fluorit = $value['qty_Fluorit'] * 50;
                        $konv_Hematit = $value['qty_Hematit'] * 50;
                        $counter = $counter + 1;
                        ?>
                        <tr>
                            <td><?= $counter ?></td>
                            <td><?= $value['nama'] ?></td>
                            <td><?= $value['poin'] ?></td>
                            <td><?= $value['poin'] + $konv_Ferumi + $konv_Lateks + $konv_Timbal + $konv_Cuprite + 
                            $konv_Karbon + $konv_Uvarovite + $konv_Titanium + $konv_Sylvite + $konv_Silikon + 
                            $konv_Copper + $konv_Nitrogen + $konv_Poliisoprena + $konv_Fluorit + $konv_Hematit?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        new DataTable('#example',{
            paging:false,
            order:[[2,'desc']]
        });
    </script>

</body>

</html>