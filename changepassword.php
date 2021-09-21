<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/generalcss.css">
</head>


<body>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="container">

        <label for="userName"><b>Kullanici Adi</b></label>
        <input type="text" placeholder="Kullanici adini giriniz" name="changePasswordUserName">

        <label for="password"><b>Eski Sifre</b></label>
        <input type="password" placeholder="Eski Sifreyi giriniz" name="changePasswordOldPassword">

        <label for="password"><b>Yeni Sifre</b></label>
        <input type="password" placeholder="Yeni Sifreyi giriniz" name="changePasswordNewPassword">

        <button type="submit" name="submit1"><b>Sifre Degistir</b></button>

    </div>
</form>
</div>

</body>
</html>


<?php

include "functions/readveri.php";
include "functions/safe.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit1"])) {
    $userName = security($_POST["changePasswordUserName"]);
    $oldPassword = md5(sha1(security($_POST["changePasswordOldPassword"])));
    $newPassword = md5(sha1(security($_POST["changePasswordNewPassword"])));
    $lineArray = readDb();
    $myText = "";
    if (!empty($userName) && !empty($oldPassword) && !empty($newPassword)) {
        for ($i = 1; $i < sizeof($lineArray); $i += 3) {
            if ($lineArray[$i] == $userName && $lineArray[$i + 1] == $oldPassword) {
                $lineArray[$i + 1] = $newPassword;
                for ($j = 0; $j < sizeof($lineArray); $j++) {
                    $myText .= $lineArray[$j] . "\n";
                }
                $folder = fopen("veri.db", "w");
                fwrite($folder, $myText);
                fclose($folder);
                header("Location: signup.php");
            } else {
                echo "Kullanici adi veya eski sifreniz yanlis";
            }
        }
    } else {
        echo "<script>alert('Bos alanlari doldurunuz!');</script>";
    }
}else{
    echo "yetkisiz giris!";
    header("Location: signin.php");

}
?>