<?php
include 'connect.php';
define('UPLPATH', 'img/');

$kategorija = $_GET['id'];

$query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='$kategorija' ORDER BY id DESC";
$result = mysqli_query($dbc, $query);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $kategorija; ?></title>
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
    <section>
        <h2><?php echo $kategorija; ?></h2>

        <div class="vijesti">
            <?php
            while ($row = mysqli_fetch_array($result)) {
                echo '<article>';
                echo '<a href="clanak.php?id=' . $row['id'] . '">';
                echo '<img src="' . UPLPATH . $row['slika'] . '" alt="Vijest">';
                echo '</a>';
                echo '<h3><a href="clanak.php?id=' . $row['id'] . '">' . $row['naslov'] . '</a></h3>';
                echo '</article>';
            }
            ?>
        </div>
    </section>
</main>

<footer>
    <p>Lovro Novosel | lnovosel2@tvz.hr | 2026</p>
</footer>

</body>
</html>

<?php
mysqli_close($dbc);
?>