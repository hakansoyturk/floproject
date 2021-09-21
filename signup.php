<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/generalcss.css">
</head>


<body>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="container">

        <label for="userName"><b>Kullanici Adi</b></label>
        <input type="text" placeholder="Kullanici adini giriniz" name="userNameLogin">

        <label for="password"><b>Sifre</b></label>
        <input type="password" placeholder="Sifreyi giriniz" name="passwordLogin">

        <button type="submit"><b>Giris</b></button>
        <button type="submit" formaction="changepassword.php"><b>Sifrenizi Degistirmek Icin Tiklayin</b></button>
    </div>
</form>
</div>

</body>
</html>


<?php
require "functions/safe.php";
require "functions/readveri.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lineArray = readDb();
    for ($i = 1; $i < sizeof($lineArray); $i += 3) {
        if (($lineArray[$i] == $_POST["userNameLogin"]) && (($lineArray[$i + 1]) == md5(sha1($_POST["passwordLogin"])))) {
            session_start();
            $_SESSION['X'] = $lineArray[$i - 1];
            header("Location: member.php");
        }
    }
    echo "<script> alert('hatali kullanici adi veya sifre!'); </script>";
}
else{
    echo "yetkisiz giris";
    header("Location: signin.php");
}
?>