<?php
if (isset($_POST['hasil'])) {
    $panjang = floatval($_POST['panjang'] ?? 0);
    $lebar = floatval($_POST['lebar'] ?? 0);
    $tinggi = floatval($_POST['tinggi'] ?? 0);
    $luas = floatval($_POST['luas'] ?? 0);
    $volume = 0;
    $luas = 0;


    function hasilVolume($panjang, $lebar, $tinggi)
    {
        $volume = $panjang * $lebar * $tinggi;

        return $volume;
    }

    function hasilLuas($panjang, $lebar, $tinggi)
    {
        $luas = 2 * ($panjang * $lebar + $panjang * $tinggi + $lebar * $tinggi);

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

        <label for="">Panjang</label><br>
        <input type="number" name="panjang"><br><br>

        <label for="">Lebar</label><br>
        <input type="number" name="lebar"><br><br>

        <label for="">Tinggi</label><br>
        <input type="number" name="tinggi"><br><br>

        <label for="">Luas Permukaan</label><br>
        2 x <input type="number" name="luas"><br><br>

        <button type="submit" name="hasil">Hasil</button>
    </form>

    <?php
    echo "<br>";
    if (isset($_POST['hasil'])) {
        echo "Volume : " . hasilVolume($panjang, $lebar, $tinggi);
        echo "<br>";
        echo "Luas : " . hasilLuas($panjang, $lebar, $tinggi);
    }
    ?>
</body>

</html>