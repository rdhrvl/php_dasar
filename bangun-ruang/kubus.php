<?php
if (isset($_POST['hasil'])) {
    $volume = floatval($_POST['volume'] ?? 0);
    $luas = floatval($_POST['luas'] ?? 0);
    $hasil_volume = pow($volume, 3);
    $hasil_luas = 6 * pow($luas, 2);


    function hasilPerhitungan($volume, $luas)
    {
        $hasil_volume = pow($volume, 3);
        $hasil_luas = 6 * pow($luas, 2);

        return "Volume : " .  $hasil_volume . "<br>" . "Luas : " . $hasil_luas;
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
        <label for="">Volume</label><br>
        <input type="number" name="volume"><br><br>
        <label for="">Luas Permukaan</label><br>
        6 x <input type="number" name="luas"><br><br>

        <button type="submit" name="hasil">Hasil</button>
    </form>

    <?php
    echo "<br>";
    if (isset($_POST['hasil'])) {
        echo hasilPerhitungan($volume, $luas);
    }
    ?>
</body>

</html>