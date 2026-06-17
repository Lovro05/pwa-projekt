<?php
include 'connect.php';
define('UPLPATH', 'img/');

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM vijesti WHERE id=$id";
    mysqli_query($dbc, $query) or die("Greška kod brisanja.");
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $about = $_POST['about'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    if (isset($_POST['archive'])) {
        $archive = 1;
    } else {
        $archive = 0;
    }

    $old_picture = $_POST['old_picture'];
    $picture = $_FILES['pphoto']['name'];

    if ($picture != '') {
        $target_dir = 'img/' . $picture;
        move_uploaded_file($_FILES['pphoto']['tmp_name'], $target_dir);
    } else {
        $picture = $old_picture;
    }

    $query = "UPDATE vijesti 
              SET naslov='$title',
                  sazetak='$about',
                  tekst='$content',
                  slika='$picture',
                  kategorija='$category',
                  arhiva='$archive'
              WHERE id=$id";

    mysqli_query($dbc, $query) or die("Greška kod izmjene.");
}

$query = "SELECT * FROM vijesti ORDER BY id DESC";
$result = mysqli_query($dbc, $query);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Administracija</title>
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

<main class="admin-stranica">

    <h1>Administracija vijesti</h1>

    <?php
    while ($row = mysqli_fetch_array($result)) {
    ?>

        <form class="admin-forma" enctype="multipart/form-data" action="administrator.php" method="POST">

            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="old_picture" value="<?php echo $row['slika']; ?>">

            <div class="form-item">
                <label>Naslov vijesti</label>
                <input type="text" name="title" class="form-field-textual" value="<?php echo $row['naslov']; ?>">
            </div>

            <div class="form-item">
                <label>Kratki sažetak vijesti</label>
                <textarea name="about" rows="4" class="form-field-textual"><?php echo $row['sazetak']; ?></textarea>
            </div>

            <div class="form-item">
                <label>Tekst vijesti</label>
                <textarea name="content" rows="8" class="form-field-textual"><?php echo $row['tekst']; ?></textarea>
            </div>

            <div class="form-item">
                <label>Trenutna slika</label>
                <img class="admin-slika" src="<?php echo UPLPATH . $row['slika']; ?>" alt="Slika vijesti">
            </div>

            <div class="form-item">
                <label>Promijeni sliku</label>
                <input type="file" name="pphoto" accept="image/png, image/jpeg">
            </div>

            <div class="form-item">
                <label>Kategorija vijesti</label>
                <select name="category" class="form-field-textual">
                    <option value="Parisien" <?php if ($row['kategorija'] == 'Parisien') echo 'selected'; ?>>
                        Parisien
                    </option>
                    <option value="Vivre mieux" <?php if ($row['kategorija'] == 'Vivre mieux') echo 'selected'; ?>>
                        Vivre mieux
                    </option>
                </select>
            </div>

            <div class="form-item checkbox-item">
                <label>
                    <input type="checkbox" name="archive" <?php if ($row['arhiva'] == 1) echo 'checked'; ?>>
                    Spremiti u arhivu / sakriti vijest
                </label>
            </div>

            <div class="form-buttons">
                <button type="submit" name="update">Izmijeni</button>
                <button type="submit" name="delete">Izbriši</button>
            </div>

        </form>

    <?php
    }
    ?>

</main>

<footer>
    <p>Lovro Novosel | lnovosel2@tvz.hr | 2026</p>
</footer>

</body>
</html>

<?php
mysqli_close($dbc);
?>