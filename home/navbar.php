<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IC 2023</title>

    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Box Icon -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            list-style: none;
        }

        :root {
            --bg-color: black;
            --text-color: #ffff;
            --main-color: orange;
        }

        body {
            min-height: 100vh;
            color: var(--text-color);
            margin: 0;
            background-color: black;
            min-height: 100vh;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        #nav_logo {
            max-width: 4rem;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar a {
            color: var(--text-color);
            font-size: 1.1rem;
            font-weight: 500;
            padding: 5px 0;
            margin: 0px 30px;
            transition: all .50s ease;
        }

        .navbar a:hover {
            color: var(--main-color);
        }

        .navbar a.active {
            color: var(--main-color);
        }

        .main {
            display: flex;
            align-items: center;
        }

        .main a {
            margin-right: 25px;
            margin-left: 10px;
            color: var(--text-color);
            font-size: 1.1rem;
            font-weight: 500;
            transition: all .50s ease;
        }

        .user {
            display: flex;
            align-items: center;
        }

        .user i {
            color: var(--main-color);
            font-size: 28px;
            margin-right: 7px;
        }

        .main a:hover {
            color: var(--main-color);
        }

        #menu-icon {
            font-size: 35px;
            color: var(--text-color);
            cursor: pointer;
            z-index: 10001;
            display: none;
        }

        @media (max-width: 1280px) {
            header {
                padding: 14px 2%;
                transition: .2s;
            }

            .navbar a {
                padding: 5px 0;
                margin: 0px 20px;
            }
        }

        @media (max-width: 1090px) {
            #menu-icon {
                display: block;
            }

            .navbar {
                position: absolute;
                top: 100%;
                width: 270px;
                background: var(--main-color);
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                border-radius: 10px;
                transition: all .50s ease;
                display: none;
            }

            .navbar a {
                display: block;
                margin: 12px 0;
                padding: 0px 25px;
                transition: all .50s ease;
            }

            .navbar a:hover {
                color: var(--text-color);
                transform: translateY(5px);
            }

            .navbar a.active {
                color: var(--text-color);
            }

            .navbar.open {
                right: 2%;
                display: block;
            }
        }

        @media (max-width: 400px) {
            #nav_logo {
                max-width: 3rem;
            }

            .user i {
                font-size: 18px;
            }

            .main a {
                font-size: 0.8rem;
            }

            #menu-icon {
                font-size: 28px;
            }

            .navbar a {
                font-size: 0.8rem;
            }

            .navbar {
                width: 180px;
            }
        }
    </style>
</head>

<body>
    <a href="" class="logo"><img src="assets/logo Putih.png" alt="Logo" id="nav_logo"></a>

    <ul class="navbar">
        <li><a href="#home" class="active">Home</a></li>
        <li><a href="#aboutUs">About Us</a></li>
        <li><a href="#timeline">Timeline</a></li>
        <li><a href="#news">News</a></li>
        <li><a href="#gallery">Gallery</a></li>
        <li><a href="#contactUs">Contact Us</a></li>
    </ul>

    <div class="main">
        <a href="../pendaftaran/login.php" class="user"><i class="ri-user-fill"></i>Sign In</a>
        <a href="../pendaftaran/index2.php">Register</a>
        <div class="bx bx-menu" id="menu-icon"></div>
    </div>

    <script>
        let menu = document.querySelector('#menu-icon');
        let navbar = document.querySelector('.navbar');

        menu.onclick = () => {
            menu.classList.toggle('bx-x');
            navbar.classList.toggle('open');
        }
    </script>
</body>

</html>