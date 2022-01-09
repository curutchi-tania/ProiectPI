<?php
    session_start();
    
    if ($_SESSION["email"] != "Admin"){
        header("Location: HTTP/1.1 404 Forbidden");
    }
    $conn = mysqli_connect("localhost", "tania", "parola123" , "music_competition");

    if (!$conn){
        echo "Connection error: " . mysqli_connect_error();
    }

    $sql = "SELECT ID, FirstName, LastName, Email, Age, PhoneNumber, Instrument FROM contestants ORDER BY ID";
    
    $result = mysqli_query($conn, $sql);
    $contestants = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (isset($_POST["submit"])){

        $ID = $_POST["ID"];
        $first = $_POST["firstName"];
        $last = $_POST["lastName"];
        $email = $_POST["email"];
        $age = $_POST["age"];
        $phone = $_POST["phoneNumber"];
        $instrument = $_POST["instrument"];
        $final = $_POST["finalScore"];

        $sql = "
            UPDATE contestants
            SET FirstName='$first', LastName='$last', Email='$email', Age='$age',
                PhoneNumber='$phone', Instrument='$instrument', FinalScore='$final'
            WHERE ID='$ID'; 
        ";

        if (!mysqli_query($conn, $sql)){
            echo "Query error: " . mysqli_query_error();
        } else {
            header("Location: admin-page.php");
        }

        // echo $_POST["pieceID"] . "<br>";
        // echo $_POST["intScore"] . "<br>";
        // echo $_POST["techScore"] . "<br>";
        // echo $_POST["diffScore"] . "<br>";
        // echo $_POST["intScore"] + $_POST["techScore"];
    }

    if (isset($_POST["delete"])){

        $ID = $_POST["ID"];

        $sql1 = "
            DELETE FROM scores WHERE ContestantID='$ID';
        ";

        $sql2 = "
            DELETE FROM pieces WHERE ContestantID='$ID';
        ";

        $sql3 = "
            DELETE FROM contestants WHERE ID='$ID';
        ";

        if (!mysqli_query($conn, $sql1) || !mysqli_query($conn, $sql2) || !mysqli_query($conn, $sql3)){
            echo "Query error: " . mysqli_query_error();
        } else {
            header("Location: admin-page.php");
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="stylesheets/standings-style.css">
    <title>Violin Scores</title>
</head>
<body>
    <?php include("templates/header.php"); ?>

    <div class="container users">
        <h4 class="section">Contestants:</h4>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Phone Number</th>
                <th>Instrument</th>
            </tr>
        <?php $current = 1; ?> 
        <?php
            foreach($contestants as $contestant): ?>
                <tr>
                    <td><input type="text" value="<?php echo $contestant['ID']; ?>" readonly></td>
                    <td><input type="text" value="<?php echo $contestant['FirstName']; ?>" readonly></td>
                    <td><input type="text" value="<?php echo $contestant['LastName']; ?>" readonly></td>
                    <td><input type="text" value="<?php echo $contestant['Email']; ?>" readonly></td>
                    <td><input type="text" value="<?php echo $contestant['Age']; ?>" readonly></td>
                    <td><input type="text" value="<?php echo $contestant['PhoneNumber']; ?>" readonly></td>
                    <td><input type="text" value="<?php echo $contestant['Instrument']; ?>" readonly></td>
                    <td class="smth"><button href="#edit" class="btn edit z-depth-0"><i class="material-icons">edit</i></button></td>
                    <td><input type="submit" value="change" class="btn disabled z-depth-0"></td>
                    <td><input type="submit" value="delete" class="btn myRed hide z-depth-0"></td>
                </tr>
            <?php endforeach ?>
        </table>
        <script type="text/javascript" src="javascripts/admin.js"></script>
        </form>
    </div>
</body>
</html>
