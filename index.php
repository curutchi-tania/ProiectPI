<?php session_start(); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Classical Music Competition</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link rel="stylesheet" href="stylesheets/index-style.css">
    
    <!-- Nu gaseste poza daca pun in fisierul CSS -->
    <style>
        body {
            background-image: url(img/music.jpg);
            background-size: cover;
            height: 100vh;
        }
    </style>
</head>
<body>
    
    <?php
        include("templates/header.php");
    ?>

    <main>
        <div class="container">
            <h3 class="center">Online Classical Music Competition</h4>
            <h4 class="center">First Edition 2021</h5>
            <p class="container center section">Due to the current pandemic issue, competitions are hardly held face-to-face because of the high risk of infection. This is why we came up with this intiative to hold a classical music competition for teens and young adults pianists and violinists exclusively online!</p>
            <div class="center"><a href="register.php" class="btn">Get Started</a></div>
            <section class="section center ">Already a participant? Sign In!</section>
        </div>
    </main>
    
    <?php
        include("templates/footer.php");
    ?>    
</body>
</html>