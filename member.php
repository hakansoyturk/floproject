<?php

$folder = fopen("veri.db", "r");
session_start();
$X = $_SESSION['X'];


echo "Merhaba Sayin: " . "<b>$X</b>";
for ($i = 0; $i < strlen($X); $i++) {
    if ($X[$i] == " ") {
        $name = substr($X, 0, $i);
    }
}
$turkishLetters = array("İ", "ö", "Ö", "ü", "Ü", "ş", "Ş", "ç", "Ç");
$turkishLetterstoEnglish = array("I", "o", "O", "u", "U", "s", "S", "c", "C");
$surname = substr($X, strlen($name) + 1, strlen($X) - strlen($name) - 1);
$nameAndSurnameWithScore = strtolower($name . "-" . $surname);
$nameAndSurnameWithScore = str_replace($turkishLetters, $turkishLetterstoEnglish, $nameAndSurnameWithScore);
$nameAndSurnameWithScoreAndExtension = $nameAndSurnameWithScore . ".jpg";
$myPath = __DIR__ . "\'foto\'$nameAndSurnameWithScore" . ".jpg";
$myPath = str_replace("'", "", $myPath);
$myPath = str_replace($turkishLetters, $turkishLetterstoEnglish, $myPath);
?>
    <html>
    <body>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
        Yuklenecek fotografi seciniz:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <br>
        <input style="float:none" type="submit" value="YUKLE" name="submit">
    </form>
    </body>
    </html>
<?php
if (isset($_POST["submit"])) {
    $image = $_FILES["fileToUpload"];
    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $myPath);
    echo "<img width='600px' height='600px' src='foto/$nameAndSurnameWithScoreAndExtension'>";

}else{
    echo "yetkisiz giirs!";
    header("Location: signin.php");
}
?>