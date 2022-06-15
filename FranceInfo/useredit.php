<?php
    session_start();
    include 'connect.php';
    $id = $_GET['id'];
    $query = "SELECT * FROM korisnik WHERE id=$id";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);

    if (isset($_POST['prihvati']) && $_SESSION['level'] == 2) {

        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $username = $_POST['username'];
        $level = $_POST['level'];

        $query = "UPDATE korisnik SET ime='$ime', prezime='$prezime', korisnicko_ime='$username', razina=$level WHERE id=$id;";
            
        mysqli_query($dbc, $query) or die('Error querying database.'. mysqli_error($dbc));
        mysqli_close($dbc);
        header("Location: administracija.php?showClanovi=1");

    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FranceInfo | Edit User</title>
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/b05e340512.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php 
        if (array_key_exists('user',$_SESSION) && array_key_exists('level',$_SESSION)) {
            if ($_SESSION['level'] == 2) {
                echo '<header>
                <div class="wrapper">
                    <a href="index.php"><img src="img/franceinfo_logo.png" alt="logo"></a>
                </div>
                <nav>
                    <ul class="wrapper">
                        <li><a href="index.php">home</a></li>
                        <li><a href="kategorija.php?id=politika">politika</a></li>
                        <li><a href="kategorija.php?id=sport">sport</a></li>
                        <li><a href="administracija.php" class="selectedPage">administracija</a></li>
                        <li><a href="unos.php">unos</a></li>
                        <li><a href="logout.php">log out</a></li>
                    </ul>
                </nav>
            </header>

            <main class="content">
            <section class="wrapper naslov">
                    <h2>PROMIJENA KORISNIKA - id#'; echo $id; echo '</h2>
                    <form action="" method="POST" class="forma" enctype="multipart/form-data">
                    <section>
                            <div class="form-item">
                                <label for="title">Ime</label>
                                <div class="form-field">
                                    <textarea name="ime" id="ime" cols="30" rows="1" class="form-field-textual">'; echo $row['ime']; echo '</textarea>
                                </div>
                                <span id="porukaTitle" class="bojaPoruke"></span>
                            </div>

                            <div class="form-item">
                                <label for="title">Prezime </label>
                                <div class="form-field">
                                    <textarea name="prezime" id="prezime" cols="30" rows="1" class="form-field-textual">'; echo $row['prezime']; echo '</textarea>
                                </div>
                                <span id="porukaTitle" class="bojaPoruke"></span>
                            </div>

                            <div class="form-item">
                                <label for="title">Korisnicko ime</label>
                                <div class="form-field">
                                    <textarea name="username" id="username" cols="30" rows="1" class="form-field-textual">'; echo $row['korisnicko_ime']; echo '</textarea>
                                </div>
                                <span id="porukaTitle" class="bojaPoruke"></span>
                            </div>

                            <div class="form-item">
                                <label for="category">RAZINA</label>
                                <div class="form-field">
                                    <select name="level" id="level" class="form-field-textual">';

                                            if ($row['razina'] == 0)
                                            echo '
                                                <option value="" disabled>Odabir razine</option>
                                                <option value="0" selected>Korisnik</option>
                                                <option value="1">Novinar</option>
                                                <option value="2">Administrator</option>';
                                            else if ($row['razina'] == 1)
                                                echo '
                                                <option value="" disabled>Odabir razine</option>
                                                <option value="0">Korisnik</option>
                                                <option value="1" selected>Novinar</option>
                                                <option value="2">Administrator</option>';
                                            else 
                                                echo '
                                                <option value="" disabled>Odabir razine</option>
                                                <option value="0">Korisnik</option>
                                                <option value="1">Novinar</option>
                                                <option value="2" selected>Administrator</option>';
                                        

                                    echo '</select>
                                </div>
                                <span id="porukaKategorija" class="bojaPoruke"></span>
                            </div>

                            <div class="form-item">
                                <button type="submit" value="Prihvati" name="prihvati" id="greenButton">PRIHVATI</button>
                            </div>

                        </section>
                    </form>
            </section>
                
            
            </main>
            <footer>
                <div class="wrapper">
                    <a href="https://www.france.tv/">france.tv</a>
                </div>
            </footer>';
            }
            else if ($_SESSION['level'] == 0) {
                $user = $_SESSION['user'];
                echo "<div class=\"wrapper\"><h2 class=\"noAccess\">$user, nemate dovoljna prava za 
                pristup ovoj stranici.<h2></div>";
                mysqli_close($dbc);
            }
        }
        else {
            echo "<div class=\"wrapper\"><h2 class=\"noAccess\">ZABRANJEN PRISTUP<h2></div>";
            mysqli_close($dbc);
        }
        mysqli_close($dbc);
        ?>
    </body>
</html>