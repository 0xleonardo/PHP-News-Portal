<?php
    session_start();
    include 'connect.php';
    
    if (isset($_POST['showClanak'])) {
        $idClanak = $_POST['showClanak'];
        header("Location: /clanak.php?id=$idClanak");
    }

    if (isset($_POST['editClanak'])) {
        $idClanak = $_POST['editClanak'];
        header("Location: /clanakedit.php?id=$idClanak");
    }

    if (isset($_POST['deleteClanak'])) {
        $idClanak = $_POST['deleteClanak'];
        $query = "DELETE FROM clanak WHERE id=$idClanak;";
        $result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
        mysqli_close($dbc);
        header("Location: administracija.php?showClanak");
    }

    if (isset($_POST['editUser'])) {
        $idUser = $_POST['editUser'];
        header("Location: /useredit.php?id=$idUser");
    }

    if (isset($_POST['deleteUser'])) {
        $idUser = $_POST['deleteUser'];
        $query = "DELETE FROM korisnik WHERE id=$idUser;";
        $result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
        mysqli_close($dbc);
        header("Location: administracija.php?showClanovi");
    }
                
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FranceInfo | Admin Panel</title>
        <link rel="stylesheet" href="css/style.css" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/b05e340512.js" crossorigin="anonymous"></script>
    </head>
    <body>
                <?php
                
                if (array_key_exists('user',$_SESSION) && array_key_exists('level',$_SESSION)) {
                    if ($_SESSION['level'] == 2) {
                        echo  '<header>
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
                        </header>';
                        echo '<main class="content">
                        <div class="wrapper">
                            <form action="" method="GET" class="adminForm">
                                <button type="submit" class="adminButton" name="showClanovi" value="1"><i class="fa-solid fa-user"></i> ČLANOVI</button>
                                <button type="submit" class="adminButton" name="showClanak" value="1"><i class="fa-solid fa-paste"></i> ČLANCI</button>
                            </form>
                            </div>';
                            if (isset($_GET['showClanak'])) {

                                echo '<form action="" method="post">';
                                echo '<table class="adminTable wrapper">
                                    <tr>
                                        <th>Slika</th>
                                        <th>Naslov</th>
                                        <th>Kategorija</th>
                                        <th>Datum</th>
                                        <th>Arhiva</th>
                                        <th>Akcija</th>
                                    </tr>';
                                include 'connect.php';
                                $query = "SELECT * FROM clanak;";
                                $result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
                                $i = 0;
                                while($row = mysqli_fetch_array($result)){
                                    if ($i == 1 || $i % 2 != 0) 
                                        echo '<tr class="drugiTR">';
                                    else 
                                        echo '<tr>';
                                    
                                    echo '
                                    <td><img src="'.$row['slika'].'" alt="1"></td>
                                    <td>'.$row['naslov'].'</td>
                                    <td>'.$row['kategorija'].'</td>
                                    <td>'.$row['datum'].'</td>';
                                    if ($row['arhiva'] == 0)
                                        echo '<td><i class="fa-solid fa-file-lines" style="color: #ff0021;" title="Nije arhivirano"></i></td>';
                                    else 
                                        echo '<td><i class="fa-solid fa-file-lines" style="color: #5cdb5c;" title="Arhivirano"></i></td>';
                                    
                                    echo '<td>
                                        <button type="submit" class="fromButton" value="'.$row['id'].'" name="showClanak" title="Prikaži članak #'.$row['id'].'"><i class="fa-solid fa-file"></i></button>
                                        <button type="submit" class="fromButton" value="'.$row['id'].'" name="editClanak" title="Uredi članak #'.$row['id'].'"><i class="fa-solid fa-file-pen"></i></button>
                                        <button type="submit" class="fromButton" value="'.$row['id'].'" name="deleteClanak" title="Izbriši članak #'.$row['id'].'"><i class="fa-solid fa-file-excel"></i></button>
                                    </td>
                                </tr>';
                                $i++;
                                }
                                echo '</table>
                                </form>';
                                mysqli_close($dbc);
                            }
                            else if (isset($_GET['showClanovi'])) {

                                echo '<form action="" method="post">';
                                echo '<table class="adminTable wrapper">
                                    <tr>
                                        <th>Ime</th>
                                        <th>Prezime</th>
                                        <th>Korisnicko ime</th>
                                        <th>Razina</th>
                                        <th>Akcija</th>
                                    </tr>';
                                include 'connect.php';
                                $query = "SELECT * FROM korisnik;";
                                $result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
                                $i = 0;
                                while($row = mysqli_fetch_array($result)){
                                    if ($i == 1 || $i % 2 != 0) 
                                        echo '<tr class="drugiTR">';
                                    else 
                                        echo '<tr>';
                                    
                                    echo '
                                    <td>'.$row['ime'].'</td>
                                    <td>'.$row['prezime'].'</td>
                                    <td>'.$row['korisnicko_ime'].'</td>
                                    <td>';
                                    if ($row['razina'] == 0) 
                                        echo "Korisnik";
                                    else if ($row['razina'] == 1)
                                        echo "Novinar";
                                    else 
                                        echo "Administrator";
                                    '</td>';
                                    
                                    echo '<td>
                                        <button type="submit" class="fromButton" value="'.$row['id'].'" name="editUser" title="Uredi korisnika \''.$row['korisnicko_ime'].'\'"><i class="fa-solid fa-user-pen"></i></button>
                                        <button type="submit" class="fromButton" value="'.$row['id'].'" name="deleteUser" title="Izbriši korisnika \''.$row['korisnicko_ime'].'\'"><i class="fa-solid fa-user-minus"></i></button>
                                    </td>
                                </tr>';
                                $i++;    
                                }
                                echo '</table>
                                </form>';
                                mysqli_close($dbc);
                            }

                            echo '</main>
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
                    }
                }
                else {
                    echo "<div class=\"wrapper\"><h2 class=\"noAccess\">ZABRANJEN PRISTUP<h2></div>";
                }
            
                ?>
        
    </body>
</html>