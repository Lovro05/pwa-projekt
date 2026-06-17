<?php
include 'connect.php';

$msg = "";
$registriranKorisnik = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $lozinka = $_POST['pass'];
    $lozinkaPonovi = $_POST['passRep'];
    $razina = 0;

    if ($lozinka != $lozinkaPonovi) {
        $msg = "Lozinke nisu iste!";
    } else {
        $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
        $stmt = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $msg = "Korisničko ime već postoji!";
        } else {
            $hashed_password = password_hash($lozinka, PASSWORD_DEFAULT);

            $sql = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = mysqli_stmt_init($dbc);

            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssssi", $ime, $prezime, $username, $hashed_password, $razina);
                mysqli_stmt_execute($stmt);
                $registriranKorisnik = true;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
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

<main class="forma-stranica">

    <h1>Registracija korisnika</h1>

    <?php
    if ($registriranKorisnik) {
        echo '<p class="poruka-uspjeh">Korisnik je uspješno registriran!</p>';
        echo '<p><a href="administrator.php">Idi na prijavu</a></p>';
    } else {
    ?>

    <p class="poruka-greska"><?php echo $msg; ?></p>

    <form action="registracija.php" method="POST">

        <div class="form-item">
            <label for="ime">Ime</label>
            <input type="text" id="ime" name="ime" class="form-field-textual" required>
        </div>

        <div class="form-item">
            <label for="prezime">Prezime</label>
            <input type="text" id="prezime" name="prezime" class="form-field-textual" required>
        </div>

        <div class="form-item">
            <label for="username">Korisničko ime</label>
            <input type="text" id="username" name="username" class="form-field-textual" required>
        </div>

        <div class="form-item">
            <label for="pass">Lozinka</label>
            <input type="password" id="pass" name="pass" class="form-field-textual" required>
        </div>

        <div class="form-item">
            <label for="passRep">Ponovi lozinku</label>
            <input type="password" id="passRep" name="passRep" class="form-field-textual" required>
        </div>

        <div class="form-buttons">
            <button type="submit">Registriraj se</button>
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