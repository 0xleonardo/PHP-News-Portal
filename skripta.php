<?php  
    session_start();
    include 'connect.php';

        if (isset($_POST['prihvati'])) {
            include 'connect.php';
            
            define('UPLOADPATH', 'img/uploads/');

            $date = date('d.m.Y.');
            $naslov = str_replace("'","\"",$_POST['title']);
            $kratki_sadrzaj = str_replace("'","\"",$_POST['about']);
            $sadrzaj = str_replace("'","\"",$_POST['content']);
            $kategorija = $_POST['category'];

            $name=$_FILES["pphoto"]["name"];
            
            $nameExploded = explode(".",$name);

            $counter = 1;
            $tmpname = $name;

            while($counter > 0) {

                if (file_exists("img/uploads/$tmpname")) {
                    $tmpname = $nameExploded[0];
                    $tmpname .= "$counter";
                    $counter++;
                    $tmpname .= '.'.$nameExploded[1];
                }
                else {
                    move_uploaded_file($_FILES["pphoto"]["tmp_name"], "img/uploads/$tmpname");
                    $counter = 0;
                }
            }

            move_uploaded_file($_FILES["pphoto"]["tmp_name"], "img/uploads/$name");
            
            if(isset($_POST['archive']))
                $archive = 1;
            else
                $archive = 0;
            
            $autor=$_SESSION['user'];
            
            $query = "INSERT INTO clanak (autor, datum, naslov, kratki_sadrzaj, sadrzaj, slika, arhiva, kategorija)
            VALUES ('$autor','$date', '$naslov', '$kratki_sadrzaj', '$sadrzaj', 'img/uploads/$tmpname', '$archive', '$kategorija')";

            mysqli_query($dbc, $query) or die('Error querying database.'. mysqli_error($dbc));
            mysqli_close($dbc);

        }
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>FranceInfo | Preview <?php echo $naslov;?></title>
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
                        <li><a href="kategorija.php?id=politika">politika</a></li>
                        <li><a href="kategorija.php?id=sport">sport</a></li>
                        <?php 
                        if (array_key_exists('user',$_SESSION) && array_key_exists('level',$_SESSION)) {
                            if ($_SESSION['level'] == 2) {
                                echo '<li><a href="administracija.php">administracija</a></li>
                                <li><a href="unos.php" class="selectedPage">unos</a></li>
                                <li><a href="logout.php">log out</a></li>';
                            }
                            else if ($_SESSION['level'] == 1) {
                                echo '
                                <li><a href="unos.php" class="selectedPage">unos</a></li>
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
                        <h2><?php echo $naslov; ?></h2>
                        <p><?php echo $kratki_sadrzaj; ?></p>
                        <article class="autdat">
                            <p class="autor">Autor: <?php echo " ".$autor; ?></p>
                            <p class="datum">Datum:<?php echo " ".$date; ?></p>
                            <p class="kategorija">Kategorija:<?php echo " ".$kategorija; ?></p>
                        </article>
                    </article>
                    <img src="<?php echo UPLOADPATH.$tmpname; ?>" alt="just an image">
                </section>
                <section class="wrapper secondSection">
                    <article>
                        <p class="pEdited"><?php echo $sadrzaj; ?></p>
                    </article>
                </section>
            </main>
            <footer>
                <div class="wrapper">
                    <a href="https://www.france.tv/">france.tv</a>
                </div>
            </footer>
        </body>
    </html>


