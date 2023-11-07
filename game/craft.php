<?php
session_start();
if(!isset($_SESSION['nama_kelompok']) || $_SESSION['nama_kelompok'] == ""){
        header('Location: login.php');
        exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crafting Site</title>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&family=Handjet:wght@100;200;300;400;500;600;700;800;900&family=League+Spartan:wght@800&family=Press+Start+2P&family=Staatliches&display=swap" rel="stylesheet">

    <!-- INVENTORY -->
    <!--=============== UNICONS ===============-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="inventory.css">
    
    <!-- fav icon -->
    <link rel="icon" type="image/png" href="../assets/logo%20ic.png">
    
    <style>
                /* http://meyerweb.com/eric/tools/css/reset/ 
        v2.0 | 20110126
        License: none (public domain)
        */

        html, body, div, span, applet, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        a, abbr, acronym, address, big, cite, code,
        del, dfn, em, img, ins, kbd, q, s, samp,
        small, strike, strong, sub, sup, tt, var,
        b, u, i, center,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend,
        table, caption, tbody, tfoot, thead, tr, th, td,
        article, aside, canvas, details, embed, 
        figure, figcaption, footer, hgroup, 
        menu, nav, output, ruby, section, summary,
        time, mark, audio, video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        /* HTML5 display-role reset for older browsers */
        article, aside, details, figcaption, figure, 
        footer, hgroup, menu, nav, section {
            display: block;
        }
        body {
            line-height: 1;
        }
        ol, ul {
            list-style: none;
        }
        blockquote, q {
            quotes: none;
        }
        blockquote:before, blockquote:after,
        q:before, q:after {
            content: '';
            content: none;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }




        /* style mulai dari sini */
        body {
            background-image: url("https://images.unsplash.com/photo-1592093474530-86874167e896?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1901&q=80");
            /* background-image: url(""); */
            /* background-color: #ffffff; */
            background-size: cover;
            background-attachment: fixed;
        
        }   
        .container-craft{
            width: 100%;
            margin: auto;
            margin-top: 0;
            z-index: 5;
        }
        .astronaut {
            display: inline-block;
            background-image: url("../assets/Astronaut.png");
            background-size: 100%;
            width: 500px;
            min-height: 500px;
            position: fixed;
            background-repeat: no-repeat;
            z-index: 2;
            top: 95px;
            animation: fly, rise;
            animation-duration: 3s, 2.6s;
            animation-direction: alternate-reverse;
            animation-iteration-count: infinite, 1;
            animation-timing-function: ease-in, ease-in;
            transition: 2s;
        }
        @keyframes rise {
            from{
                transform: translate(0px, 0px);
            }
            to {
                transform: translate(80vw, 100vh);
                
            }
        }

        .spotlight {
            background-image: url("../assets/StarSilhouette.svg");
            /* background-size: cover; */
            background-size: 100%;
            width: 1000px;
            min-height: 1000px;
            position: fixed;
            background-repeat: no-repeat;
            -webkit-animation: spin-1 3s infinite linear;
            z-index: 0;
            top: -95px;
            
        }

        .spotlight-2 {
            background-image: url("../assets/StarSilhouette\ copy.svg");
            transform: rotate(10deg);
            background-size: cover;
            background-size: 100%;
            width: 900px;
            min-height: 900px;
            position: fixed;
            background-repeat: no-repeat;
            -webkit-animation: spin-2 3s infinite linear;
            z-index: 1;
            top: -95px;
        }

        @keyframes spin-1 {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes spin-2 {
            100% {
                transform: rotate(0deg);
            }
            0% {
                transform: rotate(360deg);
            }
        }

        @keyframes fly {
            0% {
                transform: scale(1,1);
            }
            50% {
                transform: scale(1.3, 1.3);
            }
            100% {
                transform: scale(1.1, 1.1);
            }
        }

        

        .bg-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            z-index: 0;
        }

        .blank {
            height: 340px;
            background-color: #ffffff00;
        }


        /* .header {
            z-index: 4;
            top: 10px;
        } */


        .bom {
            margin: auto;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            /* left: 0px;
            position: relative; */
            width: 100%;

        }

        .bom1, .bom2, .bom3, .bom4, .bom5 {
            /* display: inline; */
            background-color: rgba(255, 228, 196, 0.1);
            border-radius: 5%;
            width: 100%;
            margin-top: 15px;
            box-shadow: #ffffff;
            text-align: center;
            /* margin: auto; */
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            z-index: 0;
            box-shadow: 0px 8px 20px rgb(2, 1, 63);
            position: relative;
            z-index: 0;
            
            
        }
        .bom5 {
            margin-bottom: 100px;
        }



        h1 {
            background: rgb(32,6,57);
            background: linear-gradient(90deg, rgba(66, 27, 102, 0.3) 0%, rgb(22, 8, 62) 35%, rgba(193,0,0,0.3) 100%);
            font-size: 60px;
            padding: 15px;
            border-radius: 20px;
            /* margin-top: 5px;
            margin-right: 5px;
            margin-left: 5px; */
            text-transform: capitalize;
            text-align: center;
            font-weight: lighter;
            font-family: 'Black Ops One';
            color: rgb(255, 255, 255);
            letter-spacing: 4px;
            text-shadow: 2px 1px 5px rgb(255, 0, 0), 5px 4px 20px rgb(7, 5, 153);
            transition: 1s;
            box-shadow: 0px 10px 50px rgb(0, 0, 0);
        }


        .section {
            background: rgb(32,6,57);
            background: linear-gradient(90deg, rgba(66, 27, 102, 0.3) 0%, rgb(22, 8, 62) 35%, rgba(193,0,0,0.3) 100%);

        }
        

    

        @media screen and (max-width:640px) {
            h2, div.bom-img, table.recipe {
                width: 100%;
            }

            div.bom-img img {
                height: 200px;
            }

            span.h2 {
                display: block;
                font-size: 30px;
                font-weight: bold;
                height: 45px;
            }

            table {
                width: 100%;
            }
            table tr {
                font-size: 18px;
                height: 30px;
            }

            .bom1, .bom2, .bom3, .bom4, .bom5 {
                flex-direction: column;
            }



        }
        @media screen and (max-width:376px) {
            h1 {
                font-size: 40px;
            }
            .announce {
                font-size: 11px;
                padding: 5px;
            }
            .bom {
                width: 100%
            }

            .h2, div.bom-img, table.recipe {
                width: 100%;
            }

            span.h2 {
                display: block;
                font-size: 25px;
                font-weight: bold;
                height: 40px;
            }

            table {
                width: 100%;
            }
            table tr {
                font-size: 18px;
                height: 30px;
            }

            .bom1, .bom2, .bom3, .bom4, .bom5 {
                flex-direction: column;
            }
            
        }

        @media screen and (min-width:641px){
            .bom {
                width: 92%;
            }

            .bom-img {
                height: 100%;
            }
            
        }

        @media screen and (min-width:700px) {
            h1 {
                font-size: 90px;
            }
            .bom-img .h2{
                font-size: 30px;
            }
        }

        @media screen and (min-width:850px) and (max-width: 1204px) {
            .bom-img .h2{
                font-size: 20px;
            }
        }

        @media screen and (min-width:1205px) and (max-width: 1400px) {
            .bom-img .h2{
                font-size: 25px;
            }
        }

        @media (max-width: 300px) {
            .bom-img div.loading {
                width: 85px;
                height: 85px;
                bottom: 20%;
            }
        }

        @media (max-width: 450px) and (min-width:300px) {
            .bom-img div.loading {
                width: 120px;
                height: 120px;
                border-width: 30px;
                bottom: 20%;
            }
        }
        @media (max-width: 600px) and (min-width:450px) {
            .bom-img div.loading {
                width: 120px;
                height: 120px;
                border-width: 25px;
                bottom: 20%;
            }
        }

        @media screen and (min-width:850px) {
            .bom-box {
                width: 48%;
                margin: 4px;
            }
            .bom {
                
                flex-direction: row;
            }
            .bom5 {
                margin-bottom: 100px;
            }
            
        }

        .announce {
            width: 300px;
            text-align: center;
            text-decoration: dotted;
            color: rgb(247, 254, 223);

            position: relative;
            border: 2px solid #ffffff;
            font-family: 'League Spartan', sans-serif;

            font-size: 14px;
            margin: auto;
            margin-top: 10px;
            box-sizing: border-box;
            padding: 7px;
            border-radius: 30%;
            background-color: rgba(54, 2, 100, 0.6);
            transition: 1s;

        }

        .announce span:not(.p) {
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
            background-color: rgba(65, 10, 116, 0.2);
            padding: 2px;
            color: rgb(200, 255, 0);
            transition: 1s;
        }
        .nav {
            background-color: rgb(106, 4, 4);
            position: sticky;
            top: 0px;
            box-sizing: border-box;    
            display: flex;
            height: 1cm;
            z-index: 6;
            float: both;
            overflow: auto;
            /* justify-content: start;
            align-items: center; */
        }

        .nav a, .nav span {
            padding: 10px 10px;
            text-decoration: none;
            color: rgb(249, 174, 117);
            font-weight: bolder;
            text-transform: capitalize;
            box-sizing: border-box;
            /* vertical-align: middle; */
        }

        .nav a:hover {
            background-color: rgb(249, 174, 117); 
            color: rgb(95, 0, 19);
            box-shadow: 0px 0px 20px chocolate;
        }

        .h2 {
            font-family: 'Press Start 2P', cursive;
            font-size: 25px;
            font-weight: bold;
            background-color: #fff20299;
            /* width: 100%; */
            box-sizing: border-box;
            padding: 10px 5px;
            height: 50px;
            transition: 1s;
            text-shadow: -3px 2px 5px grey, -5px 1px 10px coral;
            /* float: left; */
            /* position: sticky;
            top: 1cm; */
        }
        .footer {
            background-color: rgba(0, 0, 0, 0.148);
            height: 300px;
        }

        .clearfix:before, .clearfix:after {
            content: "";
            display: table;
        }

        .clearfix:after {
            clear: both;
        }

        .clearfix {
            *zoom: 1;
        }

        table, tr, td, th{
            border: 2px solid rgba(255, 255, 255, 0.133);
        }

        table {
            /* float: left; */
            width: 50%;

        }

        tr, th, td{
            height: 35px;
            font-family: 'League Spartan', cursive;
            font-size: 19px;
            font-weight: lighter;
            vertical-align: middle;
        }

        th {
            background-color: rgba(253, 94, 9, 0.8);
            font-size: 20px;
            text-transform: uppercase;
            font-weight: bolder;
            box-sizing: border-box;
            height: 50px;
        }

        tr td {
            font-family: 'League Spartan', cursive;
            font-weight: bold;
            background-color: rgb(177, 173, 248, 0.5);
            text-transform: uppercase;
            font-size: smaller;
            text-shadow: 2px 2px 10px rgb(227, 243, 189);
            height: 20px;
            box-shadow: -3px 4px 20px rgb(4, 2, 8);

        }

        button {
            font-family: 'Staatliches', cursive;
            font-size: 17px;
            width: 90%;
            height: 90%;
            box-sizing: border-box;
            border-radius: 20%;
            box-shadow: 5px 5px 5px rgba(69, 10, 99, 0.749);
            background: rgb(238,174,202);
            background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);
        }


        .btn-craft:hover {
            background: rgb(109, 1, 48);
            color: antiquewhite;
            opacity: 0.5;
        }



        .section-title {
            font-size: 30px;
            width: 100%;
            float: left;
        }

        .bom-img {
            z-index: 2;
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
            align-items: center;
            justify-content: center;
            
        }
        .bom-img .h2 {
            display: block;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .bom-img img {
            width: 100%;
            height: 100%;
            position: relative;
            z-index: 1;
            top: 0px;
            margin: auto;
            object-fit: cover;
            object-position: center;
            /* margin-top: 15px; */
            border-top-left-radius: 30%;
            border-bottom-right-radius: 30%;
            transition: 1s;
            box-shadow: inset;

            
            
            
        }
        hr {
            /* border-image: ; */
            height: 30px;
        }

        div.loading {
            height: 100px;
            width: 100px;
            bottom: 25%;
            transition: 1s;
            position: absolute;
            border: 18px dashed #2f07d194; 
            border-radius: 50%; 
            box-sizing: border-box; 
            /* border: 18px; */
            z-index: 8;
            animation: spin-1 1.8s alternate-reverse infinite ease-in-out, colorChanges 0.7s alternate-reverse infinite;
            visibility: hidden; 
        }

        @keyframes colorChanges {
            0%{
                border-color: rgb(251, 0, 0, 0.4);
            }
            14% {
                border-color: rgb(185, 95, 5, 0.4);
            }
            28% {
                border-color: rgb(255, 255, 0, 0.4);
            }
            56% {
                border-color: rgb(0, 128, 0, 0.4);
            }
            70% {
                border-color: rgba(0, 106, 255, 0.396);
            }
            100%{
                border-color: rgb(126, 4, 171, 0.4);
            }
            


        }

        .confirm {
            box-sizing: border-box;
            width: 200px;
            position: absolute; 
            z-index: 6;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 0px;
            border: 1px solid black;
            border-radius: 20px;
            padding: 10px;
            background-color: green;
            text-shadow: 0px 2px 1px #674d4d5d;
            box-shadow: 0px -5px 10px black;
            transition: 0s;
            overflow: hidden;
            visibility: hidden;
            
        }
        
        .jumlah{
            font-size: 15pt;
        }

        @media screen and (max-width:300px){
            .announce {
                width: 100%;
            }
            span.h2{
                font-size: 20px;
            }
        }
        @media screen and(max-width:320px){
            .nav span{
                padding-right: 0px;
            }
           
        }
    </style>
</head>
<body>
    

    <div class="bg-container">

        
        <div class="asteroid"></div>
        <div class="spotlight"></div>
        <div class="spotlight-2"></div>
        <div class="astronaut"></div>
        <div class="container-craft">
            
            <h1>CRAFTING</h1>
            <div class="blank">
                <p class="announce">
                    <span class="p">Welcome to crafting site. </span><br>
                    <span class="p">In this place you can combine material to make </span><br>
                    <span>bill of material</span> 
                </p>

            </div>
            <div class="section clearfix">
                <div class="nav" style="display:flex; justify-content:space-between ">
                    <div class="sec1" style="display:flex; align-items:center">
                        <a href="craft.php">Home</a>
                        <a href="myhistory.php">History</a>
                        <a href="./logout.php">Logout</a>
                    </div>
                    
                <div class="sec2" style="display:flex; align-items:center; margin-left:10px;">
                        <span>Poin: </span>
                        <span id="i-poin"></span>
                    </div>
                </div>

                   
                
                
                <div class="bom clearfix">
                    
                    <div class="bom1 bom-box">
                        <div class="bom-img a">
                            <span class="h2" id="BOMA">BOM-A</span>
                            <div class="loading"></div>
                            <p class="confirm"></p>
                            <img src="https://images.unsplash.com/photo-1630189179044-54e9d1de75e2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1770&q=80" alt="" width="100%" height="100%">
                        </div>
                        
                        <table class="Bom-A recipe">
                            <tr>
                                <th>Element</th>
                                <th>Amount</th>
                            </tr>
                            <tr>
                                <td class="a-col-1">Ferumi</td>
                                <td class="ferumi element"></td>
                            </tr>
                            <tr>
                                <td class="a-col-1">Lateks</td>
                                <td class="lateks element"></td>
                            </tr>
                            <tr>
                                <td class="a-col-1">Timbal</td>
                                <td class="timbal element"></td>
                            </tr>
                            <tr>
                                <td class="a-col-1">Cuprite</td>
                                <td class="cuprite element"></td>
                            </tr>
                            <tr>
                                <td class="a-col-1">Carbon</td>
                                <td class="carbon element"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button id="CraftA" class="btn-craft">
                                        <span>Craft Now</span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    
                        
                    </div>
                    <div class="bom2 bom-box">
                        <img src="" alt="">
                        <div class="bom-img b">
                            <span class="h2"id="BOMB">BOM-B</span>
                            <div class="loading"></div>
                            <p class="confirm"></p>
                            
                            <!-- <img src="https://images.unsplash.com/photo-1491895200222-0fc4a4c35e18?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fG1hdGVyaWFsfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60" alt=""> -->
                            <img src="https://live.staticflickr.com/2343/2176940495_d4719d1289_b.jpg" alt="">
                            
                        </div>
                        
                        <table class="Bom-B recipe">
                            <tr>
                                <th>Element</th>
                                <th>Amount</th>
                            </tr>
                            <tr>
                                <td>Uvarovite</td>
                                <td class="uvarovite element"></td>
                            </tr>
                            <tr>
                                <td>Fluorit</td>
                                <td class="fluorit element"></td>
                            </tr>
                            <tr>
                                <td>Titanium</td>
                                <td class="titanium element"></td>
                            </tr>
                            <tr>
                                <td>Sylvite</td>
                                <td class="sylvite element"></td>
                            </tr>
                            <tr>
                                <td>Silikon</td>
                                <td class="silikon element"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button id="CraftB" class="btn-craft">
                                        <span>Craft Now</span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                    <div class="bom3 bom-box">
                        <div class="bom-img c">
                            <span class="h2" id="BOMC" >BOM-C</span>
                            <div class="loading"></div>
                            <p class="confirm" ></p>
                            
                            <img src="https://images.unsplash.com/photo-1623277219566-dd3e2ee8cc70?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8bWF0ZXJpYWx8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="">
                        
                        </div>
                        <table class="Bom-C recipe">
                            <tr>
                                <th>Element</th>
                                <th>Amount</th>
                            </tr>
                            <tr>
                                <td>Copper</td>
                                <td class="copper element"></td>
                            </tr>
                            <tr>
                                <td>Carbon</td>
                                <td class="carbon element"></td>
                            </tr>
                            <tr>
                                <td>Ferumi</td>
                                <td class="ferumi element"></td>
                            </tr>
                            <tr>
                                <td>Titanium</td>
                                <td class="titanium element"></td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td class="element"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button id="CraftC" class="btn-craft">
                                        <span>Craft Now</span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="bom4 bom-box">
                        <div class="bom-img d">
                            <span class="h2" id="BOMD">BOM-D</span>
                            <div class="loading"></div>
                            <p class="confirm" ></p>
                            
                            <!-- <img src="https://img.freepik.com/free-photo/stones-texture-beach_1428-142.jpg?size=626&ext=jpg&ga=GA1.2.1305773865.1694879307&semt=sph" alt=""> -->
                            <img src="https://images.unsplash.com/photo-1609216970378-ce61cd74a187?auto=format&fit=crop&q=80&w=2070&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
                            
                        </div>
                        <table class="Bom-D recipe">
                            <tr>
                                <th>Element</th>
                                <th>Amount</th>
                            </tr>
                            <tr>
                                <td>Nitrogen</td>
                                <td class="nitrogen element"></td>
                            </tr>
                            <tr>
                                <td>Cuprite</td>
                                <td class="cuprite element"></td>
                            </tr>
                            <tr>
                                <td>Copper</td>
                                <td class="copper element"></td>
                            </tr>
                            <tr>
                                <td>Uvarovite</td>
                                <td class="uvarovite element"></td>
                            </tr>
                            <tr>
                                <td>Timbal</td>
                                <td class="timbal element"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button id="CraftD" class="btn-craft">
                                        <span>Craft Now</span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="bom5 bom-box">
                        <div class="bom-img e">
                            <span class="h2" id="BOME">BOM-E</span>
                            <div class="loading" id="load-E"></div>
                            <p class="confirm"></p>
                            
                            <img src="https://img.freepik.com/free-photo/black-stacked-stones_1194-5730.jpg?size=626&ext=jpg&ga=GA1.2.1305773865.1694879307&semt=sph" alt="">
                            
                            
                        </div>
                        <table class="Bom-E recipe">
                            <tr>
                                <th>Element</th>
                                <th>Amount</th>
                            </tr>
                            <tr>
                                <td>Lateks</td>
                                <td class="lateks element"></td>
                            </tr>
                            <tr>
                                <td>Silikon</td>
                                <td class="silikon element"></td>
                            </tr>
                            <tr>
                                <td>Polisoprena</td>
                                <td class="poliisoprena element"></td>
                            </tr>
                            <tr>
                                <td>Fluorit</td>
                                <td class="fluorit element"></td>
                            </tr>
                            <tr>
                                <td>Hematit</td>
                                <td class="hematit element"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button id="CraftE" class="btn-craft" >
                                        <span>Craft Now</span>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>    
                </div>

                
                
            </div>
            
            <!-- <div class="footer">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste, delectus aspernatur est voluptatum ut nulla. Laboriosam eos, mollitia qui tempora quis quasi rem, et non minus, quod iste doloribus pariatur!</p>
            </div> -->

        </div>
    </div>
    
    <header class="header" id="header">
        <nav class="navbar container">
            <a href="#" class="nav__logo">Inventory</a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list material_list">
                    <li class="nav__item">
                        <a href="#" class="nav__link">
                            <span class="jumlah" id="jumlah_ferumi">x</span> Ferumi 
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">
                            <span class="jumlah" id="jumlah_lateks">x</span> Lateks
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">
                            <span class="jumlah" id="jumlah_timbal">x</span> Timbal
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">
                            <span class="jumlah" id="jumlah_cuprite">x</span> Cuprite
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">
                            <span class="jumlah" id="jumlah_carbon">x</span>Carbon
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">
                            <span class="jumlah" id="jumlah_uvarovite">x</span> Uvavorite 
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">
                            <span class="jumlah" id="jumlah_titanium">x</span> Titanium
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">
                            <span class="jumlah" id="jumlah_sylvite">x</span> Sylvite
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">
                            <span class="jumlah" id="jumlah_silikon">x</span> Silikon
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">
                            <span class="jumlah" id="jumlah_copper">x</span> Copper
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">
                            <span class="jumlah" id="jumlah_nitrogen">x</span> Nitrogen
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">
                            <span class="jumlah" id="jumlah_poliisoprena">x</span> Poliisoprena 
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">
                            <span class="jumlah" id="jumlah_fluorit">x</span></i> Fluorit
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#" class="nav__link">
                            <span class="jumlah" id="jumlah_hematit">x</span></i> Hematit
                        </a>
                </ul>
                <i class="uil uil-times nav__close" id="nav-close"></i>
            </div>

            <div class="nav__btns">
                <div class="nav__toggle" id="nav-toggle">
                    <i class="uil uil-apps"></i>
                </div>
            </div>
        </nav>
    </header>

<script>
    var load = document.getElementsByClassName("loading");
    var confirm = document.getElementsByClassName("confirm");
    var text = ["", "", "","",""];

    for (const iterator of load) {
        iterator.style.visibility = "hidden";
    }


    // document.getElementById("CraftE").addEventListener("click", function(){
        
    //     loading(4);
    //     document.getElementById("CraftE").disabled = true;
    //     setTimeout(function(){
    //         document.getElementById("CraftE").disabled = false;
    //     }, 1100)
    // });
    // showConfirm();
    
    
    //sekali tampil loading +show
    function loading(index) {
        resetConfirm(confirm[index], text[index]);
        
        load[index].style.visibility="visible";
        load[index].style.opacity=1;
        
        setTimeout(function(){
            reset(index);
            confirm[index].style.visibility="visible";
            confirm[index].style.opacity=1;
            typeWriter(confirm[index], text[index]);
            // setTimeout(function() {
            //     confirm[index].style.opacity=0;
            //     confirm[index].style.visibility="hidden";
            // }, 50*text[index].length +400)

        }, 900);
        
        // setTimeout(resetConfirm(confirm[index]), 100);
            
    }

    //reset loading
    function reset (index) {
        load[index].style.opacity=0;
        load[index].style.visibility="hidden";
        
    }    

    //menampilkan confirm jika success atau failed
    function showConfirm () {
        for (var i=0; i<5; i++) {
            if(text[i] == "SUCCESS"){
                confirm[i].style.background="green";
            }
            else if (text[i] == "FAILED"){
                confirm[i].style.background="red";
            }
            else {
                // resetConfirm(confirm[i], text[i]);
                confirm[i].style.background="red";
            }
        }
        
    }

    //menghapus isi confirm
    function resetConfirm (confirmMessage, text) {
        confirmMessage.style.opacity=0;
        confirmMessage.style.visibility="hidden";
        confirmMessage.innerText="";
    }

    
    function typeWriter(typewriterElement, text) {
        // typewriterElement.innerText="";
        let i = 0;
        function type() {
            if (i < text.length) {
                typewriterElement.innerText = text.substring(0,i+1) ;
                i++;
                setTimeout(type, 100); // Adjust the typing speed (in milliseconds)
            }
            
    
        }
        type();
        
    }
</script>
<!--=============== JS ===============-->
<script src="inventory.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- Ajax semua api di craftProses -->
<script>
    $(document).ready(function(){
        function ubahDataBom(Kelompok,Crafting){
            //ubah kelas 1 1
             //Bom-A ferumi,lateks,timbal,cuprite,karbon
                    $(".Bom-A .ferumi").text(Kelompok.qty_Ferumi + "/" + Crafting[0].qty_Ferumi);
                    $(".Bom-A .lateks").text(Kelompok.qty_Lateks + "/" + Crafting[0].qty_Lateks);
                    $(".Bom-A .timbal").text(Kelompok.qty_Timbal + "/" + Crafting[0].qty_Timbal);
                    $(".Bom-A .cuprite").text(Kelompok.qty_Cuprite + "/" + Crafting[0].qty_Cuprite);
                    $(".Bom-A .carbon").text(Kelompok.qty_Karbon + "/" + Crafting[0].qty_Karbon);

                    //Bom-B uvarovite,fluorit,titanium,sylvite,silikon
                    $(".Bom-B .uvarovite").text(Kelompok.qty_Uvarovite + "/" + Crafting[1].qty_Uvarovite);
                    $(".Bom-B .fluorit").text(Kelompok.qty_Fluorit + "/" + Crafting[1].qty_Fluorit);
                    $(".Bom-B .titanium").text(Kelompok.qty_Titanium + "/" + Crafting[1].qty_Titanium);
                    $(".Bom-B .sylvite").text(Kelompok.qty_Sylvite + "/" + Crafting[1].qty_Sylvite);
                    $(".Bom-B .silikon").text(Kelompok.qty_Silikon + "/" + Crafting[1].qty_Silikon);

                    //Bom-C copper,carbon,ferumi,titanium
                    $(".Bom-C .copper").text(Kelompok.qty_Copper + "/" + Crafting[2].qty_Copper);
                    $(".Bom-C .carbon").text(Kelompok.qty_Karbon + "/" + Crafting[2].qty_Karbon);
                    $(".Bom-C .ferumi").text(Kelompok.qty_Ferumi + "/" + Crafting[2].qty_Ferumi);
                    $(".Bom-C .titanium").text(Kelompok.qty_Titanium + "/" + Crafting[2].qty_Titanium);

                    //Bom-D nitrogen,cuprite,copper,uvarovite,timbal
                    $(".Bom-D .nitrogen").text(Kelompok.qty_Nitrogen + "/" + Crafting[3].qty_Nitrogen);
                    $(".Bom-D .cuprite").text(Kelompok.qty_Cuprite + "/" + Crafting[3].qty_Cuprite);
                    $(".Bom-D .copper").text(Kelompok.qty_Copper + "/" + Crafting[3].qty_Copper);
                    $(".Bom-D .uvarovite").text(Kelompok.qty_Uvarovite + "/" + Crafting[3].qty_Uvarovite);
                    $(".Bom-D .timbal").text(Kelompok.qty_Timbal + "/" + Crafting[3].qty_Timbal);

                    //Bom-E lateks,silikon,poliisoprena,fluorit,hematit
                    $(".Bom-E .lateks").text(Kelompok.qty_Lateks + "/" + Crafting[4].qty_Lateks);
                    $(".Bom-E .silikon").text(Kelompok.qty_Silikon + "/" + Crafting[4].qty_Silikon);
                    $(".Bom-E .poliisoprena").text(Kelompok.qty_Poliisoprena + "/" + Crafting[4].qty_Poliisoprena);
                    $(".Bom-E .fluorit").text(Kelompok.qty_Fluorit + "/" + Crafting[4].qty_Fluorit);
                    $(".Bom-E .hematit").text(Kelompok.qty_Hematit + "/" + Crafting[4].qty_Hematit);

                    // ubah warna elemen jadi darkcyan jika sudah penuh
                    $(".element").each(function(){
                        var parts = $(this).text().split("/");
                        var leftValue = parseInt(parts[0]);
                        var rightValue = parseInt(parts[1]);
                        if(leftValue>=rightValue){
                            $(this).css("background-color", "darkcyan");
                        }
                        else {
                            $(this).css("background-color", "rgb(177, 173, 248, 0.5)");
                        }
                    });

            
        }

        function ubahDataMaterial(kelompok){
            $('.material_list #jumlah_ferumi').text(kelompok.qty_Ferumi+"x");
            $('.material_list #jumlah_lateks').text(kelompok.qty_Lateks+"x");
            $('.material_list #jumlah_timbal').text(kelompok.qty_Timbal+"x");
            $('.material_list #jumlah_cuprite').text(kelompok.qty_Cuprite+"x");
            $('.material_list #jumlah_carbon').text(kelompok.qty_Karbon+"x");
            $('.material_list #jumlah_uvarovite').text(kelompok.qty_Uvarovite+"x");
            $('.material_list #jumlah_titanium').text(kelompok.qty_Titanium+"x");
            $('.material_list #jumlah_sylvite').text(kelompok.qty_Sylvite+"x");
            $('.material_list #jumlah_silikon').text(kelompok.qty_Silikon+"x");
            $('.material_list #jumlah_copper').text(kelompok.qty_Copper+"x");
            $('.material_list #jumlah_nitrogen').text(kelompok.qty_Nitrogen+"x");
            $('.material_list #jumlah_poliisoprena').text(kelompok.qty_Poliisoprena+"x");
            $('.material_list #jumlah_fluorit').text(kelompok.qty_Fluorit+"x");
            $('.material_list #jumlah_hematit').text(kelompok.qty_Hematit+"x");
        }

        // 
        function jumlahCrafting(Jumlah){
            Jumlah.forEach(function(e){
                if(e.id_bom == 1 ){
                    $("#BOMA").text("BOM-A ("+e.jumlah+"x)")
                }else if(e.id_bom == 2 ){
                    $("#BOMB").text("BOM-B ("+e.jumlah+"x)")
                }else if(e.id_bom == 3 ){
                    $("#BOMC").text("BOM-C ("+e.jumlah+"x)")
                }else if(e.id_bom == 4 ){
                    $("#BOMD").text("BOM-D ("+e.jumlah+"x)")
                }else if(e.id_bom == 5 ){
                    $("#BOME").text("BOM-E ("+e.jumlah+"x)")
                }
            })
        }
        // $konv_Ferumi = $value['qty_Ferumi'] * 100;
        //                 $konv_Lateks = $value['qty_Lateks'] * 60;
        //                 $konv_Timbal = $value['qty_Timbal'] * 60;
        //                 $konv_Cuprite = $value['qty_Cuprite'] * 50;
        //                 $konv_Karbon = $value['qty_Karbon'] * 150;
        //                 $konv_Uvarovite = $value['qty_Uvarovite'] * 50;
        //                 $konv_Titanium = $value['qty_Titanium'] * 150;
        //                 $konv_Sylvite = $value['qty_Sylvite'] * 70;
        //                 $konv_Silikon = $value['qty_Silikon'] * 70;
        //                 $konv_Copper = $value['qty_Copper'] * 100;
        //                 $konv_Nitrogen = $value['qty_Nitrogen'] * 60;
        //                 $konv_Poliisoprena = $value['qty_Poliisoprena'] * 60;
        //                 $konv_Fluorit = $value['qty_Fluorit'] * 50;
        //                 $konv_Hematit = $value['qty_Hematit'] * 50;

        function hitungPoin(kelompok){
            var poinFerumi = kelompok.qty_Ferumi * 100;
            var poinLateks = kelompok.qty_Lateks * 60;
            var poinTimbal = kelompok.qty_Timbal * 60;
            var poinCuprite = kelompok.qty_Cuprite * 50;
            var poinKarbon = kelompok.qty_Karbon * 150;
            var poinUvarovite = kelompok.qty_Uvarovite * 50;
            var poinTitanium = kelompok.qty_Titanium * 150;
            var poinSylvite = kelompok.qty_Sylvite * 70;
            var poinSilikon = kelompok.qty_Silikon * 70;
            var poinCopper = kelompok.qty_Copper * 100;
            var poinNitrogen = kelompok.qty_Nitrogen * 60;
            var poinPoliisoprena = kelompok.qty_Poliisoprena * 60;
            var poinFluorit = kelompok.qty_Fluorit * 50;
            var poinHematit = kelompok.qty_Hematit * 50;
            var total = kelompok.poin + poinFerumi + poinLateks + poinTimbal + poinCuprite + poinKarbon + poinUvarovite + poinTitanium + poinSylvite + poinSilikon + poinCopper + poinNitrogen + poinPoliisoprena + poinFluorit + poinHematit;
            $("#i-poin").text(total);

        }
        
        function getData(){
                $.ajax({
                url: "api/craftProses.php",
                method: "POST",
                dataType: "json",
                data: {for: "getData"}, //untuk ambil data session langsung di backend
                success: function(res) {
                    console.log(res);
                    // console.log(res.dataKelompok.qty_Ferumi)
                
                    //ubah data
                    var Kelompok = res.dataKelompok;
                    var Crafting = res.dataCrafting;
                    var Jumlah = res.jumlahCrafting
                    ubahDataBom(Kelompok,Crafting);
                    ubahDataMaterial(Kelompok);
                    jumlahCrafting(Jumlah);
                    hitungPoin(Kelompok);

                },
                error: function(){
                    alert("error");
                }
            });
        }
        getData();

        //Crafting
        $(".btn-craft").click(function(){
            var id = $(this).attr("id");
            var ch = id.charAt(id.length-1);
            var intVal = ch.charCodeAt(0); //dapatkan ASCII
            $("#Craft"+ch).prop('disabled',true);
            // console.log(ch);
            // console.log(intVal);
            $.ajax({
                url: "api/craftProses.php",
                method: "POST",
                dataType: "json",
                data: {for: "craft", codeBom: ch}, //untuk ambil data session langsung di backend
                success: function(res) {
                    // console.log(res);
                    if(res.status == "error"){
                        text[intVal-65] = res.msg;

                    }else if(res.status == "success"){
                        text[intVal-65] = "SUCCESS";
                        // $("#Craft"+ch).addClass("finish-craft");
                    }
                    setTimeout(() => {
                            $("#Craft"+ch).prop('disabled',false);
                        }, 2000);

                    showConfirm();
                    loading(intVal-65);
                    getData();
                },
                error: function(){
                    alert("error");
                    setTimeout(() => {
                            $("#Craft"+ch).prop('disabled',false);
                    }, 2000);
                }
            });
        });



    });


    
</script>
</body>
</html>




