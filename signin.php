<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/generalcss.css">
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <div class="container">
        <label for="userName"><b>Adi Soyadi</b></label>
        <input type="text" placeholder="Adinizi soyadinizi giriniz" name="yourName">

        <label for="userName"><b>Kullanici Adi</b></label>
        <input type="text" placeholder="Kullanici adini giriniz" name="userName">

        <label for="password"><b>Sifre</b></label>
        <input type="password" placeholder="Sifreyi giriniz" name="password">

        <button type="submit"><b>Kaydet</b></button>
    </div>
</form>
</div>

</body>
</html>
<?php
require "functions/safe.php";
include "functions/readveri.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $yourName = security($_POST["yourName"]);
    $userName = security($_POST["userName"]);
    $password = security($_POST["password"]);
    $myText = $yourName . "\n";
    $myText .= $userName . "\n";
    $myText .= md5(sha1($password)) . "\n";
    $lineArray = readDb();
    $isValidUserName = true;
    for ($i = 1; $i < sizeof($lineArray); $i += 3) {
        if ($userName == $lineArray[$i]) {
            $isValidUserName = false;
        }
    }
    if ($isValidUserName) {
        if (!empty($yourName) && !empty($userName) && !empty($password)) {
            $folder = fopen("veri.db", "a+");
            fwrite($folder, $myText);
            fclose($folder);
            header("Location: signup.php");
        } else {
            echo "<script> alert('bos alanlari doldurunuz!'); </script>";
        }
    } else {
        echo "<script>alert('Bu kullanici adi kullaniliyor!');</script>";
    }
}else{
    echo "yetkisiz giris!";
    header("Location: signin.php");
}
?>