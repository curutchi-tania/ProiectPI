<?php

    //connect to the database
    $conn = mysqli_connect("localhost", "taniacurutchi", "parola123", "music_competition");

    //check the connection
    if (!$conn){
        echo "Connection error: " . mysqli_connect_error();
    }

    $firstName = $lastName = $email = $password = $age = $phoneNumber = "";
    $composer1 = $piece1 = "";
    $composer2 = $piece2 = "";
    $composer3 = $piece3 = "";
     
    $errors = [
        "instrument"=>"",
        "firstName"=>"", 
        "lastName"=>"", 
        "email"=>"", 
        "password"=>"", 
        "age"=>"", 
        "phoneNumber"=>"",
        "cp"=>""
    ];
    
    if (isset($_POST["submit"])){

        $firstName = htmlspecialchars($_POST["firstName"]);
        $lastName = htmlspecialchars($_POST["lastName"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $age = htmlspecialchars($_POST["age"]);
        $phoneNumber = htmlspecialchars($_POST["phoneNumber"]);

        $composer1 = htmlspecialchars($_POST["composer1"]);
        $piece1 = htmlspecialchars($_POST["piece1"]);
        $composer2 = htmlspecialchars($_POST["composer2"]);
        $piece2 = htmlspecialchars($_POST["piece2"]);
        $composer3 = htmlspecialchars($_POST["composer3"]);
        $piece3 = htmlspecialchars($_POST["piece3"]);
        
        if (empty($_POST["instrument"])){
            $errors["instrument"] = "You forgot to pick your instrument!";
        }

        if (empty($firstName)){
           $errors["firstName"] = "Input your first name!";
        } else if (!preg_match("/^[A-Z][a-z]{1,15}$/", $firstName)){
            $errors["firstName"] = "First letter must be capital!";
        } 

        if (empty($lastName)){
            $errors["lastName"] = "Input your last name!";
        } else if (!preg_match("/^[A-Z][a-z]{1,15}$/", $lastName)){
            $errors["lastName"] = "First letter must be capital!";
        }

        if (empty($email)){
            $errors["email"] = "Input your email!";
        } else if (!preg_match("/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/", $email)){
            $errors["email"] = "This email is not valid!";
        } 

        if (empty($password)){
            $errors["password"] = "Choose a password!";
        } else if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/", $password)){
            $errors["password"] = "Include capital letters, numbers and symbols!";
        } 

        if (empty($age)){
            $errors["age"] = "Input your age!";
        } else if (!preg_match("/^2[0-4]$/", $age)){
            $errors["age"] = "Age must be between 20-24";
        } 

        if (empty($phoneNumber)){
            $errors["phoneNumber"] = "Input your phone number!";
        } else if (!preg_match("/^07[2-8]\d{7}$/", $phoneNumber)){
            $errors["phoneNumber"] = "The phone number is not valid!";
        }

        if (
            (   
                (empty($composer1) && empty($piece1)) &&
                (empty($composer2) && empty($piece2)) &&
                (empty($composer3) && empty($piece3))) ||
                (!empty($composer1) && empty($piece1)) ||
                (empty($composer1) && !empty($piece1)) ||
                (!empty($composer2) && empty($composer2)) ||
                (empty($composer2) && !empty($composer2)) ||
                (!empty($composer3) && empty($piece3)) ||
                (empty($composer3) && !empty($piece3))){
                $errors["cp"] = "Choose at least one category!";
            }
        
        if (!array_filter($errors)){

            $firstName = mysqli_real_escape_string($conn, $_POST["firstName"]);
            $lastName = mysqli_real_escape_string($conn, $_POST["lastName"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $password = mysqli_real_escape_string($conn, $_POST["password"]);
            $age = mysqli_real_escape_string($conn, $_POST["age"]);
            $phoneNumber = mysqli_real_escape_string($conn, $_POST["phoneNumber"]);
            $instrument = mysqli_real_escape_string($conn, $_POST["instrument"]);

            $hash = password_hash($password, PASSWORD_BCRYPT);

            //write query for the database
            $sql = "
                INSERT INTO contestants(FirstName, LastName, Email, Password, Age, PhoneNumber, Instrument)
                VALUES('$firstName', '$lastName', '$email', '$hash', '$age', '$phoneNumber', '$instrument')
            ";
            
            if (!mysqli_query($conn, $sql)){
                echo "Query error" . mysqli_error($conn);
            }

            $sql = "SELECT * FROM contestants WHERE Email='$email'";
            $result = mysqli_query($conn, $sql);
            $contestant = mysqli_fetch_assoc($result);
            $ID = $contestant["ID"];

            if (!empty($composer1)){
                $composer1 = mysqli_real_escape_string($conn, $_POST["composer1"]);
                $piece1 = mysqli_real_escape_string($conn, $_POST["piece1"]);
                $sql = "
                    INSERT INTO pieces (ContestantID, PieceName, ComposerName, Category)
                    VALUES ('$ID', '$piece1', '$composer1', 'option1')
                ";    

                if (!mysqli_query($conn, $sql)){
                    echo "Query error" . mysqli_error($conn);
                }
            } 
            if (!empty($composer2)){
                $composer2 = mysqli_real_escape_string($conn, $_POST["composer2"]);
                $piece2 = mysqli_real_escape_string($conn, $_POST["piece2"]);
                $sql = "
                    INSERT INTO pieces (ContestantID, PieceName, ComposerName, Category)
                    VALUES ('$ID', '$piece2', '$composer2', 'option2')
                ";    

                if (!mysqli_query($conn, $sql)){
                    echo "Query error" . mysqli_error($conn);
                }
            } 
            if (!empty($composer3)){
                $composer3 = mysqli_real_escape_string($conn, $_POST["composer3"]);
                $piece3 = mysqli_real_escape_string($conn, $_POST["piece3"]);
                $sql = "
                    INSERT INTO pieces (ContestantID, PieceName, ComposerName, Category)
                    VALUES ('$ID', '$piece3', '$composer3', 'option3')
                ";    

                if (!mysqli_query($conn, $sql)){
                    echo "Query error" . mysqli_error($conn);
                }
            }

            $sql = "SELECT * FROM pieces WHERE ContestantID='$ID'";
            $result = mysqli_query($conn, $sql);
            $pieces = mysqli_fetch_all($result, MYSQLI_ASSOC);

            foreach($pieces as $piece){
                $pieceID = $piece["PieceID"];
                $sql = "
                    INSERT INTO scores (ContestantID, PieceID)
                    VALUES ('$ID', '$pieceID')
                ";    

                if (!mysqli_query($conn, $sql)){
                    echo "Query error" . mysqli_error($conn);
                }
            }
            
            header("Location: index.php"); 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Classical Music Competition</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link rel="stylesheet" href="stylesheets/register-style.css">
</head>
<body>
    <?php 
        include("templates/header.php");
    ?>

    <div class="container">
        <h4 class="center">Create an account</h4>
        <h6 class="center">Choose your instrument:</h6>
        <div class="center">
            <a href="#piano" class="btn choice">Piano</a>
            <a href="#violin" class="btn choice">Violin</a>
            <section class="center red-text"><?php echo $errors["instrument"] ?></section>
        </div>
        <div class="container">
            <div class="row">
                <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="section signup-form"> 
                    <input type="text" name="instrument" class="hide instrument">
                    <div class="input-field col s4">
                        <input type="text" id="firstName" name="firstName" value="<?php echo $firstName ?>">
                        <label class="active" for="firstName">First Name</label>
                        <span class="helper-text red-text"><?php echo $errors["firstName"] ?></span>
                    </div>
                    <div class="input-field col s4">
                        <input type="text" id="lastName" name="lastName" value="<?php echo $lastName ?>">
                        <label class="active" for="lastName">Last Name</label>
                        <span class="helper-text red-text"><?php echo $errors["lastName"] ?></span>
                    </div>
                    <div class="input-field col s4">
                        <input type="email" id="email" name="email" value="<?php echo $email ?>">
                        <label class="active" for="email">Email</label>
                        <span class="helper-text red-text"><?php echo $errors["email"] ?></span>
                    </div>
                    <div class="input-field col s4">
                        <input type="password" id="password" name="password">
                        <label class="active" for="password">Password</label>
                        <span class="helper-text red-text"><?php echo $errors["password"] ?></span>
                    </div>
                    <div class="input-field col s4">
                        <input type="text" id="age" name="age" value="<?php echo $age ?>">
                        <label class="active" for="age">Age</label>
                        <span class="helper-text red-text"><?php echo $errors["age"] ?></span>
                    </div>
                    <div class="input-field col s4">
                        <input type="text" id="phoneNumber" name="phoneNumber" value="<?php echo $phoneNumber ?>">
                        <label class="active" for="phoneNumber">Phone Number</label>
                        <span class="helper-text red-text"><?php echo $errors["phoneNumber"] ?></span>
                    </div>

                    <div class="row">
                        <div class="col s12 center red-text"><?php echo $errors["cp"] ?></div>
                        <div class="col s12 center">At least one is mandatory!</div>
                        <div class="col s4 center"><h6>Option 1</h6></div>
                        <div class="col s4 center"><h6>Option 2</h6></div>
                        <div class="col s4 center"><h6>Option 3</h6></div>
                    </div>
                    <div class="input-field col s4 center">
                        <input type="text" id="composer1" name="composer1" value="<?php echo $composer1 ?>">
                        <label class="active" for="composer1">Composer</label>
                    </div>
                    <div class="input-field col s4 center">
                        <input type="text" id="composer2" name="composer2" value="<?php echo $composer2 ?>">
                        <label class="active" for="composer2">Composer</label>
                    </div>
                    <div class="input-field col s4 center">
                        <input type="text" id="composer3" name="composer3" value="<?php echo $composer3 ?>">
                        <label class="active" for="composer3">Composer</label>
                    </div>
                    <div class="input-field col s4 center">
                        <input type="text" id="piece1" name="piece1" value="<?php echo $piece1 ?>">
                        <label class="active" for="piece1">Piece</label>
                    </div>
                    <div class="input-field col s4 center">
                        <input type="text" id="piece2" name="piece2" value="<?php echo $piece2 ?>">
                        <label class="active" for="piece2">Piece</label>
                    </div>
                    <div class="input-field col s4 center">
                        <input type="text" id="piece3" name="piece3" value="<?php echo $piece3 ?>">
                        <label class="active" for="piece3">Piece</label>
                    </div>
                    <div class="center">
                        <input type="submit" name="submit" value="Create Account" class="btn submit">
                    </div>      
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="javascripts/instrument-option.js"></script>
    <script type="text/javascript" src="javascripts/validate-form.js"></script>
</body>
</html>