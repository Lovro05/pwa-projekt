<?php
$title = isset($_POST['title']) ? $_POST['title'] : '';
$about = isset($_POST['about']) ? $_POST['about'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';
$archive = isset($_POST['archive']) ? 'Da' : 'Ne';

$image = 'img/img3.png';

if (isset($_FILES['pphoto']) && $_FILES['pphoto']['name'] != '') {
    $image = 'img/' . $_FILES['pphoto']['name'];
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <a href="index.html">
        <img src="img/logo.png" alt="Le Parisien">
    </a>
</header>

<nav>
    <ul>
        <li><a href="index.html">HOME</a></li>
        <li><a href="index.html#parisien">PARISIEN</a></li>
        <li><a href="index.html#vivre">VIVRE</a></li>
        <li><a href="unos.html">UNOS</a></li>
        <li><a href="#">ADMINISTRACIJA</a></li>
    </ul>
</nav>

<main class="prikaz-clanka">

    <p class="category"><?php echo $category; ?></p>

    <h1><?php echo $title; ?></h1>

    <p class="meta">AUTOR: Lovro Novosel</p>
    <p class="meta">OBJAVLJENO: 2026</p>
    <p class="meta">PRIKAZATI NA STRANICI: <?php echo $archive; ?></p>

    <img src="<?php echo $image; ?>" alt="Slika vijesti">

    <p class="about">
        <?php echo $about; ?>
    </p>

    <p class="content">
        <?php echo nl2br($content); ?>
    </p>

</main>

<footer>
    <p>Lovro Novosel | lnovosel2@tvz.hr | 2026</p>
</footer>

</body>
</html>