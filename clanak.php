<?php
    session_start();
    include 'connect.php';
    $id = $_GET['id'];
    $query = "SELECT * FROM clanak WHERE id='$id'";
    $result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
    $row = mysqli_fetch_array($result);
    mysqli_close($dbc);
?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>FranceInfo | <?php echo $row['naslov'] ?></title>
            <link rel="stylesheet" href="css/style.css" type="text/css">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
            <script src="https://kit.fontawesome.com/b05e340512.js" crossorigin="anonymous"></script>
        </head>
        <body>
            <header>
                <div class="wrapper">
                    <a href="index.php"><img src="img/franceinfo_logo.png" alt="logo"></a>
                </div>
                <nav>
                    <ul id="menu" class="wrapper">
                        <li><a href="index.php">home</a></li>
                        <?php
                        if ($row['kategorija'] == 'sport') {
                            echo '<li><a href="kategorija.php?id=politika">politika</a></li>
                            <li><a href="kategorija.php?id=sport" class="selectedPage">sport</a></li>';
                        }
                        else {
                            echo '<li><a href="kategorija.php?id=politika" class="selectedPage">politika</a></li>
                            <li><a href="kategorija.php?id=sport">sport</a></li>';
                        }

                        if (array_key_exists('user',$_SESSION) && array_key_exists('level',$_SESSION)) {
                            if ($_SESSION['level'] == 2) {
                                echo '<li><a href="administracija.php">administracija</a></li>
                                <li><a href="unos.php">unos</a></li>
                                <li><a href="logout.php">log out</a></li>';
                            }
                            else if ($_SESSION['level'] == 1) {
                                echo '
                                <li><a href="unos.php">unos</a></li>
                                <li><a href="logout.php">log out</a></li>';
                            }
                            else if ($_SESSION['level'] == 0) {
                                echo '<li><a href="logout.php">log out</a></li>';
                            }
                        }
                        else {
                            echo '<li><a href="login.php">login</a></li>';
                        }
                        
                        ?>
                    </ul>
                </nav>
            </header>
        
            <main class="content">
                <section class="wrapper firstSection">
                    <article>
                        <h2><?php echo $row['naslov']; ?></h2>
                        <p><?php echo $row['kratki_sadrzaj']; ?></p>
                        <article class="autdat">
                            <p class="autor">Autor: <?php echo " ".$row['autor'];?></p>
                            <p class="datum">Datum:<?php echo " ".$row['datum']; ?></p>
                            <p class="kategorija">Kategorija:<?php echo " ".$row['kategorija']; ?></p>
                        </article>
                    </article>
                    <img src="<?php echo $row['slika']; ?>" alt="just an image">
                </section>
                <section class="wrapper secondSection">
                    <article>
                        <p class="pEdited"><?php echo $row['sadrzaj']; ?></p>
                    </article>
                </section>
            </main>
            <footer class="clanakFooter">
                <div class="wrapper">
                    <a href="/index.php"><img src="img\franceinfo_logo_white.png" alt=""></a>
                </div>
            </footer>
        </body>
    </html>