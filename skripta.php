<?php
include 'connect.php';

$title = $_POST['title'];
$about = $_POST['about'];
$content = $_POST['content'];
$category = $_POST['category'];
$date = date('d.m.Y.');

if (isset($_POST['archive'])) {
    $archive = 1;
} else {
    $archive = 0;
}

$picture = $_FILES['pphoto']['name'];

if ($picture != '') {
    $target_dir = 'img/' . $picture;
    move_uploaded_file($_FILES['pphoto']['tmp_name'], $target_dir);
} else {
    $picture = 'img3.png';
}

$query = "INSERT INTO vijesti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva)
          VALUES ('$date', '$title', '$about', '$content', '$picture', '$category', '$archive')";

$result = mysqli_query($dbc, $query) or die("Greška kod upisa u bazu.");

mysqli_close($dbc);

header("Location: index.php");
exit();
?>