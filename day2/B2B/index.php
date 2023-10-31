<?php
    require("receive.php");
// if (!isset($_SESSION['nama_kelompok']) || $_SESSION['nama_kelompok'] == "") {
    $_SESSION['nama_kelompok'] = 'dummy';
//     header('Location: login.php');
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Black+Ops+One&family=Handjet:wght@100;200;300;400;500;600;700;800;900&family=League+Spartan:wght@800&family=Press+Start+2P&family=Staatliches&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">

    <!-- font-family: 'DM Serif Display', serif;
    font-family: 'PT Serif', serif;
    font-family: 'Playfair Display', serif; -->
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        .spacer {
            aspect-ratio: 960/300;
            width: 100%;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        .layer1 {
            background-image: url('./layer1.svg');
        }

        .layer2 {
            /* margin-top: 200px; */
            background-image: url('./layer2.svg');
        }

        .flip {
            transform: rotate(180deg);
        }

        i {
            animation: colorChanges 3s linear 0s infinite;
        }

        h1 {
            color: rgb(37, 2, 80);
            background: rgb(238, 174, 202);

            background: linear-gradient(90deg, rgba(239, 142, 184, 0.45) 12%, rgba(148, 187, 233, 0.77) 50%, rgba(39, 47, 57, 0.392) 100%);
            /* font-family: 'Black Ops One', 'cursive'; */
            font-family: 'PT Serif', serif;
            font-weight: bolder;


            text-shadow: 2px 2px 10px rgba(169, 60, 60, 0.5), -5px -7px 30px rgb(227, 243, 189, 0.55);
            border-bottom: 15px solid;
            border-top: 15px solid;
            border-image: url("https://mdn.github.io/css-examples/tools/border-image-generator/border-image-1.png") 20% round;
            border-image-outset: 20px;
            animation: glowing 2s infinite;

        }

        @keyframes glowing {
            0% {
                text-shadow: 0 0 5px rgba(255, 255, 255, 0.8);
            }

            50% {
                text-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
            }

            100% {
                text-shadow: 0 0 5px rgba(255, 255, 255, 0.8);
            }
        }


        .card-body {
            border-radius: 520px !important;
            box-shadow: -3px 4px 20px rgb(4, 2, 8);
        }

        .bg-planet {
            background-image: url("https://images.unsplash.com/photo-1462240006665-9529b3a399b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1927&q=80");
            background-attachment: fixed;
            background-size: cover;
            background-blend-mode: luminosity;

        }

        .card,
        .card-footer {
            background-color: rgba(1, 1, 46, 0.348);
        }

        tr,
        td,
        th {
            /* font-family: 'League Spartan', cursive; */
            font-family: 'DM Serif Display', serif;
            font-weight: bold;
            text-transform: uppercase;
            text-shadow: 2px 2px 10px rgb(227, 243, 189);
            box-shadow: -3px 4px 20px rgb(4, 2, 8);
            vertical-align: middle;
        }

        body {
            background-color: #202731;

        }

        @keyframes colorChanges {
            0% {
                color: rgb(251, 0, 0);
            }

            14% {
                color: rgb(185, 95, 5);
            }

            28% {
                color: rgb(242, 255, 0);
            }

            56% {
                color: rgb(0, 128, 0);
            }

            70% {
                color: rgb(0, 191, 255);
            }

            100% {
                color: rgb(205, 67, 255);
            }
        }
    </style>

</head>

<body>
    <div class="spacer layer1 mt-0 pt-0"></div>

    <section class="wrapper">
        <div class="stars"></div>
        <div class="stars2"></div>
        <div class="stars3"></div>
    </section>

    <h1 class="p-1 ps-2" id="bid">BID PRICE </h1>
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-sm-1">

            <!-- start of card -->
            <?php if (is_array($bids)) { ?>
                <?php $i = 1; ?>
                <?php foreach ($bids as $bid) { ?>
                    <div class="col">
                        <div class="card shadow-lg">
                            <div class="card-body bg-warning-subtle bg-planet">
                                <table class="table table-sm table-bordered border-dark-subtle shadow-lg m-0"
                                    style="font-size: small;">
                                    <tr>
                                        <th class="col-4 table-success">Day Published</th>
                                        <td colspan="2" class="text-center col-8">
                                            <?php echo $bid['day'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="table-success">Bid Number</th>
                                        <td colspan="2" class="text-center">
                                            <?php echo $bid['no'] ?>
                                        </td>
                                        <input type="hidden" value="<?php echo $bid['no'] ?>"
                                            id="bid_no<?= htmlspecialchars($i) ?>" name="bid_no<?= htmlspecialchars($i) ?>">

                                    </tr>
                                    <tr>
                                        <th class="table-success">Client</th>
                                        <td class="text-center col-4">
                                            <?php echo $bid['client'] ?>
                                        </td>
                                        <!-- <td class="text-center col-4"></td> -->

                                    </tr>
                                    <tr>
                                        <th class="table-success">Product</th>
                                        <td class="text-center">
                                            <?php echo $bid['product'] ?>
                                        </td>
                                        <!-- <td class="text-center"></td> -->

                                    </tr>
                                    <tr>
                                        <th class="table-success">Max Bid Price</th>
                                        <td colspan="2" class="text-center">
                                            <?php echo $bid['max_bid'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="table-success">Minimum Bidder</th>
                                        <td colspan="2" class="text-center">
                                            <?php echo $bid['minimum_bidders'] ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <th class="table-success">Late Penalty</th>
                                        <td colspan="2" class="text-center">
                                            <?php echo $bid['late_penalty'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="table-success">Bid Result Day</th>
                                        <td colspan="2" class="text-center">
                                            <?php echo $bid['result_day'] ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <th class="table-success">Need Day</th>
                                        <td colspan="2" class="text-center">
                                            <?php echo $bid['need_day'] ?>
                                        </td>
                                </table>
                            </div>
                            <div class="card-footer bg-planet">
                                <div class="input-group border-5" style="font-family: 'DM Serif Display', serif;">

                                    <input class="form-control form-control-sm" type="text" placeholder="Input harga"
                                        id="harga_bid<?= htmlspecialchars($i) ?>" name="harga_bid<?= htmlspecialchars($i) ?>">
                                    <button class="btn btn-sm btn-warning w-25" type="button"
                                        name="bid_button<?= htmlspecialchars($i) ?>" id="bid_button<?= htmlspecialchars($i) ?>"
                                        onclick="sendData(<?= htmlspecialchars($i) ?>)">BID</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of card -->
                    <?php $i++;
                } ?>
            <?php } ?>

        </div>
    </div>

    <h1 class="mt-5 p-1 ps-2" id="fixed">FIXED PRICE </h1>
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-sm-1 mb-5">

            <!-- start of card -->
            <?php if (is_array($fixes)) { ?>
                <?php $i = 1; ?>
                <?php foreach ($fixes as $fixed) { ?>
                    <div class="col">
                        <div class="card shadow-lg">
                            <div class="card-body bg-dark-subtle bg-planet">
                                <table class="table table-sm table-bordered border-dark-subtle" style="font-size: small;">
                                    <tr>
                                        <th class="col-4 table-danger">Day Published</th>
                                        <td colspan="2" class="text-center col-8">
                                            <?php echo $fixed['day'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="table-danger">Fixed Number</th>
                                        <input type="hidden" value="<?php echo $fixed['no'] ?>"
                                            id="fixed_no<?= htmlspecialchars($i) ?>" name="fixed_no<?= htmlspecialchars($i) ?>">
                                        <input type="hidden" value="<?php echo $fixed['id'] ?>"
                                            id="fixed_id<?= htmlspecialchars($i) ?>" name="fixed_id<?= htmlspecialchars($i) ?>">
                                        <td class="text-center">
                                            <?php echo $fixed['no'] ?>
                                        </td>
                                        <td class="d-flex align-items-center justify-content-center">
                                            <!-- <input type="checkbox" class="form-check"> -->
                                            <button class="btn btn-danger w-100 btn-sm"
                                                name="fix_button<?= htmlspecialchars($i) ?>"
                                                id="fix_button<?= htmlspecialchars($i) ?>"
                                                onclick="sendFixed(<?= htmlspecialchars($i) ?>)">BID</button>
                                        </td>

                                    </tr>
                                    <tr>
                                        <th class="table-danger">Client</th>
                                        <td class="text-center col-4">
                                            <?php echo $fixed['client'] ?>
                                        </td>
                                        <td class="text-center col-4"></td>

                                    </tr>
                                    <tr>
                                        <th class="table-danger">Product</th>
                                        <td class="text-center">
                                            <?php echo $fixed['product'] ?>
                                        </td>
                                        <td class="text-center"></td>

                                    </tr>
                                    <tr>
                                        <th class="table-danger">Each</th>
                                        <td colspan="2" class="text-center">
                                            <?php echo $fixed['bid'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="table-danger">Amount</th>
                                        <td colspan="2" class="text-center">
                                            <?php echo $fixed['jumlah'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="table-danger">Late Penalty</th>
                                        <td colspan="2" class="text-center">
                                            <?php echo $fixed['late_penalty'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="table-danger">Result Day</th>
                                        <td colspan="2" class="text-center">
                                            <?php echo $fixed['result_day'] ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <th class="table-danger">Need Day</th>
                                        <td colspan="2" class="text-center">
                                            <?php echo $fixed['need_day'] ?>
                                        </td>
                                </table>

                            </div>
                            <!-- <div class="card-footer">
                        <div class="input-group">
                            <input class="form-control form-control-sm" type="text" placeholder="Input harga">
                            <button class="btn btn-sm btn-warning w-25" type="button">Bid</button>
                        </div>
                        
                        
                    </div> -->
                        </div>
                    </div>
                    <!-- end of card -->
                <?php } ?>
            <?php } ?>

        </div>
    </div>

    <script>
        $(document).ready(function () {
            var text = $("#fixed").html();
            $("#fixed").html("");
            var i = 0;
            function type() {
                if (i < text.length) {
                    $("#fixed").html(text.substring(0, i + 1));
                    i++;
                    setTimeout(type, 200); // Adjust the typing speed (in milliseconds)
                }



            }
            type();
            var arrCount = 0;
            // function rightArrow() {
            //     if (arrCount%2 == 0) {
            //         $("#fixed").append('<i class="bi bi-caret-right-fill" style="font"></i>');
            //     } else {
            //         $("#fixed").append('<i class="bi bi-caret-right"></i>');
            //     };

            //     if (arrCount == 10) {return;};
            //     arrCount++;
            //     setTimeout(rightArrow, 100);
            // }
            setTimeout(function () {
                // rightArrow();
                $("#fixed").append('<i class="bi bi-tags-fill float-end me-2 m-1" style="text-shadow: none;"></i>');
            }, 200 * text.length + 100);

        });

        $(function () {
            var text = $("#bid").html();
            $("#bid").html("");
            var i = 0;
            function type() {
                if (i < text.length) {
                    $("#bid").html(text.substring(0, i + 1));
                    i++;
                    setTimeout(type, 200); // Adjust the typing speed (in milliseconds)
                }



            }
            type();

            setTimeout(function () {
                $("#bid").append('<i class="bi bi-tags-fill float-end me-2 m-1" style="text-shadow: none;"></i>');
            }, 200 * text.length + 100);
        })


    </script>

    <!-- ngirim data -->
    <input type="text" name="nama_kelompok" id="nama_kelompok" value="<?php echo $_SESSION['nama_kelompok'] ?>" hidden>
    <script>
        function sendData(i) {
            var bidNumber = $(`#bid_no${i}`).val();
            var namaKelompok = $('#nama_kelompok').val();
            var harga = $(`#harga_bid${i}`).val();


            var formData = {
                bidNumber: bidNumber,
                namaKelompok: namaKelompok,
                harga: harga
            };

            Swal.fire({
                title: 'Apakah anda yakin??',
                text: "Anda hanya bisa membuat bid satu kali!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, lakukan bid!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "send.php",
                        data: formData,
                        dataType: "json",
                        success: (e) => {
                            console.log(e);
                            if (!e.success) {
                                Swal.fire({
                                    title: "Failed",
                                    text: e.message,
                                    icon: "error",
                                    button: "OK"
                                });
                            } else if (e.success) {
                                Swal.fire({
                                    title: "Berhasil",
                                    text: e.message,
                                    icon: "success",
                                    button: "OK"
                                });
                            }
                        }
                    });
                }
            })
            $(`#harga_bid${i}`).val('');
        }

        function sendFixed(i) {
            var fixedID = $(`#fixed_id${i}`).val();
            var fixedNumber = $(`#fixed_no${i}`).val();
            var namaKelompok = $('#nama_kelompok').val();


            var formData = {
                fixedID: fixedID,
                namaKelompok: namaKelompok,
                fixedNumber: fixedNumber,
            };

            Swal.fire({
                title: 'Apakah anda yakin??',
                text: "Anda hanya bisa membuat bid satu kali!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, lakukan bid!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "send.php",
                        data: formData,
                        dataType: "json",
                        success: (e) => {
                            console.log(e);
                            if (!e.success) {
                                Swal.fire({
                                    title: "Failed",
                                    text: e.message,
                                    icon: "error",
                                    button: "OK"
                                });
                            } else if (e.success) {
                                Swal.fire({
                                    title: "Berhasil",
                                    text: e.message,
                                    icon: "success",
                                    button: "OK"
                                });
                            }
                        }
                    });
                }
            })
        }
    </script>

    <!-- auto update tiap day diubah di database (interval jalan 5 detik) -->
    <script>
        var currentDay = '<?php echo $updatedDay; ?>';
        $(document).ready(function () {
            setInterval(function () {
                $.ajax({
                    type: "POST",
                    url: "receive.php",
                    dataType: "json",
                    success: function (response) {
                        var data = response;
                        if (currentDay != data.day) {
                            currentDay = '<?php echo $updatedDay; ?>';
                            window.location.href = window.location.href;
                        }
                    }
                });
            }, 5000);
        });
    </script>

    <div class="spacer layer2 flip mb-0"></div>
</body>

</html>