<header>
    <nav class="nav-wrapper black">
        <div class="container">
            <a href="" class="brand-logo center">Logo</a>
            <ul>
                <?php if (isset($_SESSION["email"])): ?>
                    <?php if($_SESSION["email"] != "eugeniacapota@gmail.com" && 
                             $_SESSION["email"] != "razvancioarga@gmail.com" && 
                             $_SESSION["email"] != "Admin"): ?>   
                        <?php if ($_SESSION["instrument"] == "piano"): ?>
                            <li class="left-links"><a href="piano-standings.php">Home</a></li>
                        <?php else: ?>
                            <li class="left-links"><a href="violin-standings.php">Home</a></li>
                        <?php endif ?>
                    <?php elseif($_SESSION["email"] == "eugeniacapota@gmail.com"): ?>
                        <li class="left-links"><a href="violin-judge.php">Home</a></li>
                    <?php elseif($_SESSION["email"] == "razvancioarga@gmail.com"): ?>
                        <li class="left-links"><a href="piano-judge.php">Home</a></li>
                    <?php elseif($_SESSION["email"] == "Admin"): ?>
                        <li class="left-links"><a href="admin-page.php">Home</a></li>
                    <?php endif ?>
                <?php else: ?>
                    <li class="left-links"><a href="index.php">Home</a></li>
                <?php endif ?>
                <li class="left-links"><a href="info.php">Competition Format</a></li>
                <li class="left-links"><a href="info.php">Contact</a></li>
            </ul>
            <ul class="right">
                <?php if (isset($_SESSION["firstName"])): ?>
                    <li class="right"><a href="logout.php" class="btn">Log Out</a></li>
                    <li class="left"><?php echo "Hello, " . $_SESSION["firstName"] . "!"; ?></li>
                <?php else: ?>
                    <li class=""><a href="sign-in.php" class="btn">Sign In</a></li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
</header>