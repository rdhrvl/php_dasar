<?php
if (isset($_POST['hasil'])) {
    $jari_jari = floatval($_POST['jari_jari'] ?? 0);
    $tinggi = floatval($_POST['tinggi'] ?? 0);
    $volume = 0;


    function hasilVolume($jari_jari, $tinggi)
    {
        $volume = M_PI * pow($jari_jari, 2) * $tinggi;

        return $volume;
    }

    function hasilLuas($jari_jari, $tinggi)
    {
        $luas = 2 * M_PI * $jari_jari * ($jari_jari + $tinggi);

        return $luas;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <label for="">jari Jari</label><br>
        <input type="number" name="jari_jari"><br><br>

        <label for="">Tinggi</label><br>
        <input type="number" name="tinggi"><br><br>

        <button type="submit" name="hasil">Hasil</button>
    </form>

    <?php
    echo "<br>";
    if (isset($_POST['hasil'])) {
        echo "Volume : " . hasilVolume($jari_jari, $tinggi);
        echo "<br>";
        echo "Luas : " . hasilLuas($jari_jari, $tinggi);
    }
    ?>
</body>

</html>