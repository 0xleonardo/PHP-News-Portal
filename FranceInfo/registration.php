<?php 
    session_start();
    include 'connect.php';

    function redirect(){header( "refresh:3; url=login.php");}
    function redirectAlreadyLoggedIn() {header( "refresh:5;url=index.php" );}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FranceInfo | Registration</title>
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
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

                        $user = $_SESSION['user'];
                        echo "<h2> $user VEĆ STE PRIJAVLJENI, VRAĆAM VAS NA POČETNU STRANICU</h2>";
                        redirectAlreadyLoggedIn();
                    }
                    
                    else {
                        echo '<li><a href="login.php">login</a></li>';
                    }
                    
                    ?>
				</ul>
			</nav>
		</header>
        <main class="content">
            <section class="loginSection wrapper">
                    <h2>REGISTRACIJA KORISNIKA</h2>
                    <span id="errorRegister"></span>
                    <form action="" method="POST" class="formaLogin" enctype="multipart/form-data">
                            <label for="ime">Ime </label>
                            <input type="text" name="ime" id="ime"> 
                            <span id="errorIme"></span><br>

                            <label for="prezime">Prezime </label>
                            <input type="text" name="prezime" id="prezime"> 
                            <span id="errorPrezime"></span><br>

                            <label for="username">Korisničko ime </label>
                            <input type="text" name="username" id="username"> 
                            <span id="errorUsername"></span><br>

                            <label for="lozinka">Lozinka</label>
                            <input type="password" name="lozinka" id="lozinka"> <br>

                            <label for="lozinka">Ponovno unesite lozinku </label>
                            <input type="password" name="plozinka" id="plozinka"> 
                            <span id="errorPassword"></span><br>

                            <button type="submit" value="login" name="submitRegister" id="submitRegister">REGISTER</button>
                    </form>
                    <span>Korisnik ste? <a href="login.php">Ulogirajte</a> se na vaš račun sada!</span>
            </section>
        </main>
        <footer>
            <div class="wrapper">
                <a href="https://www.france.tv/">france.tv</a>
            </div>
        </footer>
    </body>
</html>

<?php 
    if (isset($_POST['submitRegister'])) {
        include 'connect.php';
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $username = $_POST['username'];
        $lozinka = password_hash($_POST['lozinka'], CRYPT_BLOWFISH);
        $razina = 0;
        $registriran = false;

        $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
        $stmt = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }

        if(mysqli_stmt_num_rows($stmt) > 0){
           echo '<script type="text/JavaScript">
                    document.getElementById("errorIme").style.color = "red";
                    document.getElementById("errorIme").innerHTML = "Korisničko ime već postoji!"; 
                </script>';
            mysqli_close($dbc);
        }
        else {

            $sql="INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) values (?, ?, ?, ?, ?)";

            $stmt=mysqli_stmt_init($dbc);
            
            if (mysqli_stmt_prepare($stmt, $sql)){
                mysqli_stmt_bind_param($stmt,'ssssi',$ime,$prezime,$username,$lozinka,$razina);
                mysqli_stmt_execute($stmt);

                echo '<script type="text/JavaScript">
                    document.getElementById("errorRegister").style.color = "green";
                    document.getElementById("errorRegister").innerHTML = "Korisnik '.$username.' uspješno registriran!"; 
                </script>';
                mysqli_close($dbc);
                redirect();
            } 
        }
        

    }


?>

<script type="text/JavaScript">

    document.getElementById("submitRegister").onclick = function (event) {
        var slanje_forme=true; 
        
        if(document.getElementById("ime").value.length == 0) {
            slanje_forme=false;
            document.getElementById("ime").style.border = "1px dotted red";
            document.getElementById("errorIme").style.color = "red";
            document.getElementById("errorIme").innerHTML = "Unesite ime!";
        }
        else {
            document.getElementById("ime").style.border = "1px dotted green";
            document.getElementById("errorIme").innerHTML = "";
        }

        if(document.getElementById("prezime").value.length == 0) {
            slanje_forme=false;
            document.getElementById("prezime").style.border = "1px dotted red";
            document.getElementById("errorPrezime").style.color = "red";
            document.getElementById("errorPrezime").innerHTML = "Unesite prezime!";
        }
        else {
            document.getElementById("prezime").style.border = "1px dotted green";
            document.getElementById("errorPrezime").innerHTML = "";
        }

        if(document.getElementById("username").value.length == 0) {
            slanje_forme=false;
            document.getElementById("username").style.border = "1px dotted red";
            document.getElementById("errorUsername").style.color = "red";
            document.getElementById("errorUsername").innerHTML = "Unesite korisnicko ime!";
        }
        else {
            document.getElementById("username").style.border = "1px dotted green";
            document.getElementById("errorUsername").innerHTML = "";
        }

        if(document.getElementById("lozinka").value.length == 0 || document.getElementById("plozinka").value.length == 0) {
            slanje_forme=false;
            document.getElementById("lozinka").style.border = "1px dotted red";
            document.getElementById("plozinka").style.border = "1px dotted red";
            document.getElementById("errorPassword").style.color = "red";
            document.getElementById("errorPassword").innerHTML = "Unesite lozinku!";
        }
        else {
            document.getElementById("lozinka").style.border = "1px dotted green";
            document.getElementById("lozinka").innerHTML = "";
        }

        if(document.getElementById("lozinka").value != document.getElementById("plozinka").value) {
            slanje_forme=false;
            document.getElementById("lozinka").style.border = "1px dotted red";
            document.getElementById("plozinka").style.border = "1px dotted red";
            document.getElementById("errorPassword").style.color = "red";
            document.getElementById("errorPassword").innerHTML = "Lozinke se moraju poklapati!";
        }
        else if (document.getElementById("lozinka").value.length > 0){
            document.getElementById("plozinka").style.border = "1px dotted green";
            document.getElementById("errorPassword").innerHTML = "";
        }

        if (slanje_forme!=true)
            event.preventDefault();

    }
</script>