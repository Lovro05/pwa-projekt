<?php
include 'connect.php';
define('UPLPATH', 'img/');
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Parisien</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <a href="index.php">
        <img src="img/logo.png" alt="Le Parisien">
    </a>
</header>

<nav>
    <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="kategorija.php?id=Parisien">PARISIEN</a></li>
        <li><a href="kategorija.php?id=Vivre mieux">VIVRE</a></li>
        <li><a href="unos.php">UNOS</a></li>
        <li><a href="administrator.php">ADMINISTRACIJA</a></li>
    </ul>
</nav>

<main>

    <section id="parisien">
        <h2>PARISIEN</h2>

        <div class="vijesti">

            <?php
            $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='Parisien' ORDER BY id DESC LIMIT 3";
            $result = mysqli_query($dbc, $query);

            while ($row = mysqli_fetch_array($result)) {
                echo '<article>';
                echo '<a href="clanak.php?id=' . $row['id'] . '">';
                echo '<img src="' . UPLPATH . $row['slika'] . '" alt="Vijest">';
                echo '</a>';
                echo '<h3>';
                echo '<a href="clanak.php?id=' . $row['id'] . '">';
                echo $row['naslov'];
                echo '</a>';
                echo '</h3>';
                echo '</article>';
            }
            ?>

        </div>
    </section>

    <section id="vivre">
        <h2>VIVRE MIEUX</h2>

        <div class="vijesti">

            <?php
            $query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='Vivre mieux' ORDER BY id DESC LIMIT 3";
            $result = mysqli_query($dbc, $query);

            while ($row = mysqli_fetch_array($result)) {
                echo '<article>';
                echo '<a href="clanak.php?id=' . $row['id'] . '">';
                echo '<img src="' . UPLPATH . $row['slika'] . '" alt="Vijest">';
                echo '</a>';
                echo '<h3>';
                echo '<a href="clanak.php?id=' . $row['id'] . '">';
                echo $row['naslov'];
                echo '</a>';
                echo '</h3>';
                echo '</article>';
            }
            ?>

        </div>
    </section>

</main>

<footer>
    <p>Lovro Novosel | lovronovosel05@gmail.com | 2026</p>
</footer>

</body>
</html>

<?php
mysqli_close($dbc);
?>