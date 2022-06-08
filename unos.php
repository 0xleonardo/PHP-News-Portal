<?php 
    session_start();
    include 'connect.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FranceInfo | Insert</title>
        <link rel="stylesheet" href="css/style.css" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/b05e340512.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php 
        if (array_key_exists('user',$_SESSION) && array_key_exists('level',$_SESSION)) {
            if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
                echo '<header>
                <div class="wrapper">
                    <a href="index.php"><img src="img/franceinfo_logo.png" alt="logo"></a>
                </div>
                <nav>
                    <ul id="menu" class="wrapper">
                        <li><a href="index.php">home</a></li>
                        <li><a href="kategorija.php?id=politika">politika</a></li>
                        <li><a href="kategorija.php?id=sport">sport</a></li>';

                        
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
                        

                    echo'</ul>
                </nav>
            </header>
            <main>
                <section class="wrapper naslov">
                    <h2>UNOS NOVE VIJESTI</h2>
                    <form action="skripta.php" method="POST" class="forma" enctype="multipart/form-data">
                        <section>
                            <div class="form-item">
                                <label for="title">Naslov vijesti</label>
                                <div class="form-field">
                                    <input type="text" name="title" id="title" class="form-field-textual">
                                </div>
                                <span id="porukaTitle" class="bojaPoruke"></span>
                            </div>

                            <div class="form-item">
                                <label for="about">Kratki sadržaj vijesti</label>
                                <div class="form-field">
                                    <textarea name="about" id="about" cols="30" rows="10" class="form-field-textual"></textarea>
                                </div>
                                <span id="porukaAbout" class="bojaPoruke"></span>
                            </div>

                            <div class="form-item">
                                <label for="content">Sadržaj vijesti</label>
                                <div class="form-field">
                                    <textarea name="content" id="content" cols="30" rows="10" class="form-field-textual"></textarea>
                                </div>
                                <span id="porukaContent" class="bojaPoruke"></span>
                            </div>
                        </section>
                        <section>
                            <div class="form-item">
                                <label for="pphoto">Slika</label>
                                <div class="form-field">
                                    <input type="file" accept="image/jpeg, image/gif" class="input-text" id="pphoto" name="pphoto"/>
                                </div>
                                <span id="porukaSlika" class="bojaPoruke"></span>
                            </div>

                            <div class="form-item">
                                <label for="category">Kategorija vijesti</label>
                                <div class="form-field">
                                    <select name="category" id="category" class="form-field-textual">
                                        <option value="" disabled selected>Odabir kategorije</option>
                                        <option value="sport">Sport</option>
                                        <option value="politika">Politika</option>
                                    </select>
                                </div>
                                <span id="porukaKategorija" class="bojaPoruke"></span>
                            </div>

                            <div class="form-item">
                                <label>Spremiti u arhivu:
                                    <div class="form-field">
                                        <input type="checkbox" name="archive" id="archive">
                                    </div>
                                </label>
                            </div>
                            <div class="form-item">
                                <button type="submit" value="Prihvati" name="prihvati" id="greenButton">PRIHVATI</button>
                                <button type="reset" value="Poništi" id="redButton">PONIŠTI</button>
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
        
        ?>
    </body>
</html>

<script type="text/javascript">

	// Provjera forme prije slanja
	document.getElementById("greenButton").onclick = function(event){

		var slanjeForme = true;

		// Naslov vijesti (5-30 znakova)
		var poljeTitle = document.getElementById("title");
		var title = document.getElementById("title").value;
		if(title.length < 5 || title.length > 30){
			slanjeForme = false;
			poljeTitle.style.border="1px dashed red";
			document.getElementById("porukaTitle").innerHTML="<span style='color: red; font-size: 10pt;'>Naslov vijesti mora imati između 5 i 30 znakova!</span><br>";
		}
		else{
			poljeTitle.style.border="1px solid green";
			document.getElementById("porukaTitle").innerHTML="";
		}

		// Kratki sadržaj (10-100 znakova)
		var poljeAbout = document.getElementById("about");
		var about = document.getElementById("about").value;
		if(about.length < 10 || about.length > 100){
			slanjeForme = false;
			poljeAbout.style.border="1px dashed red";
			document.getElementById("porukaAbout").innerHTML="<span style='color: red; font-size: 10pt;'>Kratki sadržaj mora imati između 10 i 100 znakova!</span><br>";
		}
		else{
			poljeAbout.style.border="1px solid green";
			document.getElementById("porukaAbout").innerHTML="";
		}

		// Sadržaj mora biti unesen
		var poljeContent = document.getElementById("content");
		var content = document.getElementById("content").value;
		if(content.length == 0){
			slanjeForme = false;
			poljeContent.style.border="1px dashed red";
			document.getElementById("porukaContent").innerHTML="<span style='color: red; font-size: 10pt;'>Sadržaj mora biti unesen!</span><br>";
		}
		else{
			poljeContent.style.border="1px solid green";
			document.getElementById("porukaContent").innerHTML="";
		}
		
		// Slika mora biti unesena
		var poljeSlika = document.getElementById("pphoto");
		var pphoto = document.getElementById("pphoto").value;
		if(pphoto.length == 0){
			slanjeForme = false;
			poljeSlika.style.border="1px dashed red";
			document.getElementById("porukaSlika").innerHTML="<span style='color: red; font-size: 10pt;'>Slika mora biti unesena!</span><br>";
		}
		else{
			poljeSlike.style="1px solid green";
			document.getElementById("porukaSlika").innerHTML="";
		}

		// Kategorija mora biti odabrana
		var poljeCategory = document.getElementById("category");
		if(document.getElementById("category").selectedIndex == 0){
			slanjeForme = false;
			poljeCategory.style.border="1px dashed red";
			document.getElementById("porukaKategorija").innerHTML="<span style='color: red; font-size: 10pt;'>Kategorija mora biti odabrana!</span><br>";
		}
		else{
			poljeCategory.style.border="1px solid green";
			document.getElementById("porukaKategorija").innerHTML="";
		}


		if(slanjeForme != true){
            event.stopPropagation();
            event.preventDefault();

		}
	};
</script>