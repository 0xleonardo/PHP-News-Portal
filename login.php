<?php  
    session_start();
    include 'connect.php';

    function redirect(){header("Location: index.php");}
    function redirectAlreadyLoggedIn() {header( "refresh:5;url=index.php" );}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FranceInfo | Login</title>
        <link rel="stylesheet" href="css/style.css" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/b05e340512.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php 
        echo '  <header>
                <div class="wrapper">
                    <a href="index.php"><img src="img/franceinfo_logo.png" alt="logo"></a>
                </div>
                <nav>
                    <ul id="menu" class="wrapper">
                        <li><a href="index.php">home</a></li>
                        <li><a href="kategorija.php?id=politika">politika</a></li>
                        <li><a href="kategorija.php?id=sport">sport</a></li>';
            if (array_key_exists('user',$_SESSION) && array_key_exists('level',$_SESSION)) {

                if ($_SESSION['level'] == 2) {
                    echo '<li><a href="administracija.php">administracija</a></li>
                    <li><a href="unos.php">unos</a></li>
                    <li><a href="logout.php">log out</a></li>
                    </ul>
                    </nav>
                </header>';
                }
                else if ($_SESSION['level'] == 1) {
                    echo '
                    <li><a href="unos.php">unos</a></li>
                    <li><a href="logout.php">log out</a></li>
                    </ul>
                    </nav>
                </header>';
                }
                else if ($_SESSION['level'] == 0) {
                    echo '<li><a href="logout.php" class="selectedPage">log out</a></li>
                    </ul>
                    </nav>
                </header>';
                }

                $user = $_SESSION['user'];
                echo "
                </ul>
                    </nav>
                </header>
                <main class='content'>
                <section class='loginSection wrapper'>
                    <h2> $user VEĆ STE PRIJAVLJENI, VRAĆAM VAS NA POČETNU STRANICU...</h2>
                </section>
                </main>
                ";
                redirectAlreadyLoggedIn();
            }
            else {
                echo '<li><a href="login.php" class="selectedPage">login</a></li>
                    </ul>
                    </nav>
                </header>';
                echo '
            <main class="content">
                <section class="loginSection wrapper">
                        <h2>PRIJAVA KORISNIKA</h2>
                        <span id="errorLogin"></span>
                        <form action="" method="POST" class="formaLogin" enctype="multipart/form-data">
                                <label for="ime">Korisničko ime </label>
                                <input type="text" name="ime" id="ime"> <br>
    
                                <label for="lozinka">Lozinka</label>
                                <input type="password" name="lozinka" id="lozinka"> <br>
    
                                <button type="submit" value="login" name="submitLogin" id="submitLogin">LOGIN</button>
                        </form>
                        <span>Niste korisnik? <a href="registration.php">Registrirajte</a> vaš račun sada!</span>
                </section>
            </main>';
            }
            echo '<footer class="abosluteFooter">
            <div class="wrapper">
                <a href="https://www.france.tv/">france.tv</a>
            </div>
        </footer>';
        ?>

       
    </body>
</html>

<?php 

    if (isset($_POST['submitLogin'])) {
        include 'connect.php';
        $username=$_POST['ime'];
        $password=$_POST['lozinka'];
        
        $sql="SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime=?";
        $stmt=mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $sql)){
            mysqli_stmt_bind_param($stmt,'s', $username);

            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            mysqli_stmt_bind_result($stmt, $user, $pass, $level);
            mysqli_stmt_fetch($stmt);

            if (password_verify($password, $pass)) {
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['level'] = $level;
                mysqli_close($dbc);
                redirect();
            }
            else {
                echo "<script type=\"text/JavaScript\">
                    document.getElementById('errorLogin').style.color='red';
                    document.getElementById('errorLogin').innerHTML='Nepoznato ime ili lozinka, pokušajte ponovno ili se <a href=\"registration.php\">registrirajte</a>';
                </script>";
                mysqli_close($dbc);
            }
        

        }
        else {
            echo "<script type=\"text/JavaScript\"> 
                document.getElementById('errorLogin').style.color='red';
                document.getElementById('errorLogin').innerHTML='Nepoznato ime ili lozinka, pokušajte ponovno!';
            </script>";
            mysqli_close($dbc);
        }
    

    }


?>