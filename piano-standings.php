<?php
    session_start();

    if(!isset($_SESSION["email"])){
        header("Location: HTTP/1.1 403 Forbidden");
    }

    $conn = mysqli_connect("localhost", "tania", "parola123", "music_competition");

    if (!$conn){
        echo "Connection error:<br>" . mysqli_connect_error();
    }

    $sql = "
        SELECT contestants.ID, contestants.FirstName, contestants.LastName, pieces.PieceName, pieces.ComposerName,
        scores.InterpretationScore, scores.TechnicalScore, scores.DifficultyScore, scores.OverallScore,
        contestants.Instrument, contestants.FinalScore
        FROM ((contestants 
        INNER JOIN pieces ON contestants.ID=pieces.ContestantID) 
        INNER JOIN scores ON contestants.ID=scores.ContestantID AND pieces.PieceID=SCORES.PieceID)
        WHERE contestants.Instrument='piano'
        ORDER BY contestants.FinalScore DESC;
    ";

    if (isset($_POST["cat1"])){
        $sql = "
            SELECT contestants.ID, contestants.FirstName, contestants.LastName, pieces.PieceName, pieces.ComposerName,
            scores.InterpretationScore, scores.TechnicalScore, scores.DifficultyScore, scores.OverallScore,
            contestants.Instrument
            FROM ((contestants 
            INNER JOIN pieces ON contestants.ID=pieces.ContestantID) 
            INNER JOIN scores ON contestants.ID=scores.ContestantID AND pieces.PieceID=SCORES.PieceID)
            WHERE contestants.Instrument='piano' AND pieces.Category='option1'
            ORDER BY scores.OverallScore DESC;
        ";
    }

    if (isset($_POST["cat2"])){
        $sql = "
            SELECT contestants.ID, contestants.FirstName, contestants.LastName, pieces.PieceName, pieces.ComposerName,
            scores.InterpretationScore, scores.TechnicalScore, scores.DifficultyScore, scores.OverallScore,
            contestants.Instrument
            FROM ((contestants 
            INNER JOIN pieces ON contestants.ID=pieces.ContestantID) 
            INNER JOIN scores ON contestants.ID=scores.ContestantID AND pieces.PieceID=SCORES.PieceID)
            WHERE contestants.Instrument='piano' AND pieces.Category='option2'
            ORDER BY scores.OverallScore DESC;
        ";
    }

    if (isset($_POST["cat3"])){
        $sql = "
            SELECT contestants.ID, contestants.FirstName, contestants.LastName, pieces.PieceName, pieces.ComposerName,
            scores.InterpretationScore, scores.TechnicalScore, scores.DifficultyScore, scores.OverallScore,
            contestants.Instrument
            FROM ((contestants 
            INNER JOIN pieces ON contestants.ID=pieces.ContestantID) 
            INNER JOIN scores ON contestants.ID=scores.ContestantID AND pieces.PieceID=SCORES.PieceID)
            WHERE contestants.Instrument='piano' AND pieces.Category='option3'
            ORDER BY scores.OverallScore DESC;
        ";
    }

    $result = mysqli_query($conn, $sql);
    $contestants = mysqli_fetch_all($result, MYSQLI_ASSOC);                    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="stylesheets/standings-style.css">
    <title>Standings</title>
</head>
<body>
    <?php include "templates/header.php" ?>
    <div class="container section">
        <h6>You can also check:</h6>
        <a href="violin-standings.php" class="btn">Violin Results</a>

        <h4 class="center"><a href="piano-standings.php">Overall</a> piano results</h4>
        <h6 class="center">Select one to see results on that category.</h6>

        <div class="section center">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="section">
                    <input type="submit" value="category I" name="cat1" class="btn z-depth-0 cat">
                    <input type="submit" value="category II" name="cat2" class="btn z-depth-0 cat">
                    <input type="submit" value="category III" name="cat3" class="btn z-depth-0 cat">
                </div>
            </form>
        </div>
        <div class="container section center">
            <input id="search" type="text" name="searchName" placeholder="Search Contestant">
        </div>
        <table>
            <tr>
                <th>No. Curr</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Piece</th>
                <th>Composer</th>
                <th>Interpretation Score</th>
                <th>Technical Score</th>
                <th>Difficulty Score</th>
                <th>Piece Score</th>
                <?php if (!isset($_POST["cat1"]) && !isset($_POST["cat2"]) && !isset($_POST["cat3"])): ?>
                    <th>Final Score</th>
                <?php endif ?>
            </tr>
            <?php $current = 1; ?>
            <?php if(isset($_POST["cat1"]) || isset($_POST["cat2"]) || isset($_POST["cat3"])): ?>
                <script>
                    document.querySelector("#search").setAttribute("class", "searchName1");
                </script>
                <?php foreach($contestants as $contestant): ?>    
                    <tr>
                        <td><?php echo $current++; ?></td>
                        <td><?php echo $contestant["FirstName"]; ?></td>
                        <td><?php echo $contestant["LastName"]; ?></td>
                        <td><?php echo $contestant["PieceName"]; ?></td>
                        <td><?php echo $contestant["ComposerName"]; ?></td>
                        <td><?php echo $contestant["InterpretationScore"]; ?></td>
                        <td><?php echo $contestant["TechnicalScore"]; ?></td>
                        <td><?php echo $contestant["DifficultyScore"]; ?></td>
                        <td><?php echo $contestant["OverallScore"]; ?></td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <script>
                    document.querySelector("#search").setAttribute("class", "searchName");
                </script>
                <?php 
                    $current = 1; 
                    $i = 0;
                ?>
                <?php while($i < count($contestants)): ?>
                    <?php 
                        $ID = $contestants[$i]["ID"];
                        $sql = "
                            SELECT COUNT(PieceID)
                            FROM pieces
                            WHERE ContestantID='$ID';
                        ";
                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_fetch_assoc($result);
                        $number = $count["COUNT(PieceID)"];

                        if ($number < 3){
                            $i += $number;
                            continue;
                        }
                    ?>
                    <tr>
                        <td rowspan="<?php echo $number; ?>"><?php echo $current++ ?></td>
                        <td rowspan="<?php echo $number; ?>"><?php echo $contestants[$i]["FirstName"] ?></td>
                        <td rowspan="<?php echo $number; ?>"><?php echo $contestants[$i]["LastName"] ?></td>
                        <td><?php echo $contestants[$i]["PieceName"] ?></td>
                        <td><?php echo $contestants[$i]["ComposerName"] ?></td>
                        <td><?php echo $contestants[$i]["InterpretationScore"] ?></td>
                        <td><?php echo $contestants[$i]["TechnicalScore"] ?></td>
                        <td><?php echo $contestants[$i]["DifficultyScore"] ?></td>
                        <td><?php echo $contestants[$i]["OverallScore"] ?></td>
                        <td rowspan="<?php echo $number; ?>"><?php echo $contestants[$i]["FinalScore"] ?></td>
                    </tr>
                    <?php for ($j = $i + 1; $j < $number + $i; $j++): ?>
                        <tr>
                            <td><?php echo $contestants[$j]["PieceName"] ?></td>
                            <td><?php echo $contestants[$j]["ComposerName"] ?></td>
                            <td><?php echo $contestants[$j]["InterpretationScore"] ?></td>
                            <td><?php echo $contestants[$j]["TechnicalScore"] ?></td>
                            <td><?php echo $contestants[$j]["DifficultyScore"] ?></td>
                            <td><?php echo $contestants[$j]["OverallScore"] ?></td>
                        </tr>
                    <?php endfor ?>
                    <?php $i += $number; ?>         
                <?php endwhile ?>
            <?php endif ?>
        </table> 
    </div>
    
    <?php if (!isset($_POST["cat1"]) && !isset($_POST["cat2"]) && !isset($_POST["cat3"])): ?>
        <script type="text/javascript" src="javascripts/search-all.js"></script>
    <?php else: ?>
        <script type="text/javascript">
            let table = document.querySelector("table");
            let rows = table.rows;

            rows[1].classList.add("gold");
            rows[2].classList.add("silver");  
            rows[3].classList.add("bronze");

            document.querySelector(".searchName1").addEventListener("keyup", (event) => {
                for (let i = 1; i < rows.length; i++){
                    if (!rows[i].cells[1].textContent.includes(event.target.value) &&
                        !rows[i].cells[2].textContent.includes(event.target.value)){
                        rows[i].hidden = true;
                    } else {
                        rows[i].hidden = false;
                    }
                }
            });
        </script>
    <?php endif ?>
</body>
</html>
