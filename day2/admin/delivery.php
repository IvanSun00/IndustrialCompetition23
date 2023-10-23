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
            /* background: rgb(166,136,203); */
            background-color: antiquewhite;
            /* background: linear-gradient(180deg, rgba(166,136,203,1) 0%, rgba(92,70,156,1) 35%, rgba(29,38,125,1) 67%, rgba(12,19,79,1) 98%); */
            /* background: linear-gradient(180deg, rgba(171,145,201,1) 0%, rgba(92,70,156,1) 40%, rgba(29,38,125,1) 74%, rgba(12,19,79,1) 98%); */
            background-position:center ;
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
        }
        form{
            width: 80%;
            text-align: center;
            /* background-color: aliceblue; */
        }
    </style>
</head>
<body>
<h1 class="text-center mb-5">Delivery B2B</h1>

    <div class="container bg-body-tertiary h-50 ">
        <form action="api/deliverApi.php" method="post" class="row gy-3 w-100 ">
            <div class="col-2 " >
                <label for="idBid" >Bid NO:</label>
            </div>
            <div class="col-6 ">
                <input name="idBid" type="text" class="form-control" id="idBid" placeholder="bid number">
            </div>
            <div class="col-4 ">
                <button type="submit" id="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </form>
        <!-- tabel -->
        <div class="table">
            
        </div>

        <!-- status keterlambatan -->
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $("#submit").on("click",function(e){
        e.preventDefault();
        $.ajax({
            url: "api/deliverApi.php",
            method: "POST",
            data:{
                idBid:$("#idBid").val()
            },
            success: function(res){
                $(".table").html(res);
            },
            error:function(err){
                console.log(err);
            }
        })
    })
  
</script>
</body>
</html>