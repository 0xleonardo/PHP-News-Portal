<?php 
    session_start();
    include 'connect.php';
    $id = $_GET['id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FranceInfo | <?php echo ucfirst($id); ?></title>
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
				<ul class="wrapper">
                    <li><a href="index.php">home</a></li>
					<?php 
                    if ($id == 'sport') {
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
            <section class="mainSection">
                <div class="articles_header wrapper">
                    <h3><?php echo $id; ?></h3>
                </div>
                <div class="categorySections">
                    <?php
                        $query = "SELECT * FROM clanak WHERE arhiva=0 AND kategorija='".$id."'";
                        $result = mysqli_query($dbc, $query);
                            $i = 0;
                            while($row = mysqli_fetch_array($result)){
                                if ($i % 5 == 0)
                                    echo '<div class="articles wrapper">';
                                echo '<article>';
                                echo '<a href="clanak.php?id='.$row['id'].'">';

                                echo '<img src="'.$row['slika'].'" alt="prev">';
                                echo '<p>'.$row['kratki_sadrzaj'].'</p>';

                                echo '</a>';
                                echo '</article>';
                                $i++;
                                if ($i % 5 == 0 && $i != 0) {
                                    echo '</div>';
                                    $i=0;
                                }
                            }
                            mysqli_close($dbc);
                        ?>
                </div>
            </section>
        </main>
        <footer>
            <div class="wrapper">
                <a href="https://www.france.tv/">france.tv</a>
            </div>
        </footer>
    </body>
</html>