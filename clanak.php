<?php
include 'connect.php';

define('UPLPATH', 'img/');

$id = $_GET['id'];

$query = "SELECT * FROM vijesti WHERE id=$id";
$result = mysqli_query($dbc, $query);

$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['naslov']; ?></title>
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

<main class="clanak">

    <p class="kategorija">
        <?php echo $row['kategorija']; ?>
    </p>

    <h1>
        <?php echo $row['naslov']; ?>
    </h1>

    <p class="datum">
        Objavljeno:
        <?php echo $row['datum']; ?>
    </p>

    <img src="<?php echo UPLPATH . $row['slika']; ?>" alt="Slika vijesti">

    <p class="uvod">
        <?php echo $row['sazetak']; ?>
    </p>

    <div class="tekst-clanka">
        <?php echo nl2br($row['tekst']); ?>
    </div>

</main>

<footer>
    <p>Lovro Novosel | lnovosel2@tvz.hr | 2026</p>
</footer>

</body>
</html>

<?php
mysqli_close($dbc);
?>