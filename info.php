<?php session_start() ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Classical Music Competition</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link rel="stylesheet" href="stylesheets/info-style.css">
    
    <!-- Nu gaseste poza daca pun in fisierul CSS -->
    <style>
        body {
            color: black !important;
        }
    </style>
</head>
<body>
    
    <?php
        include("templates/header.php");
    ?>

    <main>
        <div class="container">
            <div class="section center">
                <h5>In order to participate you must be of age between 20 and 24!</h5>  
            </div>
            <div class="row">
                <div class="col s12 l9">
                    <h4>Structure:</h4>
                    <p>There are two main categories: piano and violin. You can only choose one!<br>
                     For each one, you have three options of pieces as presented below:</p>
                    <p>Option 1: Any etude (study) of choice.<p>
                    <p>Option 2: <br>For piano any piece by a classical composer (Beethoven/Mozart/Haydn etc.)<br>
                                 For violin any piece by a romantic composer (Paganini/Wieniawski/Mendelssohn etc.)</p>
                    <p>Option 3: Any biece by a baroque composer (Bach, etc.)</p>
                    <p>There will be a winner for each category individually and an overall winner.<br> So, you have the choice to prepare only one piece or two, not all of them, and still be eligeble to participate, but then you wouldn't be able to win the big prize, for which you must have three pieces prepared.</p>
                    <p>You will record yourself with video and, of course, audio, performing the chosen pieces.<br>You can have individual files for each piece or you can send one video file with all performances. It's your choice.</p>
                    <p>Then you will send your performance via WeTransfer to the following emails:<br>popescuion@gmail.com for pianists<br>mariaionescu@gmail.com for violinists</p>
                </div>
                <div class="col s12 l3">
                    <h4>Contact:</h4>
                    <p>Phone number: +40 758 385 179</p>
                    <p>Email: classical_sounds@gmail.com</p>
                </div>
            </div>
        </div>
    </main>

    <?php
        include("templates/footer.php");
    ?>    
</body>
</html>