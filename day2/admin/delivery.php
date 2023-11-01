<?php
require_once "../../connect.php";
if(!isset($_SESSION['nrp_admin']) || $_SESSION['nrp_admin'] == ""){
    header("Location: index.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gloock&family=Montserrat:wght@400;800&family=Roboto:ital,wght@0,100;1,100&display=swap" rel="stylesheet">
    <!-- bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- favicon -->
    <link rel="icon" href="../../assets/logo ic.png" type="image/png">

    <style>
        body{
            font-family: 'Montserrat', sans-serif;
            /* background-color: #e8e8e8; */
            /* background-color: #c78a44; */
            /* background: rgb(166,136,203); */
            /* background-color: antiquewhite; */
            /* background: linear-gradient(180deg, rgba(166,136,203,1) 0%, rgba(92,70,156,1) 35%, rgba(29,38,125,1) 67%, rgba(12,19,79,1) 98%); */
            /* background: linear-gradient(180deg, rgba(171,145,201,1) 0%, rgba(92,70,156,1) 40%, rgba(29,38,125,1) 74%, rgba(12,19,79,1) 98%); */
            background-position:center ;
            background-size: cover;
            background-repeat: no-repeat;
            /* height: 100vh; */
        }
        form{
            width: 80%;
            text-align: center;
            /* background-color: aliceblue; */
        }
        .table{
            width: 90%;
            margin: auto;
        }

      .container{
        /* green */
        background: rgba( 122, 163, 154, 0.7 );
        /* blue */
        /* background: rgba( 216,238,255, 0.8 ); */
        /* purple */
        /* background: rgba( 107,102,198, 0.5 ); */
        box-shadow: 0 2px 20px 0 rgba( 31, 38, 135, 0.37 );
       
        border-radius: 10px;
        border: 1px solid rgba( 255, 255, 255, 0.18 );
      }
        
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="../../assets/Logo Putih.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
                <span class="ms-2">Admin Page</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-4" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 p-0 ">
            <li class="nav-item">
                    <a class="nav-link" href="super_admin/">Super Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="input_sertifikasi/">Input Sertifikasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active " href="delivery.php">Delivery</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="news.php">News</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link text-danger " href="api/logout.php">Logout</a>
                </li>
            </ul>
            </div>
        </div>

    </nav>

    <main class="mt-4 mx-3 mb-3">
        <!--  -->
        <h1 class="text-center mb-3">Delivery B2B</h1>

        <div class="container  py-5">
            <form action="api/deliverApi.php" method="post" class="row gy-3 w-100 m-0">
                <div class="col-2 " >
                    <label for="idBid" >Bid NO:</label>
                </div>
                <div class="col-6 ">
                    <input name="idBid" type="number" class="form-control" id="idBid" placeholder="bid number">
                </div>
                <div class="col-4 p-0">
                    <button type="submit" id="submit" class="btn btn-primary w-100 fs-sm-2">Submit</button>
                </div>
            </form>
          
        
            <div class="table"></div>
        </div>
    </main>

    

<!-- swal -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $("#submit").on("click",function(e){
            e.preventDefault();
            $('.table').html("")
            $.ajax({
                url: "api/deliverApi.php",
                method: "POST",
                datatype: "json",
                data:{
                    idBid:$("#idBid").val(),
                    for: "bid"
                    
                },
                success: function(res){
                    console.log(res);
                    if(res.status == 0){
                        Swal.fire({
                            icon:'error',
                            title: 'Gagal Menemukan',
                            text: "Bid tidak ditemukan",

                        })
                    }else if(res.status == 1){
                        Swal.fire({
                            icon:'error',
                            title: 'Tidak ada Pemenang',
                            text: "Bid sudah selesai tidak ada yang menang",
                        })

                    }else if(res.status == 2){
                        if(res.bid){
                            var info = res.bidData;
                            $(".table").html(`
                            ${res.sudahPernah? `<div class="alert alert-danger mt-3" role="alert"> Sudah Pernah di isi late </div>` : `<h1>aaa </h1>` }
                            <h3 class="text-center mt-4" >Delivery Bid</h3>
                            <table class="table table-sm table-bordered border-dark-subtle shadow-lg mt-2" style="font-size: small;">
                                <tr>
                                    <th class="col-4 table-success">Day Published</th>
                                    <td colspan="2" class="text-center col-8">${info.day}</td>
                                </tr>
                                <tr>
                                    <th class="table-success">Bid Number</th>
                                    <td colspan="2" class="text-center">${info.no}</td>
                        
                                </tr>
                                <tr>
                                    <th class="table-success">Client</th>
                                    <td class="text-center col-4">${info.client}</td>
                                    <td class="text-center col-4">${info.kota}</td>
                        
                                </tr>
                                <tr>
                                    <th class="table-success">Product</th>
                                    <td class="text-center">${info.product}</td>
                                    <td class="text-center">${info.jumlah}</td>
                        
                                </tr>
                                <tr>
                                    <th class="table-success">Max Bid Price</th>
                                    <td colspan="2" class="text-center">${info.max_bid}</td>
                                </tr>
                                <tr>
                                    <th class="table-success">Minimum Bidder</th>
                                    <td colspan="2" class="text-center">${info.minimum_bidders}</td>
                        
                                </tr>
                                <tr>
                                    <th class="table-success">Late Penalty</th>
                                    <td colspan="2" class="text-center">${info.late_penalty}</td>
                                </tr>
                                <tr>
                                    <th class="table-success">Bid Result Day</th>
                                    <td colspan="2" class="text-center">${info.result_day}</td>
                        
                                </tr>
                                <tr>
                                    <th class="table-success">Need Day</th>
                                    <td colspan="2" class="text-center">${info.need_day}</td>
                            </table>

                            
                            <div class="input-late bg-bg-danger row gy-2 mt-3">
                                <input type="hidden" name="BidId" id="BidId" value="${res.data.id}">
                                <label for="late" class="col-sm-2">Late: </label>
                                <div class="col-sm-10 pe-0">
                                    <input type="number" class="form-control" name="late" id="late" value="${res.sudahPernah? res.data.late:'0'}" min="0" >
                                </div>
                                <div class="col-8 col-sm-10"></div>
                                <button class="btn btn-primary col-4 col-sm-2" id="submitLate" >Submit</button>
                            </div>
                            `);
                        }else if(res.fixed){
                            var info =res.fixedData;
                            $(".table").html(`
                            ${res.sudahPernah? `<div class="alert alert-danger mt-3" role="alert"> Sudah Pernah di isi late </div>` : `<h1>aaa </h1>` }
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
                            </table>

                            
                            <div class="input-late bg-bg-danger gy-2 row mt-3">
                                <input type="hidden" name="BidId" id="BidId" value="${res.data.id}">
                                <label for="late" class="col-sm-2">Late: </label>
                                <div class="col-sm-10 pe-0">
                                    <input type="number" class="form-control" name="late" id="late" value="${res.sudahPernah? res.data.late:'0'}" min="0" >
                                </div>
                                <div class="col-8 col-sm-10"></div>
                                <button class="btn btn-primary col-4 col-sm-2" id="submitLate" >Submit</button>
                            </div>
                            `);
                        }
                        submitLate();
                    }
                },
                error:function(err){
                    console.log(err);
                    alert("error");
                }
            })
        })


        function submitLate(){
            $("#submitLate").on("click",function(){
                    Swal.fire({
                        icon: 'question',
                        title: 'Apakah anda yakin submit keterlambatan?',
                        text: 'Pastikan Data Sudah Benar',
                        showCancelButton: true,
                        confirmButtonText: `Ya`,
                        cancelButtonText: `Tidak`,
                    }).then((result) => {
                        $.ajax({
                            url: "api/deliverApi.php",
                            method: "POST",
                            datatype: "json",
                            data:{
                                idBid:$("#BidId").val(),
                                late:$("#late").val(),
                                for: "late"
                            },
                            success: function(res){
                                console.log(res);
                                console.log(res.status);
                                if(res.status == 1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Berhasil update late:  '+res.msg+' hari',
                                        showConfirmButton: false,
                                    }).then((result) => {
                                        $(".table").html("");
                                    })
                                }else if(res.status == 0){
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: res.msg,
                                        showConfirmButton: false,
                                        timer: 3000
                                    })
                                }
                                
                            },
                            error:function(err){
                                console.log(err);
                                alert("error");
                            }
                        })     
                    })
            });
        }
    })
</script>
</body>
</html>