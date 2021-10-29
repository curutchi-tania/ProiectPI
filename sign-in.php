<?php 
    
    //connect to database
    $conn = mysqli_connect("localhost", "taniacurutchi", "parola123", "music_competition");

    //check the connection
    if (!$conn){
        echo "Connection error: " . mysqli_connect_error();
    }  

    session_start();
    
    if (isset($_SESSION["email"])){
        $email = $_SESSION["email"];
        $sql = "SELECT Email, Instrument FROM contestants WHERE Email='$email'";
        $result = mysqli_query($conn, $sql);
        $contestant = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        if (empty($contestant)){
            $sql = "SELECT Email, Instrument FROM judges WHERE Email='$email'";
            $result = mysqli_query($conn, $sql);
            $judge = mysqli_fetch_all($result, MYSQLI_ASSOC);

            if (empty($judge)){
                header("Location: index.php");
            } else if ($judge[0]["Instrument"] == "piano"){
                header("Location: piano-judge.php");
            } else {
                header("Location: violin-judge.php");
            }
        } else if ($contestant[0]["Instrument"] == "piano"){
            header("Location: piano-standings.php");
        } else {
            header("Location: violin-standings.php");
        }
    } 
    
    $errors = ["email"=>"", "password"=>""];
    $email = $password = "";

    if (isset($_POST["submit"])){

        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        $sql = "SELECT FirstName, Email, Password, Instrument FROM contestants WHERE Email='$email'";
        $result = mysqli_query($conn, $sql);
        $contestant = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        if(empty($contestant)){

            $sql = "SELECT FirstName, Email, Password, Instrument FROM judges WHERE Email='$email'";
            $result = mysqli_query($conn, $sql);
            $judge = mysqli_fetch_all($result, MYSQLI_ASSOC);

            if (empty($judge)){

                $sql = "SELECT Email, Password FROM admins WHERE Email='$email'";
                $result = mysqli_query($conn, $sql);
                $admin = mysqli_fetch_all($result, MYSQLI_ASSOC);

                if (empty($admin)){
                    $errors["email"] = "There's no account registered with this email.";
                } else if (!password_verify($password, $admin[0]["Password"])){    
                    $errors["password"] = "The password is incorrect.";
                } else {
                    $_SESSION["email"] = htmlspecialchars($email);
                    $_SESSION["firstName"] = $admin[0]["Email"];
                    header("Location: index.php");
                }
            } else if (!password_verify($password, $judge[0]["Password"])){    
                $errors["password"] = "The password is incorrect.";
            } else {
                $_SESSION["email"] = htmlspecialchars($email);
                $_SESSION["firstName"] = $judge[0]["FirstName"];
                $_SESSION["instrument"] = $judge[0]["Instrument"];

                if ($judge[0]["Instrument"] == "piano"){
                    header("Location: piano-judge.php");
                } else {
                    header("Location: violin-judge.php");
                }
            }
        } else if (!password_verify($password, $contestant[0]["Password"])){    
            $errors["password"] = "The password is incorrect.";
        } else {
        
            $_SESSION["email"] = htmlspecialchars($email);
            $_SESSION["firstName"] = $contestant[0]["FirstName"];
            $_SESSION["instrument"] = $contestant[0]["Instrument"];

            if ($contestant[0]["Instrument"] == "piano"){
                header("Location: piano-standings.php");
            } else {
                header("Location: violin-standings.php");
            }
        }        
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="stylesheets/sign-in-style.css">
    <title>Sign In</title>
</head>
<body>
    <?php include "templates/header.php" ?>

    <div class="container">
        <h4 class="center">Sign In</h4>
        <form class="container section" action="sign-in.php" method="POST">
            <div class="input-field">
                <input id="email" name="email" type="text" value="<?php echo $email ?>">
                <label class="active" for="email">Email</label>
                <span class="helper-text red-text"><?php echo $errors["email"] ?></span>
            </div>
            <div class="input-field">
                    <input id="password" name="password" type="password">
                    <label class="active" for="password">Password</label>
                    <span class="helper-text red-text"><?php echo $errors["password"] ?></span>
                </div>
            <section class="section center">
                <input type="submit" name="submit" class="btn submit" value="Sign In">
            </section>
        </form>
    </div>
    
    <?php include "templates/footer.php" ?>
</body>
</html>

