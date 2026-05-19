<?php
if (isset($_POST['hasil'])) {
    $luas = floatval($_POST['luas'] ?? 0);
    $tinggi = floatval($_POST['tinggi'] ?? 0);


    function limaSegiEmpat($luas, $tinggi)
    {
        $volume = 1 / 3 * pow($luas, 2) * $tinggi;

        return $volume;
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
        <label for="">Luas Alas</label><br>
        <input type="number" name="luas"><br><br>

        <label for="">Tinggi</label><br>
        <input type="number" name="tinggi"><br><br>

        <button type="submit" name="hasil">Hasil</button>
    </form>

    <?php
    echo "<br>";
    if (isset($_POST['hasil'])) {
        echo "Volume : " . limaSegiEmpat($luas, $tinggi);
    }
    ?>
</body>

</html>