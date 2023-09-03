<?php
    require_once "../../connect.php";
    // session_start();

    if (!isset($_SESSION['nrp_admin']) || $_SESSION['nrp_admin'] == "") {
        header("Location: index.php");
        exit();
    }

    //BUAT SELECT TANGGAL DAFTAR
    $getTanggalSql = "SELECT DISTINCT(DATE(tanggal_daftar)) AS dd FROM `kelompok` ORDER BY dd";
    $getTanggalAction = $conn->prepare($getTanggalSql);
    $getTanggalAction->execute();
    $i = 1;
    $outputTanggal = '';
    while ($getTanggalRow = $getTanggalAction->fetch()){
        $isi = date("l, d-m-Y", strtotime($getTanggalRow['dd']));
        $value = date("d-m-Y", strtotime($getTanggalRow['dd']));
        $outputTanggal .= '<option value="'.$value.'">'.$isi.'</option>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "partials/header.php"; ?>

    <title>Admin IC 2023 - List Pendaftar</title>

    <style>
        @font-face {
            font-family: Poppins-Medium;
            src: url(assets/fonts/Poppins-Medium.ttf);
        }

        body {
            background-color: rgb(236 232 232);
            background-repeat: no-repeat;
            min-height: 100vh;
            font-family: Poppins-Medium;
        }

        .mid {
            text-align: center;
        }

        .dt-buttons {
            margin-bottom: 30px;
        }

        .dataTables_length {
            margin-bottom: 1rem;
        }


        /* MODAL FOTO */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-contentt {
            margin: auto;
            display: block;
            width: 80%;
            max-height: 600px;
            margin-bottom: 30px;
            width: auto;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-contentt,
        #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }

            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-contentt {
                width: 90%;
            }
        }

        .selectFilter {
            margin-top: 15px;
        }

        .btn-anggota {
            margin-top: 8px;
        }

        .img-custom {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            max-width: 240px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            border: 3px solid #555;
        }

        .tebal {
            font-weight: bold;
        }

        #rotate {
            animation: mymove 1.5s infinite;
        }

        @keyframes mymove {
            100% {transform: rotate(360deg);}
        }

        .nunggu:hover {
            cursor: pointer;
            color: rgb(50, 50, 185);
            text-decoration: underline;
        }

        .notiflix-report-message {
            text-align: center;
            padding-bottom: 15px;
        }

        #NXReportButton {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include "partials/navbar.php"; ?>
    <div class="container my-5">
        <h1 class="row justify-content-center">
            List Pendaftar
        </h1>
            <div class="row justify-content-center">

            <div class="col-md-5 col-11 selectFilter">
                <select class="form-select form-select-sm" id="selectDay" aria-label="Default select example">
                    <option selected disabled>Filter By Tanggal Pendaftaran...</option>
                    <option value="">All</option>
                    <?php echo $outputTanggal; ?>
                </select>
            </div>

            <div class="col-md-5 col-11 selectFilter">
                <select class="form-select form-select-sm" id="selectStatus" aria-label="Default select example">
                    <option selected disabled>Filter By Status Validasi...</option>
                    <option value="">All</option>
                    <option value="Validated By">Tervalidasi</option>
                    <option value="Waiting for Data Completion">Menunggu Pelengkapan Data</option>
                    <option value="Validasi">Belum Tervalidasi</option>
                    <option value="Rejected By">Tertolak</option>
                </select>
            </div>
            </div>

    </div>

        <div class="card mt-5" style="border-radius: 1.3rem;">
            <div class="card-body table-responsive">
                <!--<div class="d-flex justify-content-center mb-3">-->
                <table class="table table-striped" id="tableMain" style="width: 100%!important;">
                    <thead>
                        <tr class="mid">
                            <th>#</th>
                            <th>Nama Team</th>
                            <th>Sekolah Asal</th>
                            <th>Email</th>
                            <th>Nomor WA</th>
                            <th>ID Line</th>
                            <th>Data Anggota</th>
                            <th>Tanggal Pendaftaran</th>
                            <th>Bukti Transfer</th>
                            <th>Status Validasi</th>
                            <th>Pesan</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyMain"></tbody>
                </table>
            </div>
        </div>

        <!-- Modal DETAIL ANGGOTA -->
        <div class="modal fade" id="detailAnggota" tabindex="-1" data-bs-backdrop="static" aria-labelledby="detailAnggotaLabel" aria-hidden="true" style="padding-top: 0px; background-color: rgba(0, 0, 0, 0.2);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailAnggotaLabel">Detail Anggota</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            Pilih Anggota
                        </div>
                        <div class="row justify-content-center">
                            <div class="btn-group flex-wrap col-md-10" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" data-val="satu" class="btn-check btn-anggota" name="btnradio" id="btnradio1" autocomplete="off" checked>
                                <label class="btn btn-outline-dark" for="btnradio1">Pertama</label>

                                <input type="radio" data-val="dua" class="btn-check btn-anggota" name="btnradio" id="btnradio2" autocomplete="off">
                                <label class="btn btn-outline-dark" for="btnradio2">Kedua</label>

                                <input type="radio" data-val="tiga" class="btn-check btn-anggota" name="btnradio" id="btnradio3" autocomplete="off">
                                <label class="btn btn-outline-dark" for="btnradio3">Ketiga</label>
                            </div>                                
                        </div>
                        <hr>

                        <div class="mt-4" id="cardAnggota"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL FOTO -->
        <div id="imgmodal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-contentt" id="img01">
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".pendaftarNavbar").addClass("active disabled");
            var anggota1 = ''; var anggota2 = ''; var anggota3 = ''; var anggota4 = '';
            Notiflix.Notify.Init({position:"right-bottom",fontFamily:"Quicksand",useGoogleFont:true, });
            Notiflix.Report.Init({ titleFontSize:"21px",messageFontSize:"16px",backOverlay:true, backOverlayColor:"rgba(0,0,0,0.3)",svgSize:"100px",fontFamily:"Quicksand",useGoogleFont:true, }); 
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            
            
            function Search(table) {
                $(document).on('change', '#selectDay', function() {
                    table.columns(7).search(this.value).draw();
                });
                $(document).on('change', '#selectStatus', function() {
                    table.columns(9).search(this.value).draw();
                });
            }
            
            function getData() {
                $.ajax({
                    url: "api/post.php",
                    method: "POST",
                    data: { for: "getData" },
                    success: function(data) {
                        $('.testig').html(data);
                        var res = data.split('//');
                        if (res[0] == "success") {
                            $('#tableMain').DataTable().destroy();
                            $("#tbodyMain").html(res[1]);
                            var table = $('#tableMain').DataTable({
                                "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
                                "scrollX": true,
                                dom: "<'d-flex text-center justify-content-center'B><'row'<'col-sm-6'l><'col-sm-6'f>>" +
                                    "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                                buttons: {
                                    dom: {
                                        button: {
                                            tag: "button",
                                            className: "btn btn-dark my-2"
                                        },
                                        buttonLiner: { tag: null }
                                    }
                                }
                            });
                            Search(table);
                        }
                        else if (res[0] == "error") {
                            alert("error");
                        }
                        else if (res[0] == "session") { document.location.href = res[1]; }
                    },
                    error: function() {
                        alert("error");
                    }
                });
            }
            getData();

            $(document).on('click', '.valid', function() {
                var row = $(this).closest('tr');
                var email = row.find('td:eq(3)').text();

                $.confirm({
                    title: 'VALIDASI',
                    type: 'green',
                    theme: 'modern',
                    icon: "far fa-check-square",
                    backgroundDismissAnimation: 'random',
                    autoClose: 'logoutUser',
                    closeAnimation: 'scale',
                    columnClass: "logOut col-md-5",
                    content: "<div style='color: black;'>Please check carefully :)</div><br>",
                    closeIcon: true,
                    buttons: {
                        Validasi: {
                            text: 'Validasi',
                            btnClass: 'btn btn-success',
                            action: function() {
                                Notiflix.Loading.Hourglass();
                                $.ajax({
                                    url: "api/post.php",
                                    method: "POST",
                                    data: { for: "validasi", email: email },
                                    success: function(data) {
                                        Notiflix.Loading.Remove();
                                        var res = data.split('//');
                                        if (res[0] == "success") { 
                                            getData();
                                            Toast.fire({ icon: 'success', title: 'Tim berhasil divalidasi!' });
                                        }
                                        else if (res[0].trim() == 'already') { 
                                            getData();
                                            Toast.fire({ icon: 'warning', title: 'Status Validasi Tim Sudah di Update!' });
                                        }
                                        else if (res[0] == "session") { document.location.href = res[1]; }
					                    else if (res[0] == "error!"){ Notiflix.Notify.Failure('Gagal<3');}
                                        else { 
                                            Notiflix.Notify.Failure('Gagal!!!'); 
                                            console.log(res[0]);
                                        }
                                    },
                                    error: function() { Notiflix.Loading.Remove(); Notiflix.Notify.Failure('Gagal!!'); }
                                });
                            }
                        },
                        LengkapiData: {
                            text: 'Lengkapi Data',
                            btnClass: 'btn btn-warning',
                            action: function() {
                                (async () => {
                                    const { value: text } = await Swal.fire({
                                        title: 'Data yang Perlu Dilengkapi',
                                        input: 'textarea',
                                        inputPlaceholder: 'Ex: Jumlah transfer kurang 1000 rp, Foto bukti transfer kurang jelas',
                                        showCancelButton: true,
                                        confirmButtonText: 'Send',
                                        allowOutsideClick: false,
                                        inputAttributes: {
                                            autocapitalize: 'off',
                                            autocorrect: 'off'
                                        },
                                        inputValidator: (value) => {
                                            if (!value) {
                                            return 'Isi dulu yaa! :)'
                                            }
                                        }
                                    })
                                    Notiflix.Loading.Hourglass();
                                    $.ajax({
                                        url: "api/post.php",
                                        method: "POST",
                                        data: { for: "lengkapiData", email: email, text: text },
                                        success: function(data) {
                                            Notiflix.Loading.Remove();
                                            var res = data.split('//');
                                            if (res[0].trim() == 'success') {
                                                getData(); 
                                                Toast.fire({ icon: 'success', title: 'Email kepada tim berhasil dikirim!' });
                                            }
                                            else if (res[0] == 'already') { 
                                            getData();
                                            Toast.fire({ icon: 'warning', title: 'Status Validasi Tim Sudah di Update!' });
                                            }   
                                            else if (res[0] == "session") { document.location.href = res[1]; }
                                            else { Notiflix.Notify.Failure('Gagal!'); }
                                        },
                                        error: function() { Notiflix.Loading.Remove(); Notiflix.Notify.Failure('Gagal!'); }
                                    });
                                })()
                            }
                        },
                        Tolak: {
                            text: 'Tolak',
                            btnClass: 'btn btn-danger',
                            action: function() {
                                Notiflix.Loading.Hourglass();    
                                $.ajax({
                                    url: "api/post.php",
                                    method: "POST",
                                    data: { for: "tolak", email: email },
                                    success: function(data) {
                                        Notiflix.Loading.Remove();
                                        var res = data.split('//');
                                        if (res[0] == 'success') { 
                                            getData();
                                            Toast.fire({ icon: 'error', title: 'Tim berhasil ditolak!' });
                                        }
                                        else if (res[0] == 'already') { 
                                            getData();
                                            Toast.fire({ icon: 'warning', title: 'Status Validasi Tim Sudah di Update!' });
                                        }
                                        else if (res[0] == "session") { document.location.href = res[1]; }
                                        else { Notiflix.Notify.Failure('Gagal!'); }
                                    },
                                    error: function() { Notiflix.Loading.Remove(); Notiflix.Notify.Failure('Gagal!'); }
                                });
                            }
                        }
                    }
                });
            });

            $(document).on("click", ".detail", function(){
                var row = $(this).closest('tr');
                var email = row.find('td:eq(3)').text();
                $("#btnradio1").prop("checked", true);

                $.ajax({
                    url: "api/post.php",
                    method: "POST",
                    data: { for: "detailAnggota", email: email },
                    success: function(data) {
                        var res = data.split('//');   
                        
                        if (res[0] == "success") {
                            $("#cardAnggota").html(res[1]);
                            anggota1 = res[1]; anggota2 = res[2]; anggota3 = res[3]; anggota4 = res[4];

                            // SHOW MODAL
                            var myModal = new bootstrap.Modal(document.getElementById('detailAnggota'), {
                                keyboard: false
                            })
                            var modalToggle = document.getElementById('detailAnggota') // relatedTarget
                            myModal.show(modalToggle);
                        }
                        else if (res[0] == "error") {
                            alert("error");
                        }   
                        else if (res[0] == "session") { document.location.href = res[1]; }
                    },
                    error: function() {
                        alert("error");
                    }
                });
            });

            $(document).on('click', '.btn-anggota', function() {
                var urutan = $(this).data("val");

                if (urutan == 'satu') { $("#cardAnggota").html(anggota1); }
                else if (urutan == 'dua') { $("#cardAnggota").html(anggota2); }
                else if (urutan == 'tiga') { $("#cardAnggota").html(anggota3); }
                else if (urutan == 'empat') { $("#cardAnggota").html(anggota4); } 
            });

            $(document).on('click', '.nunggu', function() {
                var kurang = "<center>" + $(this).data("val") + "</center>";
                var row = $(this).closest('tr');
                var email = row.find('td:eq(3)').text();
                // Notiflix.Report.Info(
                //     'Data Yang Perlu Dilengkapi',
                //     kurang,
                //     'Close'
                // );
                $.confirm({
                    title: 'Data yang perlu dilengkapi',
                    type: 'green',
                    theme: 'modern',
                    icon: "far fa-check-square",
                    backgroundDismissAnimation: 'random',
                    autoClose: 'logoutUser',
                    closeAnimation: 'scale',
                    columnClass: "logOut col-md-5",
                    content: "<div style='color: black;'>Please check carefully :)</div><br>",
                    closeIcon: true,
                    buttons: {
                        // Edit:{
                        //     text: 'Edit Data',
                        //     btnClass: 'btn btn-warning',
                        //     action: function(){
                        //         (async () => {
                        //             // EDIT DATA AJAX
                        //             const { value: text } = await Swal.fire({
                        //                 title: 'Edit data kelompok',
                        //                 html:
                        //                     '<form class="editForm" enctype="multipart/form-data"><select id="col-name" name="col-name" class="col-name"><option value="nomerwa">Nomor Wa</option><option value="buktitrf">Bukti Transfer</option><option value="foto_diri_ketua">Foto Diri Ketua</option><option value="foto_diri_peserta2">Foto diri Peserta 2</option><option value="foto_diri_peserta3">Foto Diri Peserta 3</option><option value="foto_pelajar_ketua">Foto Pelajar Ketua</option><option value="foto_pelajar2">Foto Kartu Pelajar 2</option><option value="foto_pelajar3">Foto Kartu Pelajar 3</option></select><input type="text" name="for" id="for" value="editData" style="display:none"><input type="text" name="email" id="email" value="'+email+'" style="display:none"><div class="input-container"><input type="text" id="nomerwa" class=".swal2-input" name="nomerwa"></div></form>',
                        //                 showCancelButton: true,
                        //                 focusConfirm: false,
                        //                 confirmButtonText: 'Go',
                        //                 allowOutsideClick: false,
                        //                 inputAttributes: {
                        //                     autocapitalize: 'off',
                        //                     autocorrect: 'off'
                        //                 },
                        //                 inputValidator: (value) => {
                        //                     if (!value) {
                        //                     return 'Isi dulu yaa! :)'
                        //                     }
                        //                 }
                        //             })
                        //             Notiflix.Loading.Hourglass();
                        //             var mydata = $('.editForm').serialize();
                        //             $.ajax({
                        //                 url: "api/editKelompok.php",
                        //                 type: "POST",
                        //                 data: mydata,
                        //                 success: function(data) {
                        //                     Notiflix.Loading.Remove();
                        //                     var res = data.split('//');
                        //                     if (res[0] == 'success') {
                        //                         getData(); 
                        //                         Toast.fire({ icon: 'success', title: 'Data berhasil di Update!' });
                        //                     }
                        //                     else if (res[0] == 'already') { 
                        //                     getData();
                        //                     Toast.fire({ icon: 'warning', title: 'Status Validasi Tim Sudah di Update!' });
                        //                     }   
                        //                     else if (res[0] == "session") { document.location.href = res[1]; }
                        //                     else { Notiflix.Notify.Failure('Gagal!'); }
                        //                 },
                        //                 error: function() { Notiflix.Loading.Remove(); Notiflix.Notify.Failure('Gagal!'); }
                        //             });
                        //         })()
                                
                        //     }
                        // }, 
                        Validasi: {
                            text: 'Validasi',
                            btnClass: 'btn btn-success',
                            action: function() {
                                Notiflix.Loading.Hourglass();
                                $.ajax({
                                    url: "api/post.php",
                                    method: "POST",
                                    data: { for: "validasi", email: email },
                                    success: function(data) {
                                        Notiflix.Loading.Remove();
                                        var res = data.split('//');
                                        if (res[0] == 'success') { 
                                            getData();
                                            Toast.fire({ icon: 'success', title: 'Tim berhasil divalidasi!' });
                                        }
                                        else if (res[0] == 'already') { 
                                            getData();
                                            Toast.fire({ icon: 'warning', title: 'Status Validasi Tim Sudah di Update!' });
                                        }
                                        else if (res[0] == "session") { document.location.href = res[1]; }
					                    else if (res[0] == "error!"){ Notiflix.Notify.Failure('Gagal<3');}
                                        else { 
                                            Notiflix.Notify.Failure('Gagal!!!'); 
                                            console.log(res[0]);
                                        }
                                    },
                                    error: function() { Notiflix.Loading.Remove(); Notiflix.Notify.Failure('Gagal!!'); }
                                });
                            }
                        },
                    }
                });
                $(document).on('change','.col-name',function(){
                    if($('.col-name').val() == 'buktitrf' || $('.col-name').val() == 'foto_diri_ketua' || $('.col-name').val() == 'foto_diri_peserta2' || $('.col-name').val() == 'foto_diri_peserta3'||$('.col-name').val() == 'foto_pelajar_ketua'||$('.col-name').val() == 'foto_pelajar2'||$('.col-name').val() == 'foto_pelajar3'){
                        $('.swal2-html-container .input-container').html("<input type='file' id='img' name='"+$('.col-name').val()+"' class='swal2-input' accept='image/*' required>");
                    }else{
                        $('.swal2-html-container .input-container').html("<input type='text' class='.swal2-input' name='"+$('.col-name').val()+"' required>");
                    }
                });
            });
            //FOTO MODAL
            $(document).on("click", ".bukti", function(){
                $('#img01').attr('src', "#");
                var path = '../uploads/buktitransfer/' +$(this).data("val");
                $('#img01').attr('src', path);
                var modal = document.getElementById("imgmodal");
                modal.style.display = "block";
                $('#imgmodal').modal('show');
            });
            $(document).on("click", ".img-custom", function(){
                $('#img01').attr('src', "#");
                var path = $(this).attr('src');
                $('#img01').attr('src', path);
                var modal = document.getElementById("imgmodal");
                modal.style.display = "block";
                $('#imgmodal').modal('show');
            });
            $('.close').on('click', function () {
                $('#imgmodal').modal('hide');
            });
        });
    </script>
</body>
</html>