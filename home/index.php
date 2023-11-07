<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industrial Competition 2023</title>

    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.zzcss" rel="stylesheet">

    <!-- Box Icon -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!-- fav icon -->
    <link rel="icon" type="image/png" href="../assets/logo%20ic.png">

    <!-- CSS -->
    <link rel="stylesheet" href="css/stars.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/aboutus.css">
    <link rel="stylesheet" href="css/timeline.css">
    <link rel="stylesheet" href="css/news.css">
    <link rel="stylesheet" href="css/gallery.css">
    <link rel="stylesheet" href="css/contactus.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Comfortaa';
            text-decoration: none;
            list-style: none;
        }

        @font-face {
            font-family: 'Colopro';
            src: url('assets/colopro.otf') format('truetype');
        }

        @font-face {
            font-family: 'Comfortaa';
            src: url('assets/comfortaa.ttf') format('truetype');
        }

        html {
            scroll-behavior: smooth;
        }


        body {
            color: var(--text-color);
            background: url('assets/background.png');
            background-size: cover;
            background-repeat: no-repeat;
            overflow-x: hidden !important;
            backdrop-filter: brightness(70%);
            font-family: 'Comfortaa';
        }

        header {
            position: relative;
            width: 100%;
            top: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: transparent;
            padding: 18px 3%;
            transition: all .50s ease;
        }

        .title {
            font-family: 'Colopro';
            letter-spacing: 2px;
        }

        .glowing-text {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
        }

        ::-webkit-scrollbar {
            width: 10px;
            background-color: #23314F;
        }

        ::-webkit-scrollbar-thumb {
            background: #00c6ff;
            background: -webkit-linear-gradient(to right, #00c6ff, #0072ff);
            background: linear-gradient(to right, #00c6ff, #0072ff);
            border-radius: 10px;
            outline: 3px solid #16160e;
            box-shadow: 6px 6px 0px #16160e;
        }

        ::-webkit-scrollbar-track {
            border-radius: 0.3em;
            background: #242942;
            margin-block: 0.25em;
        }
    </style>
</head>

<body>
    <header>
        <?php
        include "navbar.php";
        ?>
    </header>

    <!-- <section class="wrapper">
        <div id="stars"></div>
        <div id="stars2"></div>
        <div id="stars3"></div>
    </section> -->

    <section class="home" id="home">
        <div class="home__container container">
            <div class="home__data">
                <h1 class="home__title title glowing-text" data-aos="zoom-in-up" data-aos-duration="1500">INDUSTRIAL COMPETITION 2023</h1>
                <a href="#aboutUs" class="home__button" data-aos="zoom-in-up" data-aos-duration="1500">
                    Explore
                </a>
            </div>

            <div class="home__img">
                <img src="assets/astronot.png" alt="" style="width: 300px;">
                <div class="home__shadow"></div>
            </div>
        </div>
    </section>

    <section class="aboutUs" id="aboutUs">
        <div class="aboutUs__container container">
            <div class="aboutUs__data">
                <h1 class="aboutUs__title title glowing-text" data-aos="zoom-in-up" data-aos-duration="1500">ABOUT US</h1>
            </div>
        </div>

        <div class="aboutUs__card_container">
            <div class="card" style="background-color:white" data-aos="zoom-in-up" data-aos-duration="1000">
                <div class="img">
                    <img src="assets/aboutusti.jpg" alt="">
                </div>
                <div class="content">
                    <h2>Program Studi Teknik Industri</h2>
                    <p>Program Studi Teknik Industri Universitas Kristen Petra didirikan tahun 1992 dan terakreditasi A oleh Badan Akreditasi Nasional Perguruan Tinggi. Hanya TI - UKP yang memiliki kerja sama dengan...</p>
                    <button class="read-more-btn" data-modal-target="#modal1">Read More</button>
                </div>
            </div>
            <div class="card" style="background-color:white" data-aos="zoom-in-up" data-aos-duration="1500">
                <div class="img">
                    <img src="assets/aboutusic.jpg" alt="">
                </div>
                <div class="content">
                    <h2>Industrial Competition 2023</h2>
                    <p>Industrial Competition (IC) merupakan salah satu acara tahunan yang dilaksanakan untuk memfasilitasi siswa-siswi SMA yang memiliki keinginan untuk mengetahui lebih lanjut lagi mengenai program studi teknik industri...</p>
                    <button class="read-more-btn" data-modal-target="#modal2">Read More</button>
                </div>
            </div>
        </div>

        <div class="modal" id="modal1">
            <div class="modal-header">
                <h1>Program Studi Teknik Industri</h1>
                <button data-close-button class="close-button">&times;</button>
            </div>
            <div class="modal-body">
                Program Studi Teknik Industri Universitas Kristen Petra didirikan tahun 1992 dan terakreditasi A oleh Badan Akreditasi Nasional Perguruan Tinggi. Hanya TI-UKP yang memiliki kerjasama dengan PT. Schneider Electric, PT. Astra Otoparts, PT. Phillips Indonesia, PT. Ecogreen Oleochemicals, PT. Santos Jaya Abadi (Kapal Api group), PT. Smart Tbk, dan masih banyak industri lainnya. Program Studi Teknik Industri yang dimiliki oleh Universitas Kristen Petra mengajarkan mahasiswanya banyak hal, mulai dari segi teknis maupun segi manajerial di bidang rekayasa industri. Dosen yang ada di teknik industri juga memiliki metode pengajaran yang menarik dan melatih mahasiswa untuk mengembangkan baik hard skill maupun soft skillnya sehingga mahasiswa tidak akan bosan dengan pelajaran yang diberikan. Selain itu lulusan dari teknik industri diharapkan untuk dapat bekerja dengan profesional dan mengatasi semua permasalahan yang ada terkait perkembangan zaman dan teknologi dalam sektor manufaktur maupun dari segi jasa.
                <br><br>
                Teknik Industri merupakan salah satu program studi yang sangat menarik. Terutama untuk siswa-siswi yang memiliki keinginan untuk mempelajari dan mendalami berbagai bidang. Lulusan TI-UKP adalah lulusan yang mampu menjadi problem solver masalah industri, memiliki kemampuan manajerial sumber daya dan interpersonal skill, memiliki integritas, mampu bersaing di era global melalui kemampuan IT dan bahasa Inggris, serta memiliki jiwa kewirausahaan. Dalam menghasilkan lulusan TI-UKP yang mampu menjadi problem solver, TI-UKP mengajarkan cara berpikir kritis. Tujuan lain dari pengajaran tersebut adalah agar lulusan TI-UKP juga mampu menciptakan suatu sistem yang efektif dan efisien.
            </div>
        </div>
        <div id="overlay"></div>


        <div class="modal" id="modal2">
            <div class="modal-header">
                <h1>Industrial Competition 2023</h1>
                <button data-close-button class="close-button">&times;</button>
            </div>
            <div class="modal-body">
                Industrial Competition (IC) merupakan salah satu acara tahunan yang dilaksanakan untuk memfasilitasi siswa - siswi SMA yang memiliki keinginan untuk mengetahui lebih lanjut lagi mengenai program studi Teknik Industri yang ada di Universitas Kristen Petra.
                <br><br>
                Tahun ini Industrial Competition 2023 hadir dengan mengangkat tema besar “Odyssey : Navigating the Big Data Universe” untuk memberikan platform bagi para peserta untuk menggabungkan pengetahuan industri dengan kemampuan analisis data yang modern. Dengan menganalisis data relevan secara efektif, peserta akan belajar untuk mengidentifikasi pola yang tidak terlihat sebelumnya, meramalkan tren masa depan, mengoptimalkan proses produksi, meningkatkan customer experience, juga membuat keputusan bisnis yang lebih cerdas secara keseluruhan.
                <br><br>
                Sama seperti tahun sebelumnya, IC 2023 terdiri dari 3 babak yaitu rally games, simulasi produksi, dan studi kasus, sehingga siswa - siswi SMA bisa belajar dan bermain tentang dunia produksi. Lomba ini tidak hanya bagi siswa - siswi yang tertarik di bidang industri saja, karena tema yang diangkat adalah masalah yang general, sehingga pengalaman dan pengetahuan yang didapatkan setelah mengikuti lomba ini bisa diterapkan di semua jurusan.
            </div>
        </div>
        <div id="overlay"></div>


    </section>

    <section class="timeline" id="timeline">
        <div class="timeline__container container">
            <div class="timeline__data">
                <h1 class="timeline__title title glowing-text" data-aos="zoom-in-up" data-aos-duration="1500">TIMELINE</h1>
            </div>
        </div>

        <div class="timeline__line">
            <div class="line__container left-container">
                <img src="assets/star.png">
                <div class="text-box">
                    <h2>Registration</h2>
                    <h3>5 September - 29 Oktober 2023</h3>
                    <span class="left-container-arrow"></span>
                </div>
            </div>
            <div class="line__container right-container">
                <img src="assets/star.png">
                <div class="text-box">
                    <h2>Technical Meeting</h2>
                    <h3>3 November 2023</h3>
                    <span class="right-container-arrow"></span>
                </div>
            </div>
            <div class="line__container left-container">
                <img src="assets/star.png">
                <div class="text-box">
                    <h2>Day 1</h2>
                    <h3>7 November 2023</h3>
                    <span class="left-container-arrow"></span>
                </div>
            </div>
            <div class="line__container right-container">
                <img src="assets/star.png">
                <div class="text-box">
                    <h2>Day 2</h2>
                    <h3>8 November 2023</h3>
                    <span class="right-container-arrow"></span>
                </div>
            </div>
            <div class="line__container left-container">
                <img src="assets/star.png">
                <div class="text-box">
                    <h2>Day 3</h2>
                    <h3>9 November 2023</h3>
                    <span class="left-container-arrow"></span>
                </div>
            </div>
        </div>

    </section>

    <section class="news" id="news">
        <div class="news__container container">
            <div class="news__data">
                <h1 class="news__title title glowing-text" data-aos="zoom-in" data-aos-duration="1500" style="margin-bottom: 5vh">NEWS</h1>
            </div>
            <div class="news__data">
                <h1 class="news__subtitle glowing-text" data-aos="zoom-in" data-aos-duration="1500">Prize Pool</h1>
                <h1 class="news__title animate-character2" data-aos="zoom-in" data-aos-duration="1500" style="margin-bottom: 5vh">62.000.000++</h1>
            </div>
        </div>

        <div data-aos="zoom-in-up" data-aos-duration="1500">

        </div>

        <div class="news__container container">
            <div class="news__data">
                <h1 class="news__subtitle" data-aos="zoom-in" data-aos-duration="1500">Berita dan Pengumuman Terbaru</h1>
            </div>
        </div>

        <!-- Swiper -->
        <div class="swiper mySwiper">

            <div class="swiper-wrapper">
                <div class="card swiper-slide">
                    <div class="card__image">
                        <img src="assets/information3.png" alt="card image">
                    </div>

                    <div class="card__content">
                        <span class="card__title">Modul Babak 1</span>
                        <span class="card__name">Modul Babak 1</span>
                        <p class="card__text">Klik link di bawah ini untuk melihat modul babak 1 IC 2023</p>
                        <a href="https://drive.google.com/file/d/1tWFAFH9kWrTX41fEHEs-w3IpB9xEA-Hk/view?usp=drivesdk" target="_blank"><button class="card__btn">Lihat Modul Babak 1</button></a>
                    </div>
                </div>

                <div class="card swiper-slide">
                    <div class="card__image">
                        <img src="assets/information3.png" alt="card image">
                    </div>

                    <div class="card__content">
                        <span class="card__title">Modul Babak 2</span>
                        <span class="card__name">Modul Babak 2</span>
                        <p class="card__text">Klik link di bawah ini untuk melihat modul babak 2 IC 2023</p>
                        <a href="https://drive.google.com/file/d/1AMRxrmB1-ZiXZURVw_M4WtIYFK5_t810/view?usp=drive_link" target="_blank"><button class="card__btn">Lihat Modul Babak 1</button></a>
                    </div>
                </div>

                <div class="card swiper-slide">
                    <div class="card__image">
                        <img src="assets/information3.png" alt="card image">
                    </div>

                    <div class="card__content">
                        <span class="card__title">Peraturan</span>
                        <span class="card__name">Peraturan IC 2023</span>
                        <p class="card__text">Klik link di bawah ini untuk melihat peraturan IC 2023</p>
                        <a href="https://drive.google.com/file/d/1ROOnda9ey09Dh-uTSKhDxW8raNWstb2s/view?usp=drivesdk" target="_blank"><button class="card__btn">Lihat Peraturan</button></a>
                    </div>
                </div>
            </div>
            <br> <br>
            <div class="swiper-pagination"></div>
        </div>

    </section>

    <section class="gallery" id="gallery">

        <div class="gallery__container container">
            <div class="gallery__data">
                <h1 class="gallery__title title glowing-text" data-aos="zoom-in" data-aos-duration="1500">GALLERY</h1>
            </div>
        </div>

        <div class="gallery__slide__container" data-aos="zoom-in" data-aos-duration="1500">
            <div class="slide-container">
                <div class="slides">
                    <img src="assets/gallery1.jpg" class="active" />
                    <img src="assets/gallery2.jpg" />
                    <img src="assets/gallery3.jpg" />
                    <img src="assets/gallery4.jpg" />
                    <img src="assets/gallery5.jpg" />
                    <img src="assets/gallery6.jpg" />
                    <img src="assets/gallery7.jpg" />
                    <img src="assets/gallery8.jpg" />
                </div>

                <div class="buttons">
                    <span class="next">&#10095;</span>
                    <span class="prev">&#10094;</span>
                </div>

                <div class="dotsContainer">
                    <div class="dot active" attr="0" onclick="switchImage(this)"></div>
                    <div class="dot" attr="1" onclick="switchImage(this)"></div>
                    <div class="dot" attr="2" onclick="switchImage(this)"></div>
                    <div class="dot" attr="3" onclick="switchImage(this)"></div>
                    <div class="dot" attr="4" onclick="switchImage(this)"></div>
                    <div class="dot" attr="5" onclick="switchImage(this)"></div>
                    <div class="dot" attr="6" onclick="switchImage(this)"></div>
                    <div class="dot" attr="7" onclick="switchImage(this)"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="contactUs" id="contactUs">
        <footer>
            <div class="contactUs__container container">
                <div class="contactUs__data">
                    <h1 class="contactUs__title title animate-character">CONTACT US</h1>
                </div>

                <div class="contact_person">

                    <div class="cp">
                        <p style="font-size: 2.5vh">Gita</p>
                        <p><i class="fa-brands fa-whatsapp"></i> 081335187123</p>
                    </div>
                    <div class="cp">
                        <p style="font-size: 2.5vh">Bryan</p>
                        <p><i class="fa-brands fa-whatsapp"></i> 081249354288</p>
                    </div>
                </div>

                <div class="socialIcons">
                    <div class="button">
                        <a href="https://lin.ee/CBRGI3q" style="text-decoration: none; color: black" target="_blank">
                            <div class="icon">
                                <i class="fa-brands fa-line"></i>
                            </div>
                            <span style="font-size: 2.5vh">@654jeemx</span>
                        </a>
                    </div>

                    <div class="button">
                        <a href="https://instagram.com/ic.petra2023" style="text-decoration: none; color: black" target="_blank">
                            <div class="icon">
                                <i class="fa-brands fa-instagram"></i>
                            </div>
                            <span style="font-size: 2.2vh">@ic.petra2023</span>
                        </a>
                    </div>

                    <div class="button">
                        <a href="https://wa.me/6281335187123" style="text-decoration: none; color: black" target="_blank">
                            <div class="icon">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                            <span style="font-size: 2.5vh">WhatsApp</span>
                        </a>
                    </div>
                </div>

                <div class="copyright">
                    <img src="assets/logoatas2.png" alt="">
                    <p>&copy;IT IC 2023</p>
                </div>
            </div>
        </footer>
    </section>

    <script>
        //Open & close modal about us
        const openModalButtons = document.querySelectorAll('[data-modal-target]');
        const closeModalButtons = document.querySelectorAll('[data-close-button]');
        const overlay = document.getElementById('overlay');

        openModalButtons.forEach(button => {
            button.addEventListener('click', () => {
                const modal = document.querySelector(button.dataset.modalTarget);
                openModal(modal);
            });
        });

        overlay.addEventListener('click', () => {
            const modals = document.querySelectorAll('.modal.active');
            modals.forEach(modal => {
                closeModal(modal);
            });
        });

        closeModalButtons.forEach(button => {
            button.addEventListener('click', () => {
                const modal = button.closest('.modal');
                closeModal(modal);
            });
        });

        function openModal(modal) {
            if (modal == null) return;
            modal.classList.add('active');
            overlay.classList.add('active');
            aturPosisiModal(modal);
        }

        function closeModal(modal) {
            if (modal == null) return;
            modal.classList.remove('active');
            overlay.classList.remove('active');
        }

        function aturPosisiModal(modal) {
            modal.style.top = window.innerHeight / 2 + window.scrollY + 'px';
        }

        window.addEventListener("scroll", function() {
            closeModal(modal);
            aturPosisiModal();
        });

        //animasi timeline
        const lineContainers = document.querySelectorAll('.line__container');
        const timelineLine = document.querySelector('.timeline__line');

        function checkAnimation() {
            lineContainers.forEach((container, index) => {
                const triggerOffset = window.innerHeight - 100;
                const containerTop = container.getBoundingClientRect().top;
                if (containerTop < triggerOffset) {
                    container.classList.add('animate');
                    container.classList.remove('disappear');
                } else {
                    container.classList.remove('animate');
                    container.classList.add('disappear');
                }
            });
        }

        function checkLineAnimation() {
            const triggerOffset = window.innerHeight - 100;
            const lineTop = timelineLine.getBoundingClientRect().top;
            if (lineTop < triggerOffset) {
                timelineLine.classList.add('animate-line');
                timelineLine.classList.remove('disappear');
            } else {
                timelineLine.classList.remove('animate-line');
                timelineLine.classList.add('disappear');
            }
        }

        function handleScroll() {
            checkAnimation();
            checkLineAnimation();
        }

        window.addEventListener('scroll', handleScroll);


        // Swiper
        var swiper = new Swiper(".mySwiper", {
            loop: false,
            initialSlide: 1,
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 20,
                stretch: -30,
                depth: 300,
                modifier: 1,
                slideShadows: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
        });


        // GALLERY
        // Access the Images
        let slideImages = document.querySelectorAll(".slide-container .slides img");
        // Access the next and prev buttons
        let next = document.querySelector(".next");
        let prev = document.querySelector(".prev");
        // Access the indicators
        let dots = document.querySelectorAll(".dot");

        var counter = 0;

        // Code for next button
        next.addEventListener("click", slideNext);

        function slideNext() {
            slideImages[counter].style.animation = "next1 0.5s ease-in forwards";
            if (counter >= slideImages.length - 1) {
                counter = 0;
            } else {
                counter++;
            }
            slideImages[counter].style.animation = "next2 0.5s ease-in forwards";
            indicators();
        }

        // Code for prev button
        prev.addEventListener("click", slidePrev);

        function slidePrev() {
            slideImages[counter].style.animation = "prev1 0.5s ease-in forwards";
            if (counter == 0) {
                counter = slideImages.length - 1;
            } else {
                counter--;
            }
            slideImages[counter].style.animation = "prev2 0.5s ease-in forwards";
            indicators();
        }

        // Auto slideing
        function autoSliding() {
            deletInterval = setInterval(timer, 2000);

            function timer() {
                slideNext();
                indicators();
            }
        }
        autoSliding();

        // Stop auto sliding when mouse is over
        const container = document.querySelector(".slide-container");
        container.addEventListener("mouseover", function() {
            clearInterval(deletInterval);
        });

        // Resume sliding when mouse is out
        container.addEventListener("mouseout", autoSliding);

        // Add and remove active class from the indicators
        function indicators() {
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            dots[counter].className += " active";
        }

        // Add click event to the indicator
        function switchImage(currentImage) {
            currentImage.classList.add("active");
            var imageId = currentImage.getAttribute("attr");
            if (imageId > counter) {
                slideImages[counter].style.animation = "next1 0.5s ease-in forwards";
                counter = imageId;
                slideImages[counter].style.animation = "next2 0.5s ease-in forwards";
            } else if (imageId == counter) {
                return;
            } else {
                slideImages[counter].style.animation = "prev1 0.5s ease-in forwards";
                counter = imageId;
                slideImages[counter].style.animation = "prev2 0.5s ease-in forwards";
            }
            indicators();
        }

        //Animated on scroll
        AOS.init();
    </script>
</body>

</html>