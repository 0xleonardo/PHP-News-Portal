<?php
    session_start();
    include 'connect.php';

        $id = $_GET['id'];
        $query = "SELECT * FROM clanak WHERE id=$id";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
    if (isset($_POST['prihvati']) && $_SESSION['level'] == 2) {

        define('UPLOADPATH', 'img/uploads/');

        $naslov = $_POST['title'];
        $kratki_sadrzaj = $_POST['about'];
        $sadrzaj = $_POST['content'];
        $kategorija = $_POST['category'];
        
        if(isset($_POST['archive']))
            $archive = 1;
        else
            $archive = 0;

        $name=$_FILES["pphoto"]["name"];
        if (empty($name)) {
            $name = $row['slika'];
            $query = "UPDATE clanak SET naslov='$naslov', kratki_sadrzaj='$kratki_sadrzaj',slika='$name',arhiva='$archive', kategorija='$kategorija' WHERE id=$id;";
        }

        else {
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
            $query = "UPDATE clanak SET naslov='$naslov', kratki_sadrzaj='$kratki_sadrzaj',slika='img/uploads/$tmpname',arhiva='$archive', kategorija='$kategorija' WHERE id=$id;";
        }
            
        mysqli_query($dbc, $query) or die('Error querying database.'. mysqli_error($dbc));
        mysqli_close($dbc);

        header("Location: administracija.php?showClanak=1");

    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FranceInfo | Edit Article</title>
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
                    <h2>PROMIJENA ČLANKA - id'; echo $id; echo '</h2>
                    <form action="" method="POST" class="forma" enctype="multipart/form-data">
                        <section>
                            <div class="form-item">
                                <label for="title">Naslov vijesti</label>
                                <div class="form-field">
                                    <textarea name="title" id="title" cols="30" rows="10" class="form-field-textual">';  echo $row['naslov']; echo '</textarea>
                                </div>
                                <span id="porukaTitle" class="bojaPoruke"></span>
                            </div>

                            <div class="form-item">
                                <label for="about">Kratki sadržaj vijesti</label>
                                <div class="form-field">
                                    <textarea name="about" id="about" cols="30" rows="10" class="form-field-textual">'; echo $row['kratki_sadrzaj']; echo '</textarea>
                                </div>
                                <span id="porukaAbout" class="bojaPoruke"></span>
                            </div>

                            <div class="form-item">
                                <label for="content">Sadržaj vijesti</label>
                                <div class="form-field">
                                    <textarea name="content" id="content" cols="30" rows="10" class="form-field-textual">'; echo $row['sadrzaj']; echo '</textarea>
                                </div>
                                <span id="porukaContent" class="bojaPoruke"></span>
                            </div>
                        </section>
                        <section>
                            <div class="form-item">
                                <label for="pphoto">Slika</label>
                                <div class="form-field slikaForm">
                                    <input type="file" accept="image/jpeg, image/gif" class="input-text" id="pphoto" name="pphoto"/>
                                    <img src="'; echo $row['slika']; echo '" alt="">
                                </div>
                                <span id="porukaSlika" class="bojaPoruke"></span>
                            </div>

                            <div class="form-item">
                                <label for="category">Kategorija vijesti</label>
                                <div class="form-field">
                                    <select name="category" id="category" class="form-field-textual">';

                                            if ($row['kategorija'] == 'sport')
                                                echo '
                                                <option value="" disabled>Odabir kategorije</option>
                                                <option value="sport" selected>Sport</option>
                                                <option value="politika">Politika</option>';
                                            else 
                                                echo '
                                                <option value="" disabled>Odabir kategorije</option>
                                                <option value="sport">Sport</option>
                                                <option value="politika" selected>Politika</option>';
                                    echo '
                                    </select>
                                </div>
                                <span id="porukaKategorija" class="bojaPoruke"></span>
                            </div>

                            <div class="form-item">
                                <label>Spremiti u arhivu:
                                    <div class="form-field">';
                                        
                                        if ($row['arhiva'] ==0)
                                            echo '<input type="checkbox" name="archive" id="archive">';
                                        else 
                                            echo '<input type="checkbox" name="archive" id="archive" checked>';

                                    echo '</div>
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
        }else if ($_SESSION['level'] == 0) {
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
			event.preventDefault();
		}
	};
</script>