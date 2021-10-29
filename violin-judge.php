<?php
    session_start();
    
    if ($_SESSION["email"] != "mariaionescu@gmail.com"){
        header("Location: HTTP/1.1 404 Forbidden");
    }
    $conn = mysqli_connect("localhost", "taniacurutchi", "parola123", "music_competition");

    if (!$conn){
        echo "Connection error: " . mysqli_connect_error();
    }

    $sql = "
        SELECT pieces.PieceID, contestants.FirstName, contestants.LastName, pieces.PieceName, pieces.ComposerName,
        scores.InterpretationScore, scores.TechnicalScore, scores.DifficultyScore, scores.OverallScore, pieces.Category
        FROM ((contestants
        INNER JOIN pieces ON contestants.ID=pieces.ContestantID)
        INNER JOIN scores ON contestants.ID=scores.ContestantID AND pieces.PieceID=scores.PieceID)
        WHERE contestants.Instrument='violin';
    ";
    
    $result = mysqli_query($conn, $sql);
    $contestants = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (isset($_POST["submit"])){

        $pieceID = htmlspecialchars($_POST["pieceID"]);
        $intScore = htmlspecialchars($_POST["intScore"]);
        $techScore = htmlspecialchars($_POST["techScore"]);
        $diffScore = htmlspecialchars($_POST["diffScore"]);

        $finalScore = (3 * $intScore + 2 * $techScore + $diffScore) / 6;

        $sql = "
            UPDATE scores
            SET InterpretationScore='$intScore', TechnicalScore='$techScore', DifficultyScore='$diffScore', OverallScore='$finalScore'
            WHERE PieceID='$pieceID'; 
        ";

        if (!mysqli_query($conn, $sql)){
            echo "Query error: " . mysqli_query_error();
        } else {

            $sql = "SELECT ContestantID FROM scores WHERE PieceID = '$pieceID'";
            $result = mysqli_query($conn, $sql);
            $contestantID = mysqli_fetch_assoc($result);
            $contestantID = $contestantID["ContestantID"];

            $sql = "SELECT COUNT(PieceID) FROM scores WHERE ContestantID = '$contestantID'";
            $result = mysqli_query($conn, $sql);
            $noOfPieces = mysqli_fetch_assoc($result);
            $noOfPieces = $noOfPieces["COUNT(PieceID)"];
            
            if ($noOfPieces == 3){
                $sql = "SELECT OverallScore FROM scores WHERE ContestantID = '$contestantID'";
                $result = mysqli_query($conn, $sql);
                $scores = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
                $final = ($scores[0]['OverallScore'] + $scores[1]['OverallScore'] + $scores[2]['OverallScore']) / 3;
                echo $final;
                $sql = "UPDATE contestants SET FinalScore = '$final' WHERE ID = '$contestantID'";
                if (!mysqli_query($conn, $sql)){
                    echo mysqli_error($conn);
                }
            }
            header("Location: violin-judge.php");
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

    <div class="container">
        <h4>Contestants:</h4>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Piece</th>
                <th>Composer</th>
                <th>Interpretation Score</th>
                <th>Technical Score</th>
                <th>Difficulty Score</th>
                <th>Piece Score</th>
            </tr>
        <?php $current = 1; ?> 
        <?php
            foreach($contestants as $contestant): ?>
                <tr>
                    <td><input type="text" value="<?php echo $contestant['PieceID']; ?>" readonly></td>
                    <td><?php echo $contestant["FirstName"]; ?></td>
                    <td><?php echo $contestant["LastName"]; ?></td>
                    <td><?php echo $contestant["PieceName"]; ?></td>
                    <td><?php echo $contestant["ComposerName"]; ?></td>
                    <td><input type="text" value="<?php echo $contestant['InterpretationScore']; ?>" readonly></td>
                    <td><input type="text" value="<?php echo $contestant['TechnicalScore']; ?>" readonly></td>
                    <td><input type="text" value="<?php echo $contestant['DifficultyScore']; ?>" readonly></td>
                    <td><?php echo $contestant["OverallScore"]; ?></td>
                    <td class="smth"><button href="#edit" class="btn edit z-depth-0"><i class="material-icons">edit</i></button></td>
                    <td><input type="submit" value="change" class="btn disabled z-depth-0"></td>
                </tr>
            <?php endforeach ?>
        </table>
        <script type="text/javascript" src="javascripts/sandbox.js"></script>
        </form>
    </div>
</body>
</html>