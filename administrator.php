<?php
session_start();
include 'connect.php';
define('UPLPATH', 'img/');

$uspjesnaPrijava = false;
$admin = false;
$poruka = "";

if (isset($_POST['prijava'])) {
    $username = $_POST['username'];
    $lozinka = $_POST['lozinka'];

    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $razinaKorisnika);
        mysqli_stmt_fetch($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0 && password_verify($lozinka, $lozinkaKorisnika)) {
            $_SESSION['username'] = $imeKorisnika;
            $_SESSION['level'] = $razinaKorisnika;
            $uspjesnaPrijava = true;

            if ($razinaKorisnika == 1) {
                $admin = true;
            }
        } else {
            $poruka = "Neispravno korisničko ime ili lozinka. Prvo se morate registrirati.";
        }
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: administrator.php");
    exit();
}

if (isset($_POST['delete']) && isset($_SESSION['level']) && $_SESSION['level'] == 1) {
    $id = $_POST['id'];
    $query = "DELETE FROM vijesti WHERE id=$id";
    mysqli_query($dbc, $query);
}

if (isset($_POST['update']) && isset($_SESSION['level']) && $_SESSION['level'] == 1) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $about = $_POST['about'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $archive = isset($_POST['archive']) ? 1 : 0;

    $old_picture = $_POST['old_picture'];
    $picture = $_FILES['pphoto']['name'];

    if ($picture != '') {
        move_uploaded_file($_FILES['pphoto']['tmp_name'], 'img/' . $picture);
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

    mysqli_query($dbc, $query);
}
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

<?php
if (isset($_SESSION['level']) && $_SESSION['level'] == 1) {
?>

    <h1>Administracija vijesti</h1>

    <form method="POST">
        <button type="submit" name="logout">Odjava</button>
    </form>

    <?php
    $query = "SELECT * FROM vijesti ORDER BY id DESC";
    $result = mysqli_query($dbc, $query);

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
                <label>Kratki sažetak</label>
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
                <label>Kategorija</label>
                <select name="category" class="form-field-textual">
                    <option value="Parisien" <?php if ($row['kategorija'] == 'Parisien') echo 'selected'; ?>>Parisien</option>
                    <option value="Vivre mieux" <?php if ($row['kategorija'] == 'Vivre mieux') echo 'selected'; ?>>Vivre mieux</option>
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

} else if (isset($_SESSION['level']) && $_SESSION['level'] == 0) {
    echo "<p>Bok " . $_SESSION['username'] . "! Uspješno ste prijavljeni, ali nemate administratorska prava.</p>";

    echo '
    <form method="POST">
        <button type="submit" name="logout">Odjava</button>
    </form>
    ';
} else {
?>

    <h1>Prijava administratora</h1>

    <p class="poruka-greska"><?php echo $poruka; ?></p>

    <?php
    if ($poruka != "") {
        echo '<p><a href="registracija.php">Registriraj se ovdje</a></p>';
    }
    ?>

    <form action="administrator.php" method="POST">

        <div class="form-item">
            <label for="username">Korisničko ime</label>
            <input type="text" id="username" name="username" class="form-field-textual" required>
        </div>

        <div class="form-item">
            <label for="lozinka">Lozinka</label>
            <input type="password" id="lozinka" name="lozinka" class="form-field-textual" required>
        </div>

        <div class="form-buttons">
            <button type="submit" name="prijava">Prijava</button>
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