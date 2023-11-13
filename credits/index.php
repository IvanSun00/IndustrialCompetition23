<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>CREDITS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/stars.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
        @font-face {
            font-family: 'Colopro';
            src: url('../home/assets/colopro.otf') format('truetype');
        }

        html,
        body {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }

        body {
            background: url('assets/bg.png');
            background-size: cover;
            background-repeat: no-repeat;
            backdrop-filter: brightness(60%);
            font-family: 'Colopro';
            color: #fff;
            margin: 0;
            padding: 0 1vh;
        }

        footer {
            text-align: center;
            margin-top: 3.5vh;
        }

        footer img {
            width: 60px;
        }

        .glowing-text {
            animation: glow 5s ease infinite;
        }

        @keyframes glow {

            0%,
            100% {
                text-shadow: 0 0 10px #eb7608a8, 0 0 20px #eb7608a8, 0 0 20px #eb7608a8, 0 0 20px #eb7608a8, 0 0 2px #fed128, 2px 2px 2px #806914;
                color: #fff;
            }

            50% {
                text-shadow: 0 0 2px #804b0b, 0 0 5px #804b0b, 0 0 5px #804b0b, 0 0 5px #804b0b, 0 0 2px #804b0b, 4px 4px 2px #40340a;
                color: #fff;
            }
        }

        .txt {
            text-align: center;
            font-size: 2.75rem;
        }

        .txt2 {
            text-align: center;
            margin-top: -2vh;
            font-size: 3.5rem;
        }

        .swiper {
            width: 300px;
            height: 400px;
            margin-top: 4vh;
        }

        .swiper-slide img {
            width: 300px;
            height: 400px;
        }


        @media (max-width: 540px) {
            .swiper {
                width: 240px;
                height: 320px;
            }

            .swiper-slide img {
                width: 240px;
                height: 320px;
            }

            .txt {
                font-size: 2.25rem;
                margin-top: 4vh;
            }

            .txt2 {
                font-size: 3rem;
            }
        }

        @media (max-width: 320px) {
            .swiper {
                width: 180px;
                height: 240px;
            }

            .swiper-slide img {
                width: 180px;
                height: 240px;
            }

            .txt {
                font-size: 2rem;
            }

            .txt2 {
                font-size: 2.75rem;
            }
        }

        @media (min-height: 800px) {
            .txt {
                margin-top: 10vh;
            }
        }

        .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            font-size: 22px;
            font-weight: bold;
            color: #fff;
        }
    </style>
</head>

<body>
    <section class="wrapper">
        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
    </section>

    <h1 class="txt glowing-text">IT IC 2023</h1>
    <h1 class="txt2 glowing-text">PAMIT UNDUR DIRI</h1>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="assets/ivan.png" alt=""></div>
            <div class="swiper-slide"><img src="assets/farrell.png" alt=""></div>
            <div class="swiper-slide"><img src="assets/ebet.png" alt=""></div>
            <div class="swiper-slide"><img src="assets/jevelin.png" alt=""></div>
            <div class="swiper-slide"><img src="assets/jovan.png" alt=""></div>
            <div class="swiper-slide"><img src="assets/marvel.png" alt=""></div>
            <div class="swiper-slide"><img src="assets/daud.png" alt=""></div>
        </div>
    </div>

    <footer>
        <a href="../home"><img src="assets/back.png" alt=""></a>
    </footer>

    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "cards",
            grabCursor: true,
        });
    </script>
</body>

</html>