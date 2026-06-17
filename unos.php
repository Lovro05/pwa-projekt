<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos vijesti</title>
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
        <li><a href="index.php#parisien">PARISIEN</a></li>
        <li><a href="index.php#vivre">VIVRE</a></li>
        <li><a href="unos.php">UNOS</a></li>
        <li><a href="#">ADMINISTRACIJA</a></li>
    </ul>
</nav>

<main class="forma-stranica">

    <h1>Unos nove vijesti</h1>

    <form name="unosVijesti" action="skripta.php" method="POST" enctype="multipart/form-data">

        <div class="form-item">
            <label for="title">Naslov vijesti</label>
            <input type="text" id="title" name="title" class="form-field-textual" required>
        </div>

        <div class="form-item">
            <label for="about">Kratki sažetak vijesti</label>
            <textarea id="about" name="about" rows="5" class="form-field-textual" required></textarea>
        </div>

        <div class="form-item">
            <label for="content">Tekst vijesti</label>
            <textarea id="content" name="content" rows="10" class="form-field-textual" required></textarea>
        </div>

        <div class="form-item">
            <label for="category">Kategorija vijesti</label>
            <select id="category" name="category" class="form-field-textual">
                <option value="Parisien">Parisien</option>
                <option value="Vivre mieux">Vivre mieux</option>
            </select>
        </div>

        <div class="form-item">
            <label for="pphoto">Slika</label>
            <input type="file" id="pphoto" name="pphoto" accept="image/png, image/jpeg">
        </div>

        <div class="form-item checkbox-item">
            <label>
                <input type="checkbox" name="archive">
                    Spremiti u arhivu / Sakriti vijest
            </label>
        </div>

        <div class="form-buttons">
            <button type="reset">Poništi</button>
            <button type="submit">Prihvati</button>
        </div>

    </form>

</main>

<footer>
    <p>Lovro Novosel | lnovosel2@tvz.hr | 2026</p>
</footer>

</body>
</html>